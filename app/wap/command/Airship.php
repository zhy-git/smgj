<?php
namespace app\home\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Airship extends Command
{
    protected function configure()
    {
        $this->setName('airship')->setDescription('幸运飞艇兑奖');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    public function doCron(){
        $number = getNumberCache('airship'); //获取最新开奖号
        if($number) {
            $stage_num = key($number);//获取最新一期号
            $value = $number[$stage_num];
            $numbers = $value['number'];//获取最新开奖号
            $number_arr = explode(',', $numbers);
            $w['stage'] = $stage_num;
            $w['cate'] = 3;
            $w['state'] = 0;
            $w['code'] = 0;
            $list = Db::name('single')->where($w)->select();
            $explain ='';
            if($list) {
                $time = time();
                foreach ($list as $v){
                    $pl =0;
                    //计算赔率
                    switch ($v['type']){
                        case 1://竞猜船号
                            if(is_numeric($v['number'])){
                                if(in_array($v['number'],$number_arr) &&  $number_arr[($v['wei']-1)] == $v['number']){
                                    $pl = getOdds(38);//赔率
                                    $wei = config('lottery_wei.airship');
                                    $explain = $stage_num.'期竞猜车道中'.$wei[$v['wei']-1].$v['number'];
                                }
                            }else{
                                $dx = airshipDxWei($number_arr[($v['wei']-1)]); //判断大小
                                $ds = airshipDs($number_arr[($v['wei']-1)]);//判断单双
                                if($v['number'] == $dx || $v['number'] == $ds){
                                    $pl = getOdds(38);//赔率
                                    $wei = config('lottery_wei.airship');
                                    $explain = $stage_num.'期竞猜车道中'.$wei[$v['wei']-1].$v['number'];
                                }
                            }
                            break;
                        case 2://冠亚和值
                            $he = $number_arr[0]+$number_arr[1];
                            if(is_numeric($v['number'])){
                                if($he == $v['number']){
                                    $pl = getOdds(43);//赔率
                                    $explain = $stage_num.'期冠亚和值中'.$v['number'];
                                }
                            }else{
                                $dx = airshipDx($he); //判断大小
                                $ds = airshipDs($he);//判断单双
                                if($v['number'] == $dx){
                                    if($dx == '大'){
                                        $pl = getOdds(39);//赔率
                                    }elseif($dx == '小'){
                                        $pl = getOdds(40);//赔率
                                    }
                                }elseif($v['number'] == $ds){
                                    if($dx == '单'){
                                        $pl = getOdds(41);//赔率
                                    }elseif($dx == '双'){
                                        $pl = getOdds(42);//赔率
                                    }
                                }
                                $explain = $stage_num.'期冠亚和值中'.$v['number'];
                            }
                            break;
                        case 3://大小单双
                            if(strlen($v['number']) > 3){ //组合
                                $dxds = airshipDxds($number_arr[($v['wei']-1)]); //判断大小单双
                                if($v['number'] == $dxds){
                                    $pl = getOdds(45);//赔率
                                }
                            }else{
                                $dx = airshipDxWei($number_arr[($v['wei']-1)]); //判断大小
                                $ds = airshipDs($number_arr[($v['wei']-1)]);//判断单双
                                if($v['number'] == $dx){
                                    if($v['number'] == '大'){
                                        $pl = getOdds(44);//赔率
                                    }elseif ($v['number'] == '小'){
                                        $pl = getOdds(44);//赔率
                                    }
                                }elseif($v['number'] == $ds){
                                    if($v['number'] == '单'){
                                        $pl = getOdds(44);//赔率
                                    }elseif ($v['number'] == '双'){
                                        $pl = getOdds(44);//赔率
                                    }
                                }
                            }
                            $explain = $stage_num.'期大小单双中'.$v['number'];

                            break;
                        case 4://龙虎斗
                            $s = $v['wei']-1;
                            $e = 10-$v['wei'];
                            if($number_arr[$s] > $number_arr[$e] && $v['number'] == '龙'){
                                $pl = getOdds(46);//赔率
                            }elseif ($number_arr[$s] < $number_arr[$e] && $v['number'] == '虎'){
                                $pl = getOdds(46);//赔率
                            }
                            $arr = ['第一名 vs 第十名','第二名 vs 第九名','第三名 vs 第八名','第四名 vs 第七名','第五名 vs 第六名'];
                            $explain = $stage_num.'期龙虎斗中'.$arr[$s].$v['number'];
                            break;

                    }
                    if($pl){
                        if(Db::name('single')->where('id',$v['id'])->update(['state'=>1,'code'=>1,'update_at'=>$time])){
                            Db::name('member')->where('id', $v['uid'])->setInc('money', $v['money']*$pl);
                            $balance = Db::name('member')->where('id', $v['uid'])->value('money');
                            addDetail($v['uid'],1,$v['money']*$pl,$balance,43,$explain);
                        }
                    }else{
                        Db::name('single')->where('id',$v['id'])->update(['state'=>1,'update_at'=>$time]);
                    }
                }
            }
        }
    }
}