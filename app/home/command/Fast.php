<?php
namespace app\home\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Fast extends Command
{
    protected function configure()
    {
        $this->setName('fast')->setDescription('江苏快3');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    public function doCron(){
        $number = getNumberCache('fast'); //获取最新开奖号
        if($number) {
            $stage_num = key($number);//获取最新一期号
            $value = $number[$stage_num];
            $numbers = $value['number'];//获取最新开奖号
            $number_arr = explode(',', $numbers);
            $w['stage'] = $stage_num;
            $w['cate'] = 6;
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
                        case 1://和值
                            $he = array_sum($number_arr);
                            if($he == $v['number']){
                                if($v['number']== 3 || $v['number'] ==18){
                                    $pl = getOdds(54);//赔率
                                }elseif ($v['number']== 4 || $v['number'] ==17){
                                    $pl = getOdds(55);//赔率
                                }elseif ($v['number']== 5 || $v['number'] ==16){
                                    $pl = getOdds(56);//赔率
                                }elseif ($v['number']== 6 || $v['number'] ==15){
                                    $pl = getOdds(57);//赔率
                                }elseif ($v['number']== 7 || $v['number'] ==14){
                                    $pl = getOdds(58);//赔率
                                }elseif ($v['number']== 8 || $v['number'] ==13){
                                    $pl = getOdds(59);//赔率
                                }elseif ($v['number']== 9 || $v['number'] ==12){
                                    $pl = getOdds(60);//赔率
                                }elseif ($v['number']== 10 || $v['number'] ==11){
                                    $pl = getOdds(61);//赔率
                                }
                                $explain = $stage_num.'期和值中'.$v['number'];
                            }
                            break;
                        case 2://三同号
                            $number_str = implode('',$number_arr);
                            if($v['number'] == $number_str){
                                $pl = getOdds(62);//赔率
                                $explain = $stage_num.'期三同号单选中'.$v['number'];
                            }
                            break;
                        case 3://二同号复选
                            sort($number_arr);
                            $number_str = implode('', $number_arr);
                            if(stripos($number_str,$v['number']) != false){
                                $pl = getOdds(63);//赔率
                                $explain = $stage_num.'期二同号复选中'.$v['number'];
                            }
                            break;
                        case 4://三不同号
                            sort($number_arr);
                            $number_str = implode('', $number_arr);
                            if($number_str == $v['number']){
                                $pl = getOdds(64);//赔率
                                $explain = $stage_num.'期二同号复选中'.$v['number'];
                            }
                            break;
                        case 5://三连号通选
                            sort($number_arr);
                            $number_str = implode('', $number_arr);
                            if($number_str == $v['number']){
                                $pl = getOdds(65);//赔率
                                $explain = $stage_num.'期三连号通选中'.$v['number'];
                            }
                            break;
                    }
                    if($pl){
                        if(Db::name('single')->where('id',$v['id'])->update(['state'=>1,'code'=>1,'update_at'=>$time])){
                            Db::name('member')->where('id', $v['uid'])->setInc('money', $v['money']*$pl);
                            $balance = Db::name('member')->where('id', $v['uid'])->value('money');
                            addDetail($v['uid'],1,$v['money']*$pl,$balance,46,$explain);
                        }
                    }else{
                        Db::name('single')->where('id',$v['id'])->update(['state'=>1,'update_at'=>$time]);
                    }
                }
            }
        }
    }
}