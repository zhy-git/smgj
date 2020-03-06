<?php
namespace app\api\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Gdsyxwstage extends Command
{
    protected function configure()
    {
        $this->setName('gdsyxwstage')->setDescription('广东11选5期数生成');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    /**
     *广东11选5
     */
    public function doCron(){
        //$start = date('Y-m-d 09:02:00',strtotime("+1 day"));
        $start = date('Y-m-d 09:00:00');
        $startStr = strtotime($start);
        $whereData['start_time'] = $startStr;
        $is = Db::name('gdsyxw_stage')->where($whereData)->value('id');
        if(!$is) {
            $startStage = date('ymd'.'01');
            $fiveStr = 10 * 60;//5分结束时间
            $fiveEndBetStr = 10 * 60 - 30;//截止投注时间
            $arr = array();
            $insertData = array();
            for ($i = 0; $i < 84; $i++) {
                unset($arr);
                $arr['stage'] = $startStage;
                $arr['start_time'] = $startStr;
                $arr['end_time'] = $startStr + $fiveStr;
                $arr['end_bet_time'] = $startStr + $fiveEndBetStr;
                $startStage++;
                $startStr += $fiveStr;
                array_push($insertData, $arr);
            }
            Db::name('gdsyxw_stage')->insertAll($insertData);
        }
    }
}