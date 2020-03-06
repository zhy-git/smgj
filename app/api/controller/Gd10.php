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

class Gd10 extends Base
{
    /**
     * 获取开奖结果
     */
    public function index(){
        $number = getNumberCache('gd10');
        $stage= key($number); //获取最新一期的key（即期数）
        $numbers =$number[$stage]; //获取最新开奖号
        $number_arr = explode(',',$numbers['number']);
        //计算下次期数 和 开间时间
        $ssc = setgd10StageTime($stage,$numbers['dateline']);
        $ling = array_sum($number_arr);//冠亚军和值
        $yi  = Zgd10dx($ling); //判断大小
        $er  = Zgd10ds($ling);//判断单双
        $san = Zgd10weidx($ling);//判断龙虎
        $si  = Zgd10weids($ling);//判断龙虎
        $detail = $ling.",".$yi.",".$er.",".$san.",". $si;
        $data = ['stage'=>$stage,
            'stage_next'=>$ssc['stage_next'],
            'number'=>$number_arr,
            'number_sum'=>$number_arr[0] + $number_arr[1],
            'dateline'=>$ssc['dateline'],
            'lottery_time'=>$ssc['dateline']+30,
           // 'wei'=>config('lottery_wei.car'),
            'detail'=>$detail
        ];
        json_return(200,'成功',$data);
    }
    
    
    /**
     *获取开奖历史记录
     */
    public function trend(Request $request){
        $page    = $request->post('page')?$request->post('page'):1;
        $limit = 10;
        $start = ($page-1)*$limit;
        $number = Db::name('at_gd10')
            ->limit($start,$limit)
            ->order('id desc')
            ->select();
        $total = Db::name('at_gd10')->count();

        foreach ($number as $k=>$v){
            $number_arr = explode(',',$v['number']);
            $ling = array_sum($number_arr);//冠亚军和值
            $yi  = Zgd10dx($ling); //判断大小
            $er  = Zgd10ds($ling);//判断单双
            $san = Zgd10weidx($ling);//判断龙虎
            $si  = Zgd10weids($ling);//判断龙虎
            $detail = $ling.",".$yi.",".$er.",".$san.",". $si;
            $number[$k]['detail']  = $detail;
        }
        $return_data['trend']      = $number;
        $return_data['now_page']   = $page;
        $return_data['per_page']   = $limit;
        $return_data['total_page'] =  ceil($total/$limit);

        json_return(200,'成功',$return_data);
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
                    $odd = getOdds($v['cate'],$v['hall'],$v['type'],$v['number']);
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