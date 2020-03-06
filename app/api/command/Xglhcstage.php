<?php
namespace app\api\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;
use think\Cache;

class Xglhcstage extends Command
{ 
    protected function configure()
    {
        $this->setName('xglhcstage')->setDescription('香港六合彩期数生成');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    /**
     *香港六合彩生成
     */
    public function doCron(){
        $startStage = Cache::get('xglhc_stage_new');
        //$startStage = '';
        if(!$startStage){
            $startStage=40;//初始
        }
        $n = sprintf("%03d", ++$startStage);
        $startD = date('Y');
        $map['stage'] = $startD.$n;
        $is = Db::name('xglhc_stage')->where($map)->find();
        $last = Db::name('xglhc_stage')->order('end_time desc')->find();

        if(!$is['id'] && $last['end_time']<=time()) {
            //$endTime = strtotime('2018-03-22 21:35:00');
            //$endTime = strtotime('2018-03-24 21:35:00');
            //$endTime = strtotime('2018-03-27 21:35:00');weikai
            //$endTime = strtotime('2018-03-29 21:35:00');

            //注意下面返回的都是 数字,1234567.
            $w = date('N',time());
            $in = [2,4,6];
            $arr = array();
            if($w==2 || $w==4){
                if(date('Y-m-d 21:35:00')<=date('Y-m-d H:i:s',time())){
                    $endTime = strtotime(date('Y-m-d 21:35:00',strtotime('+2 day')));
                }else{
                    $endTime = strtotime(date('Y-m-d 21:35:00'));
                }                  
            }elseif($w==6){
                if(date('Y-m-d 21:35:00')<=date('Y-m-d H:i:s',time())){
                    $endTime = strtotime(date('Y-m-d 21:35:00',strtotime('+3 day'))); 
                }else{
                    $endTime = strtotime(date('Y-m-d 21:35:00'));
                }                 
            }elseif ($w==1 || $w == 3 || $w == 5) {
                $endTime = strtotime(date('Y-m-d 21:35:00',strtotime('+1 day')));
            }elseif ($w==7) {
                $endTime = strtotime(date('Y-m-d 21:35:00',strtotime('+2 day')));
            }
            $stage = $startD.$n;            
            $arr['stage'] = $stage;
            $arr['start_time'] = time();
            $arr['end_time'] = $endTime;
            $arr['end_bet_time'] = $endTime - 300;
            Db::name('xglhc_stage')->insert($arr);
            Cache::set('xglhc_stage_new', $startStage);           
        }
    }
}