<?php
namespace app\api\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Xyftstage extends Command
{
    protected function configure()
    {
        $this->setName('xyftstage')->setDescription('幸运飞艇期数生成');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    /**
     *幸运飞艇
     */
    public function doCron(){
        //$start = date('Y-m-d 09:02:00',strtotime("+1 day"));
        $start = date('Y-m-d 13:03:30');
        $startStr = strtotime($start);
        $whereData['start_time'] = $startStr;
        $is = Db::name('xyft_stage')->where($whereData)->value('id');
        if(!$is) {
            $startStage = date('Ymd'.'001');
            $fiveStr = 5 * 60;//5分结束时间
            $fiveEndBetStr = 5 * 60 - 30;//截止投注时间
            $arr = array();
            $insertData = array();
            for ($i = 0; $i < 180; $i++) {
                unset($arr);
                $arr['stage'] = $startStage;
                $arr['start_time'] = $startStr;
                $arr['end_time'] = $startStr + $fiveStr;
                $arr['end_bet_time'] = $startStr + $fiveEndBetStr;
                $startStage++;
                $startStr += $fiveStr;
                array_push($insertData, $arr);
            }
            Db::name('xyft_stage')->insertAll($insertData);
        }
    }
}