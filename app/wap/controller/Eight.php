<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/11/6
 * Time: 10:33
 */

namespace app\home\controller;


use app\admin\model\Members;
use think\Request;

class Eight extends Home
{
    public function index(){
        $number = getNumberCache('eight');
        $stage= key($number); //获取最新一期的key（即期数）
        $numbers =$number[$stage]; //获取最新开奖号
        $number_arr_s = explode(',',$numbers['number']);
        $number_arr = getEightNum($number_arr_s);
        //计算下次期数 和 开间时间
        $ssc = setEightStageTime($stage,$numbers['dateline']);
        return view('',[
            'stage'=>$stage,
            'stage_next'=>$ssc['stage_next'],
            'number'=>$number_arr,
            'number_sum'=>array_sum($number_arr),
            'dateline'=>$ssc['dateline'],
            'wei'=>config('lottery_wei.eight'),
        ]);
    }

    //获取开奖历史记录
    public function trend(){
        $number = getNumberCache('eight');
        foreach ($number as $k=>$v){
            $number_arr_s = explode(',',$v['number']);
            $number[$k]['number']  = implode(',',getEightNum($number_arr_s));
        }
        return json($number);
    }
    //投注
    public function betting(Request $request){
        $number = $request->post('number');
        $money = $request->post('money');
        $stage = $request->post('stage');
        $type = $request->post('type');
        $zhu = $request->post('zhu');
        //获取会员信息
        $user = Members::get($this->uid);
        if($money*100*$zhu>$user->money){
            $this->error('余额不足,请充值');
        }
        $number=json_decode($number);
        $time = time();
        if($type == 1 || $type == 2 || $type == 3 || $type == 4){
            foreach ($number as $k=>$v){
                $data[]=[
                    'uid'=>$this->uid,
                    'stage'=>$stage,
                    'cate'=>4,
                    'type'=>$type,
                    'number'=>$v,
                    'money'=>$money*100,
                    'create_at'=>$time
                ];
            }
        }elseif($type == 5){
            foreach ($number as $k=>$v){
                if(is_array($v)){
                    if(!empty($v)){
                        foreach ($v as $vo){
                            $data[]=[
                                'uid'=>$this->uid,
                                'stage'=>$stage,
                                'cate'=>4,
                                'type'=>$type,
                                'number'=>$vo,
                                'wei'=>$k+1,
                                'money'=>$money*100,
                                'create_at'=>$time
                            ];
                        }
                    }
                }
            }
        }
        if(Db('single')->insertAll($data)){
            $moneys =  $user->money-($money*100*$zhu);
            Db('member')->where('id',$this->uid)->update(['money'=>$moneys]);
            addDetail($this->uid,2,$money*100*$zhu,$moneys,34,'期数'.$stage);
            $this->success('投注成功');
        }else{
            $this->error('投注失败');
        }
    }
}