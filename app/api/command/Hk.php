<?php
namespace app\api\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Hk extends Command
{
    protected function configure()
    {
        $this->setName('hk')->setDescription('香港六合彩彩兑奖');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    /**
     *开奖
     */
    public function doCron(){
        $number = getNumberCache('hk'); //获取最新开奖号
        if($number) {
            $stage_num  = key($number);//获取最新一期号
            $value      = $number[$stage_num];
            $numbers    = $value['number'];//获取最新开奖号
            $number_arr = explode(',', $numbers);
            $w['stage'] = $stage_num;
            $w['cate']  = 11;
            $w['state'] = 0;
            $w['code']  = 0;
            $list = Db::name('single')->where($w)->select();
            $explain ='';
            if($list) {
                $time = time();
                foreach ($list as $v){
                    $pl =0;
                    if($v['type']>=1 && $v['type']<=4){
                        $dx = hkdx($number_arr[6]);
                        $ds = hkds($number_arr[6]);
                        $sebo = hkhll($number_arr[6]);
                        $zuhe = hkdx($number_arr[6]).hkds($number_arr[6]);
                        $wei = hkwei($number_arr[6]);


                        if($v['number']==$dx ||$v['number']==$ds ||$v['number']==$sebo || $v['number']==$zuhe || $v['number']==$wei){
                            $pl = 1;
                            $explain = $stage_num.'期双面盘中'.$v['number'];
                        }
                    }elseif($v['type']==6) {
                        if ($v['number'] == $number_arr[6]) {
                            $pl = 1;
                            $explain = $stage_num . '期特码中' . $v['number'];
                        }
                    }elseif($v['type']==7) {
                        $new_array = array_pop($number_arr);

                            if (in_array($v['number'],$number_arr)) {
                                $pl = 1;
                                $explain = $stage_num . '期正码中' . $v['number'];

                        }
                    }elseif($v['type']>=8 && $v['type']<=12) {
                        $wei = $v['type']-8;
                        $wei_numner = $number_arr[$wei];
                        $dx   = hkdx($wei_numner);
                        $ds   = hkds($wei_numner);
                        $hdx  = hkhdx($wei_numner);
                        $hds  = hkhds($wei_numner);
                        $sebo = hkhll($wei_numner);
                        $weidx  = hkwei($wei_numner);
                        if ($v['number'] == $dx || $v['number'] == $ds || $v['number'] == $hdx ||$v['number']== $hds ||$v['number']== $sebo||$v['number']== $weidx) {
                            $pl = 1;
                            $explain = $stage_num . '期正码1-6中' . $v['number'];
                        }
                    }

                    $open_number = $numbers;
                    if($pl){
                        $explain = '香港六合彩'.$explain;
                        $odd = getOdds($v['cate'],$v['hall'],$v['type'],$v['number']);
                        if(!$odd){
                            $content = $v['cate'].'---'.$v['type'].'---'.$v['hall'].'---'.$v['number'].'没有赔率';
                            file_put_contents('my_log.txt',$content.PHP_EOL,8);
                        }
                        Db::startTrans();
                        try{
                            $z_money = $v['money'] * $odd;
                            Db::name('single')->where('id',$v['id'])->update(['state'=>1,'code'=>1,'update_at'=>$time,'open_number'=>$open_number,'z_money'=>$z_money]);
                            Db::name('member')->where('id', $v['uid'])->setInc('money', $v['money'] * $odd);
                            $balance = Db::name('member')->where('id', $v['uid'])->value('money');
                            addDetail($v['uid'], 1, $v['money'] * $odd, $balance, 2, $v['cate'], $explain,$v['hall']);
                            Db::commit();
                        }catch (\Exception $e) {
                            Db::rollback();
                        }
                    }else{
                        Db::name('single')->where('id',$v['id'])->update(['state'=>1,'update_at'=>$time,'open_number'=>$open_number]);
                    }
                }
            }
        }
    }
}