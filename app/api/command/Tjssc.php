<?php
namespace app\api\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Tjssc extends Command
{
    protected function configure()
    {
        $this->setName('tjssc')->setDescription('天津时时彩兑奖');
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
        $number = getNumberCache('tjssc'); //获取最新开奖号
        if($number) {
            $stage_num  = key($number);//获取最新一期号
            $value      = $number[$stage_num];
            $numbers    = $value['number'];//获取最新开奖号
            $number_arr = explode(',', $numbers);
            $w['stage'] = $stage_num;
            $w['cate']  = 6;
            $w['state'] = 0;
            $w['code']  = 0;
            $list = Db::name('single')->where($w)->select();


            $explain ='';
            if($list) {
                $time = time();
                foreach ($list as $v){
                    $pl =0;
                    if($v['type']==1){
                        $he = array_sum($number_arr);
                        $dx = zSscDx($he);
                        $ds = zSscDs($he);
                        $longfu = sscLh($number_arr);
                        if($v['number']==$dx ||$v['number']==$ds ||$v['number']==$longfu){
                            $pl = 1;
                            $explain = $stage_num.'期龙虎和中'.$v['number'];
                        }
                    }elseif($v['type']==2) {
                        $result_niu = niuNiu($number_arr);

                        if ($v['number'] == $result_niu) {
                            $pl = 1;
                            $explain = $stage_num . '期牛牛中' . $v['number'];
                        }
                    }elseif($v['type']==3) {
                        $result_niu = niuNiu($number_arr);
                        if($result_niu!="无牛") {
                            $sm_dx = sm_dx($result_niu);
                            $sm_ds = sm_ds($result_niu);
                            $sm_zh = sm_zh($result_niu);
                            if ($v['number'] == $sm_dx || $v['number'] == $sm_ds || $v['number'] == $sm_zh) {
                                $pl = 1;
                                $explain = $stage_num . '期牛牛双面中' . $v['number'];
                            }
                        }
                    }elseif($v['type']==4) {
                        $result_niu = nn_sh($number_arr);

                        if ($v['number'] == $result_niu) {
                            $pl = 1;
                            $explain = $stage_num . '期牛牛梭哈中' . $v['number'];
                        }
                    }elseif($v['type']>=5 && $v['type']<=14) {
                        $target = "";
                        if($v['type']==5 || $v['type']==6){

                            $target = $number_arr[0];
                        }elseif($v['type']==7 ||$v['type']==8 ){

                            $target = $number_arr[1];
                        }elseif($v['type']==9 || $v['type']==10 ){

                            $target = $number_arr[2];
                        }elseif($v['type']==11 || $v['type']==12 ){

                            $target = $number_arr[3];
                        }elseif($v['type']==13 ||$v['type']==14 ){

                            $target = $number_arr[4];
                        }
                        $dx = sscDx($target); //判断大小
                        $ds = sscDs($target);//判断单双
                        if ($v['number'] == $target ||$v['number'] == $dx ||$v['number'] == $ds) {
                            $pl = 1;
                            $explain = $stage_num . '期数字盘中' . $v['number'];
                        }
                    }elseif(in_array($v['type'],array(15,16,17))){
                        $first_three = "";
                        if($v['type']==15){
                            $first_three = take_three($number_arr,0);
                        }
                        if($v['type']==16){
                            $first_three = take_three($number_arr,1);
                        }
                        if($v['type']==17){
                            $first_three = take_three($number_arr,1);
                        }
                        $r_first_three = judge_three($first_three);
                        if ($v['number'] == $r_first_three ) {
                            $pl = 1;
                            $explain = $stage_num . '期数字盘中' . $v['number'];
                        }
                    }
                    $open_number = $numbers;
                    if($pl){
                        $explain = '天津时时彩'.$explain;
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