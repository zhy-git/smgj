<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/9/9
 * Time: 15:23
 */

namespace app\home\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;


class OpenHorse extends Command
{
    protected function configure()
    {
        $this->setName('openHorse')->setDescription('香港赛马开奖号');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->open();
    }
    public static function open(){
        $number_arr = openHorse();
        $number_str = implode(',',$number_arr);
        $time = strtotime(date('Ymd').' 09:02:00');
        $num = ceil((time()-$time)/300);
        $open_at = $num*300+$time;
        $cha = abs(time()-$open_at);
        dump($cha);
        dump($num);
        if($cha<=30){
            if($num <= 179){
                if($num<10){
                    $stage = date('Ymd').'00'.$num;
                }elseif ($num<100){
                    $stage = date('Ymd').'0'.$num;
                }else{
                    $stage = date('Ymd').$num;
                }
                $res = Db::name('horse')->where('stage',$stage)->find();
                if(!$res){
                    $data=[
                        'stage'=>$stage,
                        'number'=>$number_str,
                        'open_at'=>date('Y-m-d H:i:s',$open_at),
                        'create_at'=>time()
                    ];
                    Db::name('horse')->insert($data);
                }
            }
        }
    }
}