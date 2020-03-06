<?php
namespace app\admin\controller;
use app\admin\model\AuthGroup;
use app\admin\model\AuthGroupAccess;
use app\admin\model\AuthRule;
use app\admin\model\Base;
use app\admin\model\LoginLog;
use app\admin\validate\User;
use think\Db;
use think\Request;

/**
 * 后台权限管理
 */
class Rule extends Admin{

//******************权限***********************
    /**
     * 权限列表
     */
    public function index(){
        $AuthRule = new AuthRule();
        $data =  $AuthRule->getTreeData('tree','id','title');

        $assign=array(
            'data'=>$data
            );
        $this->assign($assign);
        return view();
    }

    /**
     * 添加权限
     */
    public function add(Request $request){
        $data = $request->post();
        unset($data['id']);
        $AuthRule = new AuthRule();

        $result=$AuthRule->addData($data);
        if ($result) {
            $this->success_new('添加成功',url('Admin/Rule/index'));
        }else{
            $this->error_new('添加失败');
        }
    }

    /**
     * 修改权限
     */
    public function edit(Request $request){
        $data = $request->post();
        $AuthRule = new AuthRule();
        $map=array(
            'id'=>$data['id']
            );

        $result=$AuthRule->editData($map,$data);
        if ($result) {
            $this->success_new('修改成功',url('Admin/Rule/index'));
        }else{
            $this->error_new('修改失败');
        }
    }

    /**
     * 删除权限
     */
    public function delete(Request $request){
        $id = $request->param('id');
        $map=array(
            'id'=>$id
            );
        $AuthRule = new AuthRule();
        $result=$AuthRule->deleteData($map);
        if($result){
            $this->success_new('删除成功',url('Admin/Rule/index'));
        }else{
            $this->error_new('请先删除子权限');
        }

    }
//*******************用户组**********************
    /**
     * 用户组列表
     */
    public function group(){
        $AuthGroup = new AuthGroup();
        $data= $AuthGroup->select();
        $assign=array(
            'data'=>$data
            );

        $this->assign($assign);
       return view();
    }

    /**
     * 添加用户组
     */
    public function add_group(Request $request){
        $data = $request->post();
        unset($data['id']);
        $AuthRule = new AuthGroup();
        $result=$AuthRule->addData($data);
        if ($result) {
            $this->success_new('添加成功',url('Admin/Rule/group'));
        }else{
            $this->error_new('添加失败');
        }
    }

    /**
     * 修改用户组
     */
    public function edit_group(Request $request){
        $data = $request->post();
        $map=array(
            'id'=>$data['id']
            );
        $AuthRule = new AuthGroup();
        $result=$AuthRule->editData($map,$data);
        if ($result) {
            $this->success_new('修改成功',url('Admin/Rule/group'));
        }else{
            $this->error_new('修改失败');
        }
    }

    /**
     * 删除用户组
     */
    public function delete_group(Request $request){
        $id = $request->param('id');
        $map=array(
            'id'=>$id
            );
        $AuthRule = new AuthGroup();
        $result=$AuthRule->deleteData($map);
        if ($result >= 0) {
            $this->success_new('删除成功',url('Admin/Rule/group'));
        }else{
            $this->error_new('删除失败');
        }
    }

//*****************权限-用户组*****************
    /**
     * 分配权限
     */
    public function rule_group(Request $request){
        $data = $request->post();
        if($data){
            $map=array(
                'id'=>$data['id']
                );
            $data['rules']=implode(',', $data['rule_ids']);
            unset( $data['rule_ids']);

            $AuthGroup = new AuthGroup();
            $result=$AuthGroup->editData($map,$data);
            if ($result) {
                $this->success_new('操作成功',url('Admin/Rule/group'));
            }else{
                $this->error_new('操作失败');
            }
        }else{
            $id = $request->param('id');
            $AuthGroup = new AuthGroup();
            // 获取用户组数据
            $group_data=$AuthGroup->where(array('id'=>$id))->find();
            $group_data['rules']=explode(',', $group_data['rules']);
            // 获取规则数据
            $AuthRule = new AuthRule();
            $rule_data=$AuthRule->getTreeData('level','id','title');
            $assign=array(
                'group_data'=>$group_data,
                'rule_data'=>$rule_data
                );

            $this->assign($assign);
           return view();
        }

    }
//******************用户-用户组*******************
    /**
     * 添加成员
     */
    public function check_user(Request $request){


        $group_id  = $request->param('group_id');



        $group_name = Db::name('auth_group')->where(array('id'=>$group_id))->value('title');

        $AuthGroupAccess = new AuthGroupAccess();
        $uids = $AuthGroupAccess->getUidsByGroupId($group_id);

        // 判断用户名是否为空

            $user_data = Db::name('user')->select();

        $assign=array(
            'group_name'=>$group_name,
            'uids'=>$uids,
            'user_data'=>$user_data,
            'group_id'=>$group_id,

            );
        $this->assign($assign);
       return view();
    }

    /**
     * 添加用户到用户组
     */
    public function add_user_to_group(Request $request){
        $data  = $request->param();
        $map=array(
            'uid'=>$data['uid'],
            'group_id'=>$data['group_id']
            );
        $AuthGroupAccess = new AuthGroupAccess();
        $count=Db::name('auth_group_access')->where($map)->count();
        if($count==0){
            $AuthGroupAccess->addData($data);
        }
        $this->success_new('操作成功',url('Admin/Rule/check_user',array('group_id'=>$data['group_id'])));
    }

