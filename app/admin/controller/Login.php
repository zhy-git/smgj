<?php
namespace app\admin\controller;

use app\admin\model\User;
use think\Controller;
use think\Request;

class Login extends Controller
{
    public function index()
    {
        return view();
    }
    public function login(Request $request)
    {
        $username= $request->post('username');//获取用户名
        $password= $request->post('password');//获取密码
        $user = new User();
        //验证登入
        if(!$user->checkLogin($username,$password)){

            $this->error($user->getError());
        }
        $user->where('username',$username)->update(['session_id'=>session_id()]);
        $this->success('登录成功！', url('Index/index'));
    }

    /* 退出登录 */
    public function out(){
        if(isAdminLogin()){
            session('uid', null);
            session('info', null);
            session('admin_login', null);
            session('admin_login_sign', null);
            $this->success_new('退出成功！', url('Login/index'));
        } else {
            $this->success_new('退出成功！', url('Login/index'));
        }
    }
    /**
     * 定义方法
     *
     * 重写thinkphp跳转成功方法
     *
     * @param string $message
     * @param string $uri
     * @param bool|mixed $param
     */
    public function success_new($message,$uri="",$param = [])
    {
        if ($uri) {
            $param_str = '';
            if($param) {
                foreach ($param as $k => $v) {
                    $param_str .= '/' . $k . '/' . $v;
                }
                echo '<script>alert(\'' . $message . '\');location=\'' . $uri . $param_str . '\'</script>';
            }else{
                echo '<script>alert(\'' . $message . '\');location=\'' . $uri .  '\'</script>';
            }
        } else {
            echo '<script>alert(\''.$message.'\');history.go(-1)</script>';
        }
    }
}
