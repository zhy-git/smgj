<?php

namespace app\admin\model;

use think\Model;
use think\Db;

class User extends Base
{
    protected $auto = [];
    protected $insert = ['role' => 1,'stime'];
    protected $update = [];

    protected function setPasswordAttr($password)
    {
        return md5($password);
    }
    protected function setStimeAttr()
    {
        return time();
    }

    //检验登入
    public function checkLogin($username,$password){
        $rs = $this->get(['username' => $username]);
        session('info',$rs);
        session('uid',$rs['id']);

        if(!$rs){
            $this->error='用户不存在或已被禁用！';
            return false;
        }else{
            if($rs['password']!== md5($password)){
                $this->error='密码错误！';
                return false;
            }
        }
        //更行数据
        $data =array(
            'id'=>$rs['id'],
            'lg_ip'=>request()->ip(),
            'lg_time'=>time(),
        );

        $this->update($data);

        //create login log by hawk at 2018/4/2
        $LogData['uid']=$rs['id'];
        $LogData['ip']=get_client_ip();
        $LogData['ip_address']=get_city_id(get_client_ip());
        $LogData['create_at'] = time();
        $LogData['type']=2;
        $result=Db::name('login_log')->insert($LogData);

        /* 记录登录SESSION和COOKIES */
        $auth = array(
            'uid'             => $rs['id'],
            'username'        => $rs['username'],
            'lg_time'         => $rs['lg_time'],
        );
        session('admin_login', $auth);
        session('admin_login_sign',data_auth_sign($auth));
        return true;
    }
}