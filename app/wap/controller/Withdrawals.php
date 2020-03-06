<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/9/6
 * Time: 11:55
 */

namespace app\home\controller;


use app\admin\model\Members;
use think\Db;
use think\Request;

class Withdrawals extends Home
{
    public function index(){
        $member = Members::get($this->uid);
        $money = $member->money;
        $list = Db::name('cash')->where('uid',$this->uid)->order('create_at desc')->limit(10)->select();
        return view('',[
            'money' =>$money/100,
            'list' =>$list,
            ]);
    }
    public function add(Request $request){
        $money = $request->post('money');
        if(!$money){
            $this->error('请输入支付金额');
        }
        $member = Members::get($this->uid);
        $money_new = $member->money - ($money*100);
        if($money_new <= 0){
            $this->error('可提金额不足');
        }
        $data=[
            'uid'=>$this->uid,
            'money'=>$money*100,
            'create_at'=>time(),
        ];
        $res = Db::name('cash')->insert($data);
        if($res){
            $member->money= $money_new;
            $member->save();
            addDetail($this->uid,2,$money*100,$money_new,2,'提现');
            $this->success('提交成功');
        }else{
            $this->error('提交失败');
        }
    }
}