<?php
namespace app\home\validate;

use think\Validate;

class Check extends Validate
{
    protected $rule = [
        'id'  =>  'require|integer',
        'money'  =>  'require|between:10,5000000|integer',
        'recharge' =>  'require',
        'bank' =>  'require|max:50',
        'bank_branch' =>  'require|max:50',
        'name' =>  'require|max:25',
        'num' =>  'require|max:25',
        'renum' =>  'require|confirm:num',
        'old_money_password' =>  'require|max:6|min:6|stringCheck',
        'money_password' =>  'require|max:6|min:6|stringCheck',
        'repassword' =>  'require|confirm:money_password',
        'old_password' =>  'require|min:6',
        'password' =>  'require|min:6',
        'reloginpassword' =>  'require|confirm:password',
        'from' => 'require|between:1,3|integer',
        'to' => 'require|between:1,3|integer',
    ];

    protected $message = [
        'id.require'  =>  '参数错误',
        'id.integer'  =>  '参数错误',
        'money.require'  =>  '请输入金额',
        'money.between'  =>  '充值金额太低或超出最高限制',
        'money.integer' =>  '金额必须为正整数',
        'recharge.require' =>  '充值渠道不能为空',
        'bank.require' =>  '开户银行不能为空',
        'bank.max' =>  '开户银行最大字符不能超过50',
        'bank_branch.require' =>  '支行名称不能为空',
        'bank_branch.max' =>  '开户银行最大字符不能超过50',
        's_province.require' =>  '银行区域不能为空',
        's_city.require' =>  '银行区域不能为空',
        's_county.require' =>  '银行区域不能为空',
        'name.require' =>  '收款人姓名不能为空',
        'name.max' =>  '收款人姓名最大字符不能超过25',
        'num.require' =>  '银行卡账号不能为空',
        'num.max' =>  '银行卡账号最大字符不能超过25',
        'renum.require' =>  '两次银行卡账号不一样',
        'renum.confirm' =>  '两次银行卡账号不一样',
        'money_password.require' =>  '资金密码不能为空',
        'money_password.max' =>  '资金密码需要6位',
        'money_password.min' =>  '资金密码需要6位',
        'money_password.stringCheck' =>  '资金密码只能包含英文、数字、下划线',
        'old_money_password.require' =>  '原始资金密码不能为空',
        'old_money_password.max' =>  '原始资金密码输入不正确',
        'old_money_password.min' =>  '原始资金密码输入不正确',
        'old_money_password.stringCheck' =>  '原始资金密码输入不正确',
        'repassword.require' =>  '两次资金密码不一样',
        'repassword.confirm' =>  '两次资金密码不一样',
        'old_password.require' =>  '原始密码不能为空',
        'old_password.min' =>  '原始密码输入不正确',
        'password.require' =>  '请输入密码',
        'password.min' =>  '密码长度至少6位',
        'reloginpassword.require' =>  '两次密码输入不一样',
        'reloginpassword.confirm' =>  '两次密码输入不一样',
        'from.require' => '转账类型错误',
        'from.between' => '转账类型错误',
        'from.integer' => '转账类型错误',
        'to.require' => '转账类型错误',
        'to.between' => '转账类型错误',
        'to.integer' => '转账类型错误',
    ];

    // 字符验证，只能包含英文、数字、下划线等字符。
    protected function stringCheck($value,$rule,$data){
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $value)) {
            return false;
        }
        return true;
    }

    protected $scene = [
        'id'   =>  ['id'],
        'ransferMoney'   =>  ['money','id'],
        'charge'   =>  ['name','money','recharge'],
        'bank'   =>  ['bank','bank_branch','num'],
        'cardSm'=>['name','num'],
        'cash'  => ['money','money_password'],
        'loginPassReset'  => ['old_password','password','reloginpassword'],
        'MoneyPassReset'  => ['old_money_password','money_password','repassword'],
        'MoneyPassSet'  => ['money_password','repassword'],
        'moneyChange'  => ['from','to','money','money_password'],
    ];
}