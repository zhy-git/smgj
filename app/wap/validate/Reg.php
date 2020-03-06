<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/9/15
 * Time: 10:03
 */
namespace app\home\validate;

use think\Validate;
class Reg extends Validate
{
    protected $rule = [
        'tel'  =>  'require|unique:member',
        'code'  =>  'require',
        'password' =>  'require|min:6|confirm',
    ];

    protected $message = [
        'tel.require'  =>  '请输入手机号',
        'tel.unique'  =>  '用户名已存在',
        'code.require'  =>  '请输入验证码',
        'password.require' =>  '请输入密码',
        'password.min' =>  '密码至少6位',
        'password.confirm' =>  '确认密码不对',
    ];
    protected $scene = [
        'send'  =>  ['tel'],
        'forget'  =>  ['tel'  =>  'require'],
        'forgets'  =>  ['tel'  =>  'require','code','password'],
    ];

}