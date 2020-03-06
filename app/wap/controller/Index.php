<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/10/30
 * Time: 11:08
 */
namespace app\wap\controller;
use think\Db;
class Index extends Home
{
    public function index(){
        $memMoney = Db::name('member')->where('id',$this->uid)->field('money,ag_money,unpaid_money,bb_money')->find();
        $memInfo = session('member_info');
        $noticeList = Db::name('notice')->order('id desc')->limit(10)->select();
        foreach ($noticeList as $k=>$v){
            $noticeList[$k]['time'] = date('m/d',strtotime($v['create_time']));
        }
        return view('',[
            'noticeList'=>$noticeList,
            'memMoney'=>$memMoney,
            'memInfo'=>$memInfo
        ]);
    }
}