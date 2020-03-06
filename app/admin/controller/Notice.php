<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/9/30
 * Time: 9:58
 */

namespace app\admin\controller;


use app\admin\model\Members;
use app\admin\model\PersonalMsg;
use think\Db;
use think\Request;

class Notice extends Admin
{
    /**
     * 个人公告
     */
    public function personal(Request $request){
        $mobile = $request->param('mobile');
        $w = [];
        if($mobile){
            $uid = Members::where(array('mobile'=>$mobile))->value('id');
            $w['uid'] = $uid;
        }
        $data = PersonalMsg::where($w)->order('id desc')->paginate(20);
        return view('personal',[
            'page'=>$data->render(),
            'data'=>$data,
        ]);
    }
    /**
     * 系统公告
     */
    public function system(){

        $data = Db::name('notice')->order('id desc')->paginate(20);
        return view('system',[
            'page'=>$data->render(),
            'data'=>$data,
        ]);
    }

    /**
     * 添加系统通知
     */
    public function add_system(Request $request){
        $info = $request->post('info');
        $title = $request->post('title');
        $data['info'] = $info;
        $data['title'] = $title;
        $result = Db::name('notice')->insert($data);
        if ($result) {
            $this->success_new('添加成功',url('Admin/notice/system'));
        }else{
            $this->error_new('修改失败');
        }
    }
    /**
     * 编辑系统通知
     */
    public function system_show(Request $request){
            $cate     = $request->param('id');
            $data     = Db::name('notice')->where(array('id'=>$cate))->find();
            return view('system_edit',[
                'data'=>$data,
            ]);

    }
    /**
     * 编辑系统通知
     */
    public function system_edit(Request $request){
        if($request->isPost()){
            $data = $request->post();
            $map=array(
                'id'=>$data['id']
            );
            $result=Db::name('notice')->where($map)->update($data);
            if ($result) {
                $this->success_new('修改成功',url('Admin/notice/system'));
            }else{
                $this->error_new('修改失败');
            }
        }else{
            $cate     = $request->param('id');
            $data     = Db::name('notice')->where(array('id'=>$cate))->find();
            return view('system_edit',[
                'data'=>$data,
            ]);
        }
    }
    /**
     * 删除系统公告
     */
    public function system_del(Request $request){
        $cate     = $request->param('id');
        $result   = Db::name('notice')->where(array('id'=>$cate))->delete();
        if ($result) {
            $this->success_new('删除成功',url('Admin/notice/system'));
        }else{
            $this->error_new('删除失败');
        }
    }
    /**
     * 删除个人公告
     */
    public function personal_del(Request $request){
        $cate     = $request->param('id');
        $result   = Db::name('member_msg')->where(array('id'=>$cate))->delete();
        if ($result) {
            $this->success_new('删除成功',url('Admin/notice/personal'));
        }else{
            $this->error_new('删除失败');
        }
    }
    /**
     * 推送消息
     *
     */
    public function push_msg(){
        $data = Db::name('push')->select();
        return view('push_msg',[
            'data'=>$data,
        ]);
    }
    /**
     * 显示推送消息
     *
     */
    public function push_show(Request $request){
        $id     = $request->param('id');
        $data = Db::name('push')->where(array('id'=>$id))->find();
        return view('push_edit',[
            'data'=>$data,
        ]);
    }

    /**
     * 编辑推送消息
     */
    public function push_edit(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $map = array(
                'id' => $data['id']
            );
            $result = Db::name('push')->where($map)->update($data);
            if ($result) {
                $this->success_new('修改成功', url('Admin/notice/push_msg'));
            } else {
                $this->error_new('修改失败');
            }
        }
    }
    /**
     * 删除个人公告
     */
    public function push_del(Request $request){
        $id     = $request->param('id');
        $result   = Db::name('push')->where(array('id'=>$id))->delete();
        if ($result) {
            $this->success_new('删除成功',url('Admin/notice/push_msg'));
        }else{
            $this->error_new('删除失败');
        }
    }
}