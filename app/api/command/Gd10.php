<?php
namespace app\api\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Gd10 extends Command
{
    protected function configure()
    {
        $this->setName('gd10')->setDescription('广东快乐十分彩兑奖');
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
        $number = getNumberCache('gd10'); //获取最新开奖号
        if($number) {
            $stage_num  = key($number);//获取最新一期号
            $value      = $number[$stage_num];
            $numbers    = $value['number'];//获取最新开奖号
            $number_arr = explode(',', $numbers);
            $w['stage'] = $stage_num;
            $w['cate']  = 7;
            $w['state'] = 0;
            $w['code']  = 0;
            $list = Db::name('single')->where($w)->select();
            $explain ='';
            if($list) {
                $time = time();
                foreach ($list as $v){
                    $pl =0;
                    if($v['type']>=1 && $v['type']<=8){
                        $xu = $v['type']-1;
                        $dx = gd10dx($number_arr[$xu]);
                        $ds = gd10ds($number_arr[$xu]);
                        $weidx = Zgd10weids($number_arr[$xu]);
                        $weids = Zgd10weidx($number_arr[$xu]);
                        if($v['type']>=1 && $v['type']<=4) {
                        $lf = gd10lh($number_arr,$v['type']);
                        }else{
                        $lf = "无";
                        }
                        if($v['number']==$dx ||$v['number']==$ds ||$v['number']==$weidx || $v['number']==$weids || $v['number']==$lf){
                            $pl = 1;
                            $explain = $stage_num.'期大小单双龙虎中'.$v['number'];
                        }
                    }elseif(in_array($v['type'],array(9,11,13,15,17,19,21,23))) {
                        $xz_array = ['9'=>0, '11'=>1, '13'=>2, '15'=>3, '17'=>4, '19'=>5, '21'=>6, '23'=>7];
                        $xu_hao = $xz_array[$v['type']];
                        $tm_number = $number_arr[$xu_hao];
                        if ($v['number'] == $tm_number) {
                            $pl = 1;
                            $explain = $stage_num . '期特码中' . $v['number'];
                        }
                    }elseif(in_array($v['type'],array(10,12,14,16,18,20,22,24))) {
                        $xz_array = ['10'=>0, '12'=>1, '14'=>2, '16'=>3, '18'=>4, '20'=>5, '22'=>6, '24'=>7];
                        $xu_hao = $xz_array[$v['type']];
                        $tm_number = $number_arr[$xu_hao];
                        $gd10fx  = gd10fx($tm_number);
                        $gd10zfb = gd10fx($tm_number);
                            if ($v['number'] == $gd10fx || $v['number'] == $gd10zfb) {
                                $pl = 1;
                                $explain = $stage_num . '期东西南北中' . $v['number'];

                        }
                    }elseif($v['type']==25) {
                        $he = array_sum($number_arr);
                        $Zgd10dx    = Zgd10dx($he);
                        $Zgd10ds    = Zgd10ds($he);
                        $Zgd10weids = Zgd10weids($he);
                        $Zgd10weidx = Zgd10weidx($he);
                        $Zgd10lh    = Zgd10lh($he);
                        if ($v['number'] == $Zgd10dx || $v['number'] == $Zgd10ds || $v['number'] == $Zgd10weids ||$v['number']== $Zgd10weidx ||$v['number']== $Zgd10lh) {
                            $pl = 1;
                            $explain = $stage_num . '期总和龙虎中' . $v['number'];
                        }
                    }

                    $open_number = $numbers;
                    if($pl){
                        $explain = '广东快乐十分'.$explain;
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