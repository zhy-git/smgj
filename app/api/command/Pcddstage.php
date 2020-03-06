<?php
namespace app\api\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Pcddstage extends Command
{
    protected function configure()
    {
        $this->setName('pcddstage')->setDescription('PC蛋蛋期数生成');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    /**
     *PC蛋蛋生成
     */
    public function doCron(){
        //$start = date('Y-m-d 09:02:00',strtotime("+1 day"));
        $start = date('Y-m-d 09:00:00');
        $startStr = strtotime($start);
        $whereData['start_time'] = $startStr;
        $is = Db::name('pcdd_stage')->where($whereData)->value('id');
        if(!$is) {
            $baseStage = 918005;
            $baseTime = '2018-10-29';
            $second1 = strtotime($baseTime);
            $second2 = strtotime(date('Y-m-d'));
            print_r($second2);
            $dayStage = (($second2 - $second1) / 86400-1)*179;
            $startStage = $baseStage + $dayStage + 1;
            $fiveStr = 5 * 60;//5分结束时间
            $fiveEndBetStr = 5 * 60 - 30;//截止投注时间
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
            }
            Db::name('pcdd_stage')->insertAll($insertData);
        }
    }
}