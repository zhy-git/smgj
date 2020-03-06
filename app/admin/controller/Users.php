<?php
namespace app\admin\controller;

use app\admin\model\User;
use think\Request;

class Users extends Admin
{
    public function index()
    {
        $list = User::paginate(20);
        return view('index',[
            'list'=>$list,
            'page'=>$list->render(),
        ]);
    }
    public function add(Request $request){
        if($request->isPost()){
            $data= $request->post();
            $result = $this->validate($data,'User');
            if(true !== $result){
                $this->error($result);
            }
            $user = new User();
            $res = $user->allowField(true)->save($data);
            if($res){
                $this->success('添加成功',url('index'));
            }else{
                $this->error('添加失败');
            }
        }else{
            return view('add');
        }
    }
    public function edit(Request $request){
        if($request->isPost()){
            $data= $request->post();
            $result = $this->validate($data,'User');
            if(true !== $result){
                $this->error($result);
            }
            $user = new User();
            $res = $user->allowField(true)->isUpdate(true)->save($data);
            if($res){
                $this->success('编辑成功',url('index'));
            }else{
                $this->error('编辑失败');
            }
        }else{
            $user = User::get($request->param('id'));
            return view('edit',['info'=>$user]);
        }
    }
    /*删掉用户*/
    public function del(Request $request){
        $id = $request->param('ids/a');
        if (!$id) {
            $this->error('请选择要操作的数据!');
        }
        $res = User::destroy($id);
        if($res){
            $this->success('删掉成功');
        }else{
            $this->error('删掉失败');
        }
    }
    /*修改密码*/
    public function psd(Request $request)
    {
        if(!$old = $request->post('old')){
            $this->error('请输入原密码');
        }
        if(!$password = $request->post('password')){
            $this->error('请输入新密码');
        }
        $passwords = $request->post('passwords');
        if($password !== $passwords){
            $this->error('确认密码不正确');
        }
        $info = User::get(session('admin_login.uid'));
        if($info['password'] !== md5($old)){
            $this->error('原密码不正确');
        }
        $info->password = $password;
        if($info->save()){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }

    }
}