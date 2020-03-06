<?php
namespace app\api\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Canada28stage extends Command
{
    protected function configure()
    {
        $this->setName('canada28stage')->setDescription('加拿大28期数生成');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    /**
     *加拿大28期数生成
     */
    public function doCron($start_time,$stage,$num){
        $start = $start_time;
        $startStr = strtotime($start);
        $whereData['start_time'] = $startStr;
        $is = Db::name('jndeb_stage')->where($whereData)->value('id');
        if(!$is) {
            $startStage = $stage;
            $fiveStr = 3 * 60 + 30;//3分半结束时间
            $fiveEndBetStr = 3 * 60 - 20;//截止投注时间 50s
            $arr = array();
            $insertData = array();
            for ($i = 0; $i < $num; $i++) {
                unset($arr);
                $arr['stage'] = $startStage;
                $arr['start_time'] = $startStr;
                $arr['end_time'] = $startStr + $fiveStr;
                $arr['end_bet_time'] = $startStr + $fiveEndBetStr;
                $startStage++;
                $startStr += $fiveStr;
                array_push($insertData, $arr);
            }
            $re = Db::name('jndeb_stage')->insertAll($insertData);
            if($re){
                return json(array('code'=>0,'msg'=>'生成成功！'));
            }else{
                return json(array('code'=>10005,'msg'=>'系统故障'));
            }
        }else{
            return json(array('code'=>10000,'msg'=>'该初始时间已有期号'));
        }
    }
}