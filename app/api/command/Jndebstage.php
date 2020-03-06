<?php
namespace app\api\command;

use think\Config;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class JndebStage extends Command
{
    protected function configure()
    {
        $this->setName('jndebstage')->setDescription('加拿大28期数生成');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    /**
     *加拿大28
     */
    public function doCron(){
        $time1 = strtotime(date('Y-m-d 19:01:00'));
        $time2 = strtotime(date('Y-m-d 19:50:00'));
        $time0 = time();
        $api = Config::get('lottery_api');
        $url = $api['jndeb'];
        if($time0>$time1 && $time0<$time2){
            return json(['code'=>201,'msg'=>'不在设置时间内']);
        }
        $res = httpGet($url);
        $number = json_decode($res, true);
        if($number['rows']){
            foreach ($number['data'] as $k=>$v){
                $a=$v['expect'];
                $b=$v['opentime'];
                break;
            }
        }else{
            return json(['code'=>201,'msg'=>'接口失效']);
        }
        if(empty($b)){
            return json(['code'=>201,'msg'=>'系统繁忙，请稍后再试']);
        }
        $c = time()-strtotime($b);
        $e = $a+1;
        $f = strtotime($b)-20;
        $g = date('Y-m-d H:i:s',$f);
        if($time0>$time2){
            $num = bcdiv(($time1+24*60*60-$f),210,0);
        }else{
            $num = bcdiv(($time1-$f),210,0);
        }
        if(($f+210)<time()){
            return json(['code'=>201,'msg'=>'数据有误，稍后再试']);
        }
        try{
            if($c<=250){
                $d = Db::name('jndeb_stage')->where('stage',$e)->find();
                if($d){
                    return json(['code'=>201,'msg'=>'本轮已生成过,请下轮再来']);
                }
                $obj=new Canada28stage();
                $re = $obj->doCron($g,$e,$num);
                return json(['code'=>200,'msg'=>'成功']);
            }else{
                return json(['code'=>201,'msg'=>'请手动输入参数添加']);
            }
        }catch(\Exception $e){
            return json(['code'=>500,'msg'=>$e->getMessage()]);
        }
    }
}