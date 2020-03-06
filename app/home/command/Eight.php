<?php
namespace app\home\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Eight extends Command
{
    protected function configure()
    {
        $this->setName('eight')->setDescription('pc蛋蛋');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    public function doCron(){
        $number = getNumberCache('eight'); //获取最新开奖号
        if($number) {
            $stage_num = key($number);//获取最新一期号
            $value = $number[$stage_num];
            $numbers = $value['number'];//获取最新开奖号
            $number_arr_s = explode(',',$numbers);
            $number_arr = getEightNum($number_arr_s);
            $he = array_sum($number_arr);
            $w['stage'] = $stage_num;
            $w['cate'] = 4;
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
                        case 1://猜组合
                            $dx = eightDx($he); //判断大小
                            $ds = eightDs($he);//判断单双
                            if($v['number'] == $dx.$ds){
                                if($v['number'] == '大单'){
                                    $pl = getOdds(47);//赔率
                                }elseif($v['number'] == '小单'){
                                    $pl = getOdds(48);//赔率
                                }elseif($v['number'] == '大双'){
                                    $pl = getOdds(49);//赔率
                                }elseif($v['number'] == '小'){
                                    $pl = getOdds(50);//赔率
                                }
                                $explain = $stage_num.'期猜组合中'.$v['number'];
                            }
                            break;
                        case 2://猜特码
                            if($he == $v['number']){
                                $pl = getOdds(51);//赔率
                                $explain = $stage_num.'期猜特码中'.$v['number'];
                            }
                            break;
                        case 3://大小单双
                            $dx = eightDx($he); //判断大小
                            $ds = eightDs($he);//判断单双
                            if($v['number'] == $dx){
                                if($v['number'] == '大'){
                                    $pl = getOdds(52);//赔率
                                }elseif ($v['number'] == '小'){
                                    $pl = getOdds(52);//赔率
                                }
                            }elseif($v['number'] == $ds){
                                if($v['number'] == '单'){
                                    $pl = getOdds(52);//赔率
                                }elseif ($v['number'] == '双'){
                                    $pl = getOdds(52);//赔率
                                }
                            }
                            $explain = $stage_num.'期大小单双中'.$v['number'];
                            break;
                        case 4://极大极小
                            if($he >=22 && $he<=27 && $v['number']=='极大'){
                                $pl = getOdds(53);//赔率
                            }elseif ($he >=0 && $he<=5 && $v['number']=='极小'){
                                $pl = getOdds(53);//赔率
                            }
                            $explain = $stage_num.'期大小单双中'.$v['number'];
                            break;
                    }
                    if($pl){
                        if(Db::name('single')->where('id',$v['id'])->update(['state'=>1,'code'=>1,'update_at'=>$time])){
                            Db::name('member')->where('id', $v['uid'])->setInc('money', $v['money']*$pl);
                            $balance = Db::name('member')->where('id', $v['uid'])->value('money');
                            addDetail($v['uid'],1,$v['money']*$pl,$balance,44,$explain);
                        }
                    }else{
                        Db::name('single')->where('id',$v['id'])->update(['state'=>1,'update_at'=>$time]);
                    }
                }
            }
        }
    }
}