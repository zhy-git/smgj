<?php
namespace app\home\validate;

use think\Validate;

class Member extends Validate
{
    protected $rule = [
        'mobile'  =>  'require|unique:member|mobileCheck',
        'username'  =>  'require|min:5|max:10|stringCheck',
        'username_rule'  =>  'min:5|max:10|stringCheck',
        'password' =>  'require|min:6|max:12|stringCheck',
        'repassword' =>  'require|confirm:password',
        'rebate' => 'require',
        'agent_user' => 'require|integer|between:0,1',
        'oldpassword' => 'require|min:6|max:12|stringCheck',
        'remark' => 'require|min:1|max:10'
    ];

    protected $message = [
        'mobile.require'  =>  '请输入手机号',
        'mobile.unique'  =>  '手机号已存在',
        'mobile.mobileCheck'  =>  '手机号格式不正确',

        'username.require'  =>  '请输入用户名',
        'username.min'  =>  '用户名长度5到10之间',
        'username.max'  =>  '用户名长度5到10之间',
        'username.stringCheck'  =>  '账号只能包含英文、数字、下划线',

        'username_rule.min'  =>  '用户名长度5到10之间',
        'username_rule.max'  =>  '用户名长度5到10之间',
        'username_rule.stringCheck'  =>  '账号只能包含英文、数字、下划线',

        'password.require' =>  '请输入密码',
        'password.min' =>  '密码长度6到12之间',
        'password.max' =>  '密码长度6到12之间',
        'password.stringCheck' => '密码只能包含英文、数字、下划线',

        'repassword.require' =>  '两次密码输入不一致',
        'repassword.confirm' =>  '两次密码输入不一致',

        'rebate.require' =>  '请选择返点等级',
        'agent_user.require' =>  '请选择账号类型',
        'agent_user.integer' =>  '账号不符合规范',
        'agent_user.between' =>  '账号不符合规范',

        'oldpassword.require' =>  '请输入原始密码',
        'oldpassword.min' =>  '密码长度6到12之间',
        'oldpassword.max' =>  '密码长度6到12之间',
        'oldpassword.stringCheck' => '密码只能包含英文、数字、下划线',

        'remark.require' =>  '请输入备注信息',
        'remark.min' =>  '请输入备注信息',
        'remark.max' =>  '备注只能填写10个字符',
    ];

    // 字符验证，只能包含英文、数字、下划线等字符。
    protected function stringCheck($value,$rule,$data){
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $value)) {
            return false;
        }
        return true;
    }

    // 验证手机号
    protected function mobileCheck($value,$rule,$data){
        if (!preg_match('/^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/', $value)) {
            return false;
        }
        return true;
    }

    protected $scene = [
        'add'   =>  ['username','password','repassword','rebate','agent_user'],
        'add_link'   =>  ['rebate','agent_user','remark'],
        'link_reg'   =>  ['username','password','repassword'],
        'reset_pass'   =>  ['oldpassword','password','repassword'],
        'add_mobile'    =>  ['mobile','password','repassword'],
        'username_rule'    =>  ['username_rule']
    ];
}