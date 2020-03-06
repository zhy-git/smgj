<?php
namespace app\api\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Jsksstage extends Command
{
    protected function configure()
    {
        $this->setName('jsksstage')->setDescription('江苏快三期数生成');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    /**
     *江苏快三生成
     */
    public function doCron(){
        //$start = date('Y-m-d 09:02:00',strtotime("+1 day"));
        $start = date('Y-m-d 08:28:00');
        $startStr = strtotime($start);
        $whereData['start_time'] = $startStr;
        $is = Db::name('jsks_stage')->where($whereData)->value('id');
        if(!$is) {
            $startStage = date('ymd'.'001');
            $fiveStr = 10 * 60;//5分结束时间
            $fiveEndBetStr = 10 * 60 - 30;//截止投注时间
            $arr = array();
            $insertData = array();
            for ($i = 0; $i < 82; $i++) {
                unset($arr);
                $arr['stage'] = $startStage;
                $arr['start_time'] = $startStr;
                $arr['end_time'] = $startStr + $fiveStr;
                $arr['end_bet_time'] = $startStr + $fiveEndBetStr;
                $startStage++;
                $startStr += $fiveStr;
                array_push($insertData, $arr);
            }
            Db::name('jsks_stage')->insertAll($insertData);
        }
    }
}