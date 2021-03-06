<?php
namespace app\api\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Sscstage extends Command
{
    protected function configure()
    {
        $this->setName('sscstage')->setDescription('重庆时时彩期数生成');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    /**
     *时时彩生成
     */
    public function doCron(){
        $startStage = 24;
        $n = sprintf("%03d", $startStage);
        $startD = date('Ymd');
        $w['stage'] = $startD.$n;
        $isData = Db::name('ssc_stage')->where($w)->field('id')->find();
        if(!$isData) {
            $start = date('Y-m-d 09:50:00');
            $startStr = strtotime($start);
            $endTen = date('Y-m-d 22:00:00');
            $endTenStr = strtotime($endTen);
            $secDate = date("Ymd",strtotime("$start   +1   day"));
            $tenStr = 10 * 60;//10分结束时间
            //$tenEndBetStr = 10*60-30;//10分截止投注时间
            $fiveStr = 5 * 60;//5分结束时间
            //$fiveEndBetStr = 5*60-30;//5分截止投注时间
            $arr = array();
            $insertData = array();
            for ($i = 0; $i < 120; $i++) {
                unset($arr);
                if ($startStage > 120) {
                    $startStage = 1;
                    $startD = $secDate;
                }
                $startStageNum = sprintf("%03d", $startStage);
                $arr['stage'] = $startD . $startStageNum;
                $arr['start_time'] = $startStr;
                if ($startStr >= $endTenStr) {
                    $startStr = $startStr + $fiveStr;
                    $endStr = $startStr;
                    $endBetStr = $endStr - 30;
                } else {
                    $startStr = $startStr + $tenStr;
                    $endStr = $startStr;
                    $endBetStr = $endStr - 30;
                }
                $startStage++;
                $arr['end_time'] = $endStr;
                $arr['end_bet_time'] = $endBetStr;
                array_push($insertData, $arr);
            }
            Db::name('ssc_stage')->insertAll($insertData);
        }
    }
}