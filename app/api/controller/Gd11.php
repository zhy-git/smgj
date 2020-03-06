<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/11/4
 * Time: 14:21
 */

namespace app\api\controller;


use app\admin\model\Members;
use think\Db;
use think\Request;

class Gd11 extends Base
{
    /**
     * 获取开奖结果
     */
    public function index(){
        $number = getNumberCache('gd11');
        $stage= key($number); //获取最新一期的key（即期数）
        $numbers =$number[$stage]; //获取最新开奖号
        $number_arr = explode(',',$numbers['number']);
        //计算下次期数 和 开间时间
        $ssc = setgd11StageTime($stage,$numbers['dateline']);
        $ling = array_sum($number_arr);//冠亚军和值
        $yi  = gd11zdx($ling); //判断大小
        $er  = gd11ds($ling);//判断单双
        $san = gd11lf($number_arr);//判断龙虎

        $detail = $ling.",".$yi.",".$er.",".$san;
        $data = ['stage'=>$stage,
            'stage_next'=>$ssc['stage_next'],
            'number'=>$number_arr,
            'number_sum'=>$number_arr[0] + $number_arr[1],
            'dateline'=>$ssc['dateline'],
            'lottery_time'=>$ssc['dateline']+30,
            'detail'=>$detail
        ];
        json_return(200,'成功',$data);
    }


    /**
     * 获取开奖历史记录
     */
    public function trend(Request $request){
        $page    = $request->post('page')?$request->post('page'):1;

        $limit = 10;

        $start = ($page-1)*$limit;

        $number = Db::name('at_gd11')
            ->limit($start,$limit)
            ->order('id desc')
            ->select();
        $total = Db::name('at_gd11')->count();

        foreach ($number as $k=>$v){
            $number_arr = explode(',',$v['number']);

            $ling = array_sum($number_arr);//冠亚军和值
            $yi  = gd11zdx($ling); //判断大小
            $er  = gd11ds($ling);//判断单双
            $san = gd11lf($number_arr);//判断龙虎
            $detail = $ling.",".$yi.",".$er.",".$san;
            $number[$k]['detail']  = $detail;
        }
        $return_data['trend']    = $number;
        $return_data['now_page'] = $page;
        $return_data['per_page'] = $limit;
        $return_data['total_page'] = ceil($total/$limit);

        json_return(200,'成功',$return_data);
    }


    /**
     * 手动开奖
     */
    public function doCron(){
        $number = getNumberCache('gd11'); //获取最新开奖号
        if($number) {
            $stage_num  = key($number);//获取最新一期号
            $value      = $number[$stage_num];
            $numbers    = $value['number'];//获取最新开奖号
            $number_arr = explode(',', $numbers);
            $w['stage'] = $stage_num;
            $w['cate']  = 10;
            $w['state'] = 0;
            $w['code']  = 0;
            $list = Db::name('single')->where($w)->select();
            
            $explain ='';
            if($list) {
                $time = time();
                foreach ($list as $v){
                    $pl =0;
                    if($v['type']>=1 && $v['type']<=5){
                        $xu = $v['type']-1;
                        $dx = gd11dx($number_arr[$xu]);
                        $ds = gd11ds($number_arr[$xu]);
                        if($v['number']==$dx ||$v['number']==$ds){
                            $pl = 1;
                            $explain = $stage_num.'期大小单双中'.$v['number'];
                        }
                    }elseif($v['type']==6) {
                        $he = array_sum($number_arr);
                        $dx = gd11zdx($he);
                        $ds = gd11d($he);
                        $lf = gd11lf($number_arr);
                        if ($v['number']==$dx ||$v['number']==$ds || $v['number']==$lf) {
                            $pl = 1;
                            $explain = $stage_num . '期总大小龙虎中' . $v['number'];
                        }
                    }elseif($v['type']>=7 && $v['type']<=10) {

                        $c_number = $v['number'];
                        $c_array  = explode(',',$c_number);
                        if (is_in($c_array,$number_arr)) {
                            $pl = 1;
                            $explain = $stage_num . '期任选中' . $v['number'];

                        }
                    }elseif($v['type']>11 && $v['type']<=13) {
                        $c_number = $v['number'];
                        $c_array = explode(',', $c_number);
                        if (is_in($number_arr,$c_array)) {
                            $pl = 1;
                            $explain = $stage_num . '期任选中' . $v['number'];

                        }
                    }elseif($v['type']==14) {
                        $first_two[] = $number_arr[0];
                        $first_two[] = $number_arr[1];
                        $c_number = $v['number'];
                        $c_array = explode(',', $c_number);
                        if (in_array($c_array[0],$first_two) && in_array($c_array[1],$first_two)) {
                            $pl = 1;
                            $explain = $stage_num . '期前二组中' . $v['number'];

                        }
                    }elseif($v['type']==15) {
                        $first_two[] = $number_arr[0];
                        $first_two[] = $number_arr[1];
                        $c_number = $v['number'];
                        $c_array = explode(',', $c_number);
                        if ($c_array[0]==$first_two[0] && $c_array[1]==$first_two[1]) {
                            $pl = 1;
                            $explain = $stage_num . '期前二直中' . $v['number'];

                        }
                    }elseif($v['type']==16) {
                        $first_three[] = $number_arr[0];
                        $first_three[] = $number_arr[1];
                        $first_three[] = $number_arr[2];
                        $c_number = $v['number'];
                        $c_array = explode(',', $c_number);
                        if (in_array($c_array[0],$first_three) && in_array($c_array[1],$first_three) && in_array($c_array[2],$first_three[2])) {
                            $pl = 1;
                            $explain = $stage_num . '期前三组中' . $v['number'];

                        }
                    }elseif($v['type']==17) {
                        $first_three[] = $number_arr[0];
                        $first_three[] = $number_arr[1];
                        $first_three[] = $number_arr[2];
                        $c_number = $v['number'];
                        $c_array = explode(',', $c_number);
                        if ($c_array[0]==$first_three[0] && $c_array[1]==$first_three[1] && $c_array[2]==$first_three[2]) {
                            $pl = 1;
                            $explain = $stage_num . '期前三直中' . $v['number'];

                        }
                    }elseif($v['type']>=18 && $v['type']<=22 ) {
                        $wei = $v['type']-18;
                        $wei_number = $number_arr[$wei];
                        if ($wei_number==$v['number']) {
                            $pl = 1;
                            $explain = $stage_num . '期特码中' . $v['number'];
                        }
                    }
                    if($v['type']>=7 && $v['type']<=17){
                        $odd = getOdds($v['cate'],$v['hall'],$v['type'],1);
                    }else {
                        $odd = getOdds($v['cate'], $v['hall'], $v['type'], $v['number']);
                    }
                    if(!$odd){
                        $content = $v['cate'].'---'.$v['type'].'---'.$v['hall'].'---'.$v['number'].'没有赔率';
                        file_put_contents('my_log.txt',$content.'\r\n"',8);
                    }
                    $open_number = $numbers;
                    if($pl){
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