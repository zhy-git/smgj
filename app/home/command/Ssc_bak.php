<?php
namespace app\home\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Ssc extends Command
{
    protected function configure()
    {
        $this->setName('ssc')->setDescription('重庆时时彩兑奖');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    public function doCron(){
        $number = getNumberCache('ssc'); //获取最新开奖号
        if($number) {
            $stage_num = key($number);//获取最新一期号
            $value = $number[$stage_num];
            $numbers = $value['number'];//获取最新开奖号
            $number_arr = explode(',', $numbers);
            $w['stage'] = 20171102056;
            $w['cate'] = 1;
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
                        case 1://龙虎合
                            $lhh = sscLh($number_arr); //判断龙虎合
                            if($v['number'] == $lhh){
                                if($lhh == '龙' || $lhh == '虎'){
                                    $pl = getOdds(1);//赔率
                                }elseif ($lhh == '和'){
                                    $pl = getOdds(2);//赔率
                                }
                                $explain = $stage_num.'期龙虎中'.$v['number'];
                            }
                            break;
                        case 2://定位
                            if(is_numeric($v['number'])){
                                if(in_array($v['number'],$number_arr) &&  $number_arr[($v['wei']-1)] == $v['number']){
                                    $pl = getOdds(3);//赔率
                                    $wei = config('lottery_wei.ssc');
                                    $explain = $stage_num.'期定位中'.$wei[$v['wei']-1].$v['number'];
                                }
                            }else{
                                $dx = sscDxWei($number_arr[($v['wei']-1)]); //判断大小
                                $ds = sscDs($number_arr[($v['wei']-1)]);//判断单双
                                if($v['number'] == $dx || $v['number'] == $ds){
                                    $pl = getOdds(3);//赔率
                                    $wei = config('lottery_wei.ssc');
                                    $explain = $stage_num.'期定位中'.$wei[$v['wei']-1].$v['number'];
                                }
                            }
                            break;
                        case 3://单码
                            if(in_array($v['number'],$number_arr)){
                                $num = substr_count($numbers,$v['number']);
                                if($num ==1){
                                    $pl = getOdds(4);//赔率
                                }elseif ($num==2){
                                    $pl = getOdds(5);//赔率
                                }elseif ($num==3){
                                    $pl = getOdds(6);//赔率
                                }elseif ($num==4){
                                    $pl = getOdds(7);//赔率
                                }elseif ($num==5){
                                    $pl = getOdds(8);//赔率
                                }
                                $explain = $stage_num.'期单码'.$v['number'].'中'.$num;
                            }
                            break;
                        case 4://花样玩法
                            if($v['wei'] == 1){
                                //  豹子
                                if($number_arr[$v['number']-1] == $number_arr[$v['number']] && $number_arr[$v['number']] == $number_arr[$v['number']+1]){
                                    if($v['number'] == 1) {
                                        $wei_str = '前三';
                                        $pl = getOdds(9);//赔率
                                    }elseif ($v['number'] == 2){
                                        $wei_str = '中三';
                                        $pl = getOdds(10);//赔率
                                    }elseif ($v['number'] == 3){
                                        $wei_str = '后三';
                                        $pl = getOdds(11);//赔率
                                    }
                                    $explain = $stage_num.'期花样玩法中'.$wei_str.'豹子';
                                }
                            }elseif ($v['wei'] == 2){ //顺子
                                if(abs($number_arr[$v['number']]-$number_arr[$v['number']-1]) == 1 && abs($number_arr[$v['number']]-$number_arr[$v['number']+1]) == 1){
                                    if($v['number'] == 1) {
                                        $wei_str = '前三';
                                        $pl = getOdds(12);//赔率
                                    }elseif ($v['number'] == 2){
                                        $wei_str = '中三';
                                        $pl = getOdds(13);//赔率
                                    }elseif ($v['number'] == 3){
                                        $wei_str = '后三';
                                        $pl = getOdds(14);//赔率
                                    }
                                    $explain = $stage_num.'期花样玩法中'.$wei_str.'顺子';
                                }
                            }elseif ($v['wei'] == 3){ //对子
                                $arr = [$number_arr[$v['number']-1],$number_arr[$v['number']],$number_arr[$v['number']+1]];
                                $arr_num = array_count_values($arr);
                                if(in_array(2,$arr_num)){
                                    if($v['number'] == 1) {
                                        $wei_str = '前三';
                                        $pl = getOdds(15);//赔率
                                    }elseif ($v['number'] == 2){
                                        $wei_str = '中三';
                                        $pl = getOdds(16);//赔率
                                    }elseif ($v['number'] == 3){
                                        $wei_str = '后三';
                                        $pl = getOdds(17);//赔率
                                    }
                                    $explain = $stage_num.'期花样玩法中'.$wei_str.'对子';
                                }
                            }elseif ($v['wei'] == 4){ //半顺
                                if(abs($number_arr[$v['number']]-$number_arr[$v['number']-1]) == 1 || abs($number_arr[$v['number']]-$number_arr[$v['number']+1]) == 1 || abs($number_arr[$v['number']-1]-$number_arr[$v['number']+1]) == 1){
                                    if($v['number'] == 1) {
                                        $wei_str = '前三';
                                        $pl = getOdds(18);//赔率
                                    }elseif ($v['number'] == 2){
                                        $wei_str = '中三';
                                        $pl = getOdds(19);//赔率
                                    }elseif ($v['number'] == 3){
                                        $wei_str = '后三';
                                        $pl = getOdds(20);//赔率
                                    }
                                    $explain = $stage_num.'期花样玩法中'.$wei_str.'半顺';
                                }

                            }elseif ($v['wei'] == 5){ //杂六
                                if(abs($number_arr[$v['number']]-$number_arr[$v['number']-1]) > 1 && abs($number_arr[$v['number']]-$number_arr[$v['number']+1]) > 1 && abs($number_arr[$v['number']-1]-$number_arr[$v['number']+1]) > 1){
                                    if($v['number'] == 1) {
                                        $wei_str = '前三';
                                        $pl = getOdds(21);//赔率
                                    }elseif ($v['number'] == 2){
                                        $wei_str = '中三';
                                        $pl = getOdds(22);//赔率
                                    }elseif ($v['number'] == 3){
                                        $wei_str = '后三';
                                        $pl = getOdds(23);//赔率
                                    }
                                    $explain = $stage_num.'期花样玩法中'.$wei_str.'杂六';
                                }
                            }

                            break;
                        case 5://大小单双
                            $he = array_sum($number_arr);
                            $dx = sscDx($he); //判断大小
                            $ds = sscDs($he);//判断单双
                            if(strlen($v['number']) > 3){ //组合
                                if($v['number'] == $dx.$ds){
                                    $pl = getOdds(28);//赔率
                                }
                            }else{
                                if($v['number'] == $dx){
                                    if($v['number'] == '大'){
                                        $pl = getOdds(24);//赔率
                                    }elseif ($v['number'] == '小'){
                                        $pl = getOdds(25);//赔率
                                    }
                                }elseif($v['number'] == $ds){
                                    if($v['number'] == '单'){
                                        $pl = getOdds(26);//赔率
                                    }elseif ($v['number'] == '双'){
                                        $pl = getOdds(27);//赔率
                                    }
                                }
                            }
                            $explain = $stage_num.'期大小单双中'.$v['number'];
                            break;
                    }
                    if($pl){
                        if(Db::name('single')->where('id',$v['id'])->update(['state'=>1,'code'=>1,'update_at'=>$time])){
                            Db::name('member')->where('id', $v['uid'])->setInc('money', $v['money']*$pl);
                            $balance = Db::name('member')->where('id', $v['uid'])->value('money');
                            addDetail($v['uid'],1,$v['money']*$pl,$balance,41,$explain);
                        }
                    }else{
                        Db::name('single')->where('id',$v['id'])->update(['state'=>1,'update_at'=>$time]);
                    }
                }
            }
        }
    }
}