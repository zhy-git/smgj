<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/9/4
 * Time: 9:36
 */

namespace app\admin\controller;


use app\admin\model\Bet;
use app\admin\model\Odds;
use think\Cache;
use think\Request;
use think\Db;

class Advertise extends Admin
{
    /**
     * 广告首页
     */
   public function index(){
       $data = Db::name('advertise')->select();
       return view('index',[
           'data'=>$data
       ]);
   }

    /**
     * 编辑广告
     */
    public function edit(Request $request){
        if($request->isPost()){
            $data = $request->post();
            $map=array(
                'id'=>$data['id']
            );
            $result=Db::name('advertise')->where($map)->update($data);
            if ($result) {
                $this->success_new('修改成功');
            }else{
                $this->error_new('修改失败');
            }
        }else{
            $cate     = $request->param('id');
            $data     = Db::name('advertise')->where(array('id'=>$cate))->find();
            return view('edit',[
                'data'=>$data,
            ]);
        }
    }

}