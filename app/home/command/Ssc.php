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
//            $stage_num = 20171219033;//获取最新一期号
//            $numbers = '3,1,5,9,2';//获取最新开奖号
            $number_arr = explode(',', $numbers);

            $w['stage'] = $stage_num;
            $w['cate'] = 1;
            $w['state'] = 0;
            $w['code'] = 0;
            $list = Db::name('single')->where($w)->select();
            $typeName = '';
            if($list) {
                $time = time();
                foreach ($list as $v){
                    $winNotes = 0;//赢了多少注
                    //计算赔率
                    switch ($v['type']){
                        case 1://三码定位
                            $winNotes = sscDw($v['number'], $number_arr, $v['type']);
                            $typeName = '三码定位';
                            break;
                        case 2://二码定位
                            $winNotes = sscDw($v['number'], $number_arr, $v['type']);
                            $typeName = '二码定位';
                            break;
                        case 3://三码不定位
                            $winNotes = sscBdwd($v['number'], $number_arr, $v['type']);
                            $typeName = '三码不定位';
                            break;
                        case 4://二码不定位
                            $winNotes = sscBdwd($v['number'], $number_arr, $v['type']);
                            $typeName = '二码不定位';
                            break;
                        case 5://四码定位
                            $winNotes = sscDw($v['number'], $number_arr, $v['type']);
                            $typeName = '四码定位';
                            break;
                        case 6://一帆风顺
                            $winNotes = sscQw($v['number'], $number_arr, $v['type']);
                            $typeName = '一帆风顺';
                        break;
                        case 7://好事成双
                            $winNotes = sscQw($v['number'], $number_arr, $v['type']);
                            $typeName = '好事成双';
                        break;
                        case 8://三星报喜
                            $winNotes = sscQw($v['number'], $number_arr, $v['type']);
                            $typeName = '三星报喜';
                        break;
                        case 9://四季发财
                            $winNotes = sscQw($v['number'], $number_arr, $v['type']);
                            $typeName = '四季发财';
                        break;
                        case 10://前三组三
                            $winNotes = sscZusfs($v['number'], $number_arr, $v['type']);
                            $typeName = '前三组三';
                        break;
                        case 11://前三组六
                            $winNotes = sscZusfs($v['number'], $number_arr, $v['type']);
                            $typeName = '前三组六';
                        break;
                        case 12://中三组三
                            $winNotes = sscZusfs($v['number'], $number_arr, $v['type']);
                            $typeName = '中三组三';
                        break;
                        case 13://中三组六
                            $winNotes = sscZusfs($v['number'], $number_arr, $v['type']);
                            $typeName = '中三组六';
                        break;
                        case 14://后三组三
                            $winNotes = sscZusfs($v['number'], $number_arr, $v['type']);
                            $typeName = '后三组三';
                        break;
                        case 15://后三组六
                            $winNotes = sscZusfs($v['number'], $number_arr, $v['type']);
                            $typeName = '后三组六';
                        break;
                    }
                    $pl = getPl($v['cate'],$v['type'],1);
                    if($pl){
                        if($winNotes){
                            //注释
                            $explain = '时时彩'.$typeName.$stage_num.'期，中奖'.$winNotes.'注';
                            $multiple = $v['multiple'];
                            $reMoney = $pl*$winNotes*$multiple;
                            if(Db::name('single')->where('id',$v['id'])->update(['state'=>1,'code'=>1,'update_at'=>$time,'open_number'=>$numbers,'z_money'=>$reMoney])){
                                //Db::name('member')->where('id', $v['uid'])->setInc('money', $reMoney);
                                //$balance = Db::name('member')->where('id', $v['uid'])->value('money');
                                addDetail($v['uid'],1,$reMoney,0,41,$explain);
                            }
                        }else{
                            Db::name('single')->where('id',$v['id'])->update(['state'=>1,'update_at'=>$time,'open_number'=>$numbers]);
                        }
                    }else{
                        Db::name('single')->where('id',$v['id'])->update(['state'=>1,'update_at'=>$time,'open_number'=>$numbers]);
                    }
                }
            }
        }
    }
}