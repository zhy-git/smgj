<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/9/16
 * Time: 9:27
 */

namespace app\admin\controller;


use think\Config;
use think\Request;

class Rebate extends Admin
{
    public function index(){
        $rebate =  new \app\admin\model\Rebate();
        $list = $rebate->select();
        return view('',[
            'list'=>$list
        ]);
    }
    public function edit(Request $request){
        $tuozhu_rebate =$request->post('tuozhu_rebate');
        $jieshao_rebate =$request->post('jieshao_rebate');
        if(!$tuozhu_rebate){
            $this->error('请输入投注返点');
        }
        if(!$jieshao_rebate){
            $this->error('请输入介绍返点');
        }
        $data=[
            ['id'=>1,'val'=>$tuozhu_rebate],
            ['id'=>2,'val'=>$jieshao_rebate],
        ];
        $rebate =  new \app\admin\model\Rebate();
        $res = $rebate->isUpdate(true)->saveAll($data);
        if($res){
            $this->success('保持成功');
        }else{
            $this->error('保持失败');
        }
    }
}