    /**
     * 将用户移除用户组
     */
    public function delete_user_from_group(Request $request){
        $data  = $request->param();
        $AuthGroupAccess = new AuthGroupAccess();
        $result=$AuthGroupAccess->deleteData($data);
        if ($result) {
            $this->success_new('操作成功',url('Admin/Rule/admin_user_list'));
        }else{
            $this->error_new('操作失败');
        }
    }

    /**
     * 管理员列表
     */
    public function admin_user_list(){
        $AuthGroupAccess = new AuthGroupAccess();
        $data=$AuthGroupAccess->getAllData();
        $assign=array(
            'data'=>$data
            );
        $this->assign($assign);
       return view();
    }

    /**
     * 添加管理员
     */
    public function add_admin(Request $request){
        $data = $request->post();
        if($data){
            if(!isset($data['group_ids'])){
                $this->error_new('请选择管理组');exit;
            }
            $daa = $data;
            unset($daa['group_ids']);
            $User = new \app\admin\model\User();
            $User->save($daa);
            $id = $User->id;
            $daa_s['uid'] = $id;
            $daa_s['id']  = $id;
            $User->save($daa_s);
            $AuthGroupAccess = new AuthGroupAccess();
            if($id){
                if (!empty($data['group_ids'])) {
                    foreach ($data['group_ids'] as $k => $v) {
                        $group=array(
                            'uid'=>$id,
                            'group_id'=>$v
                            );
                        $AuthGroupAccess->addData($group);

                    }
                }
                // 操作成功
                $this->success_new('添加成功',url('Admin/Rule/admin_user_list'));
            }else{
                // 操作失败
                $this->error_new('操作失败');
            }
        }else{
            $data=Db::name('auth_group')->select();
            $assign=array(
                'data'=>$data
                );
            $this->assign($assign);
           return view();
        }
    }

    /**
     * 修改管理员
     */
    public function edit_admin(Request $request){
        $data = $request->post();

        if($data){
            // 组合where数组条件
            $uid=$data['id'];
            $map=array(
                'id'=>$uid
                );
            // 修改权限
            $AuthGroupAccess = new AuthGroupAccess();
            $User = new \app\admin\model\User();
            $AuthGroupAccess->deleteData(array('uid'=>$uid));
            foreach ($data['group_ids'] as $k => $v) {
                $group=array(
                    'uid'=>$uid,
                    'group_id'=>$v
                    );
                $AuthGroupAccess->addData($group);
            }
            $data1['username'] =$data['username'];
            $data1['status']   =$data['status'];
            $data1['phone']    =$data['phone'];
            // 如果修改密码则md5
            if (!empty($data['password'])) {
                $data1['password']=$data['password'];
            }

            $result=$User->editData($map,$data1);
            if($result){
                // 操作成功
                $this->success_new('编辑成功',url('Admin/Rule/edit_admin',array('id'=>$uid)));
            }else{

                if (empty($error_new_word)) {
                    $this->success_new('编辑成功',url('Admin/Rule/edit_admin',array('id'=>$uid)));
                }else{
                    // 操作失败
                    $this->error_new('编辑失败');
                }

            }
        }else{
            $id  = $request->param('id');
            // 获取用户数据
            $user_data=Db::name('user')->find($id);
            // 获取已加入用户组
            $group_data=Db::name('auth_group_access')
                ->where(array('uid'=>$id))
                ->select();
            foreach($group_data as $k=>$v){
                $group_ids[] = $v['group_id'];
            }
            // 全部用户组
            $data=Db::name('auth_group')->select();
            $assign=array(
                'data'=>$data,
                'user_data'=>$user_data,
                'group_data'=>$group_ids
                );

            $this->assign($assign);
           return view();
        }
    }
    /**
     * 删除管理员
     */
    public function del_admin(Request $request){
        $id  = $request->param('id');
        if($id==1){
            $this->error_new('超级管理员不能删除');
        }
        // 获取用户数据
        $result=Db::name('user')->delete($id);

        if ($result) {
            $this->success_new('操作成功',url('Admin/Rule/admin_user_list'));
        }else{
            $this->error_new('操作失败');
        }
    }
    /**
     * 登陆日志
     */
    public function login_log(Request $request){
        $mobile = $request->param('mobile');
        $from   = $request->param('from');
        $to     = $request->param('to');
        $w = [];
        if($from && $to){
            $from = strtotime($from);
            $to = strtotime($to);
            $w['create_at'] = [['>=',$from],['<=',$to]];
        }
        if($mobile){
            $uid = Db::name('user')->where(array('phone'=>$mobile))->value('id');
            $w['uid'] = $uid;
        }
        $w['type']=2;
        $data = LoginLog::where($w)->order('id desc')->paginate(20,false,['query'=>request()->param()]);
        foreach ($data as $k => $v) {
            $data[$k]->user = Db::name('user')->where(array('uid'=>$v->uid))->find();
        }
        return view('login_log',[
            'list'=>$data,
            'page'=>$data->render(),
        ]);
    }
}
