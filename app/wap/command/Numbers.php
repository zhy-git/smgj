<?php

namespace app\home\command;
use think\Cache;
use think\Config;
use think\console\Command;
use think\console\Input;
use think\console\Output;


class Numbers extends Command
{
    protected function configure()
    {
        $this->setName('numbers')->setDescription('获取彩票开奖');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    public function doCron(){
        $api = Config::get('lottery_api');
        foreach ($api as $k=>$v){
            $url = $v;
            $res  = httpGet($url);
            $number = json_decode($res,true);
            if(isset($number)){
                //Cache::store('redis')->set('number_'.$k,$number);
                Cache::set('number_'.$k,$number);
            }
        }
    }
}