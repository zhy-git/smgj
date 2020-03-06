<?php
namespace app\api\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Msscstage extends Command
{
    protected function configure()
    {
        $this->setName('msscstage')->setDescription('秒速赛车期数生成');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    /**
     *秒速赛车
     */
    public function doCron(){
        $start = date('Y-m-d 00:00:00',strtotime("+1 day"));
        $startStr = strtotime($start);
        $whereData['start_time'] = $startStr;
        $is = Db::name('mssc_stage')->where($whereData)->value('id');
        if(!$is) {
            $startStage = date('ymd'.'0001',strtotime("+1 day"));
            $fiveStr = 60;//结束时间
            $fiveEndBetStr = 60 - 10;//截止投注时间
            $arr = array();
            $insertData = array();
            for ($i = 0; $i < 1440; $i++) {
                unset($arr);
                $arr['stage'] = $startStage;
                $arr['start_time'] = $startStr;
                $arr['end_time'] = $startStr + $fiveStr;
                $arr['end_bet_time'] = $startStr + $fiveEndBetStr;
                $startStage++;
                $startStr += $fiveStr;
                array_push($insertData, $arr);
            }
            Db::name('mssc_stage')->insertAll($insertData);
        }
    }
}