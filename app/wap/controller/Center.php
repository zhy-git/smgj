<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/9/13
 * Time: 16:48
 */

namespace app\home\controller;

use app\admin\model\Members;
use think\Request;
use think\Db;
use app\home\controller\Biapi;

class Center extends Home
{
    public function index(){
        $memMoney = Db::name('member')->where('id',$this->uid)->field('money,ag_money,unpaid_money,bb_money')->find();
        $memInfo = session('member_info');
        return view('',[
            'memMoney'=>$memMoney,
            'memInfo'=>$memInfo,
        ]);
    }

    //金额转换
    public function changeMoney(Request $request){
        $data = $request->post();
        $validate = validate('Check');
        $checkdata['from'] = $data['type'];
        $checkdata['to'] = $data['typeSec'];
        $checkdata['money'] = $data['money'];
        $checkdata['money_password'] = $data['money_password'];
        if(!$validate->scene('moneyChange')->check($checkdata)){
            $this->error($validate->getError());
        };
        $filedName = array(1=>'money',2=>'ag_money',3=>'bb_money');
        $mem = Db::name('member')->where('id',$this->uid)->field('gm_name,money,money_password,ag_money,bb_money')->find();
        if($mem){
            if($mem['money_password'] != md5($data['money_password'])){
                $this->error('资金密码错误');
            }
            if($data['type'] == 1){
                if($mem[$filedName[1]]<$data['money']){
                    $this->error('余额不足');
                }
                if($data['typeSec'] == 2){
                    $gametype = 'AG';
                }elseif($data['typeSec'] == 3){
                    $gametype = 'SS';
                }
                $res=new BiApi();
                $result=$res->zzmoney($gametype,$mem['gm_name'],'IN',$data['money']);
                if($result){
                    $updateData[$filedName[$data['type']]] = array('exp',$filedName[$data['type']].'-'.$data['money']);
                    $updateData[$filedName[$data['typeSec']]] = array('exp',$filedName[$data['typeSec']].'+'.$data['money']);
                    $re = Db::name('member')->where('id',$this->uid)->update($updateData);
                    if($re){
                        $this->success('操作成功');
                    }else{
                        $this->error('服务器繁忙，请稍后再试');
                    }
                }else{
                    $this->error('转入失败，请稍后再试');
                }
            }else{
                $res = new BiApi();
                if($data['type'] == 2){
                    $gametype = 'AG';
                }elseif($data['type'] == 3){
                    $gametype = 'SS';
                }
                $result = $res->zzmoney($gametype,$mem['gm_name'],'OUT',$data['money']);
                if($result){
                    $updateData[$filedName[$data['type']]] = array('exp',$filedName[$data['type']].'-'.$data['money']);
                    $updateData[$filedName[$data['typeSec']]] = array('exp',$filedName[$data['typeSec']].'+'.$data['money']);
                    $re = Db::name('member')->where('id',$this->uid)->update($updateData);
                    if($re){
                        $this->success('操作成功');
                    }else{
                        $this->error('服务器繁忙，请稍后再试');
                    }
                }else{
                    $this->error('转入失败，请稍后再试');
                }
            }
        }else{
            $this->error('服务器繁忙，请稍后再试');
        }
    }
    //重置资金密码
    public function subMoneyReset(Request $request){
        $data = $request->post();
        $validate = validate('Check');

        $whereData['id'] = $this->uid;
        $memPass = Db::name('member')->where($whereData)->value('money_password');
        if(!empty($memPass)){
            $checkdata['old_money_password'] = $data['oldpassword'];
            $checkdata['money_password'] = $data['newpassword'];
            $checkdata['repassword'] = $data['renewpassword'];

            if(!$validate->scene('MoneyPassReset')->check($checkdata)){
                $this->error($validate->getError());
            };
            if($memPass != md5($data['oldpassword'])){
                $this->error('原始资金密码输入不正确');
            }
            $updateData['money_password'] = md5($data['newpassword']);
            $re = Db::name('member')->where($whereData)->update($updateData);
            if($re){
                $this->success('修改密码成功',url('index'));
            }
            $this->error('服务器繁忙，请稍后再试');
        }else{
            $checkdata['money_password'] = $data['newpassword'];
            $checkdata['repassword'] = $data['renewpassword'];

            if(!$validate->scene('MoneyPassSet')->check($checkdata)){
                $this->error($validate->getError());
            };

            $whereData['id'] = $this->uid;
            $memPass = Db::name('member')->where($whereData)->value('money_password');
            if($memPass){
                $this->error('提交错误，请稍后再试');
            }else{
                $updateData['money_password'] = md5($data['newpassword']);
                $re = Db::name('member')->where($whereData)->update($updateData);
                if($re){
                    $this->success('设置密码成功',url('index'));
                }
                $this->error('服务器繁忙，请稍后再试');
            }
        }
    }
    //重置登陆密码
    public function subLoginReset(Request $request){
        $data = $request->post();
        $validate = validate('Member');
        if(!$validate->scene('reset_pass')->check($data)){
            $this->error($validate->getError());
        };
        $whereData['id'] = $this->uid;
        $memPass = Db::name('member')->where($whereData)->value('password');
        if($memPass){
            if($memPass != md5($data['oldpassword'])){
                $this->error('原始密码输入不正确');
            }
            $updateData['password'] = md5($data['password']);
            $re = Db::name('member')->where($whereData)->update($updateData);
            if($re){
                $this->success('修改密码成功',url('index'));
            }
            $this->error('服务器繁忙，请稍后再试');
        }else{
            $this->error('服务器繁忙，请稍后再试');
        }
    }
    //检查资金密码是否设置
    public function checkMoneyPass(Request $request){
        $data = $request->post();
        if($data['type'] == 1){
            $memPass = Db::name('member')->where('id',$this->uid)->value('money_password');
            if(!$memPass){
                $this->error('请先设置资金密码',url('index'));
            }
            $this->success('success');
        }else{
            $memPass = Db::name('member')->where('id',$this->uid)->value('money_password');
            if(!$memPass){
                $this->error('请先设置资金密码',url('index'));
            }
            $userCard = Db::name('user_card')->where('uid',$this->uid)->field('id')->find();
            if(!$userCard){
                $this->error('请先添加银行卡',url('index'));
            };
            $this->success('success');
        }
    }
}