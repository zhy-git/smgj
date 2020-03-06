<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/10/30
 * Time: 14:57
 */

namespace app\api\controller;

use think\Db;
use think\Request;

class Hk extends Base
{
    /**
     * 获取开奖结果
     */

    public function index(){
        $number = getNumberCache('hk');
        $stage= key($number); //获取最新一期的key（即期数）
        $numbers =$number[$stage]; //获取最新开奖号
        $number_arr = explode(',',$numbers['number']);
        //计算下次期数 和 开间时间
        $ssc = setHkStageTime($stage,$numbers['dateline']);

        $dx    = hkdx($number_arr[6]); //判断大小
        $ds    = hkds($number_arr[6]);//判断单双
        $sebo  = hkhll($number_arr[6]);
        $hkwei = hkwei($number_arr[6]);

        
        $detail = $ds.",".$dx.",".$sebo.",".$hkwei;


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
     *获取开奖历史记录
     */
    public function trend(Request $request){
        $page    = $request->post('page')?$request->post('page'):1;

        $limit = 10;

        $start = ($page-1)*$limit;

        $number = Db::name('at_hk')
            ->limit($start,$limit)
            ->order('id desc')
            ->select();
        $total = Db::name('at_hk')->count();
        foreach ($number as $k=>$v){
            $number_arr = explode(',',$v['number']);
            $dx    = hkdx($number_arr[6]); //判断大小
            $ds    = hkds($number_arr[6]);//判断单双
            $sebo  = hkhll($number_arr[6]);
            $hkwei = hkwei($number_arr[6]);
            $detail = $ds.",".$dx.",".$sebo.",".$hkwei;
            $number[$k]['detail']  = $detail;
        }
        $return_data['trend']    = $number;
        $return_data['now_page'] = $page;
        $return_data['per_page'] = $limit;
        $return_data['total_page'] = ceil($total/$limit);

        json_return(200,'成功',$return_data);
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
                        $dx   = hkdx($number_arr[6]);
                        $ds   = hkds($number_arr[6]);
                        $sebo = hkhll($number_arr[6]);
                        $zuhe = $dx.$ds;
                        $wei  = hkwei($number_arr[6]);


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