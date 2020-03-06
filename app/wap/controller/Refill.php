<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/9/6
 * Time: 11:45
 */

namespace app\home\controller;


use think\Db;
use think\Request;

class Refill extends Home
{
    /*充值
     * */
    public function index(){
        return view();
    }
    /*add
     * */
    public function add(Request $request){
        $money = $request->post('money');
        $name = $request->post('name');
        $remark = $request->post('remark');
        if(!$money){
            $this->error('请输入支付金额');
        }
        if(!$name){
            $this->error('请输入转账昵称');
        }
        $data=[
            'uid'=>$this->uid,
            'money'=>$money*100,
            'name'=>$name,
            'remark'=>$remark,
            'create_at'=>time(),
        ];
        $res = Db::name('recharge')->insert($data);
        if($res){
            $this->success('充值提交成功');
        }else{
            $this->error('充值提交失败');
        }
    }
}