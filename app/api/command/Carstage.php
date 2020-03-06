<?php
namespace app\api\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Carstage extends Command
{
    protected function configure()
    {
        $this->setName('carstage')->setDescription('北京PK10期数生成');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    /**
     *北京PK10生成
     */
    public function doCron(){
//        //$start = date('Y-m-d 09:02:00',strtotime("+1 day"));
//        $start = date('Y-m-d 09:02:00');
//        $startStr = strtotime($start);
//        $whereData['start_time'] = $startStr;
//        $is = Db::name('car_stage')->where($whereData)->value('id');
//        if(!$is) {
//            $startStage = Db::name('car_stage')->order('id desc')->value('stage');
//            $fiveStr = 5 * 60;//5分结束时间
//            $fiveEndBetStr = 5 * 60 - 30;//截止投注时间
//            $arr = array();
//            $insertData = array();
//            $startStage++;
//            for ($i = 0; $i < 179; $i++) {
//                unset($arr);
//                $arr['stage'] = $startStage;
//                $arr['start_time'] = $startStr;
//                $arr['end_time'] = $startStr + $fiveStr;
//                $arr['end_bet_time'] = $startStr + $fiveEndBetStr;
//                $startStage++;
//                $startStr += $fiveStr;
//                array_push($insertData, $arr);
//            }
//            Db::name('car_stage')->insertAll($insertData);
//        }
        //$start = date('Y-m-d 09:02:00',strtotime("+1 day"));
        $start = date('Y-m-d 09:02:00');
        $startStr = strtotime($start);
        $whereData['start_time'] = $startStr;
        $is = Db::name('car_stage')->where($whereData)->value('id');
        if(!$is) {
            $baseStage = 662071;
            $baseTime = '2018-03-04';
            $second1 = strtotime($baseTime);
            $second2 = strtotime(date('Y-m-d'));
            $dayStage = (($second2 - $second1) / 86400-1)*179; //一天总共开奖179期。
            $startStage = $baseStage + $dayStage + 1;  
            $fiveStr = 20 * 60;//5分结束时间
            $fiveEndBetStr = 20 * 60 - 30;//截止投注时间
            $arr = array();
            $insertData = array();
            for ($i = 0; $i < 179; $i++) {
                unset($arr);
                $arr['stage'] = $startStage;
                $arr['start_time'] = $startStr;
                $arr['end_time'] = $startStr + $fiveStr;
                $arr['end_bet_time'] = $startStr + $fiveEndBetStr;
                $startStage++;
                $startStr += $fiveStr;
                array_push($insertData, $arr);
                var_dump(date('Y-m-d h:i:s',$arr['start_time'])); 
                var_dump(date('Y-m-d h:i:s',$arr['end_time']));
            }die();
            Db::name('car_stage')->insertAll($insertData);
        }
    }
}