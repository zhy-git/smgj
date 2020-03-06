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
use think\Cache;

class Account extends Home
{
//    public function _initialize(){
//        parent::_initialize();
//    }
    //获取用户信息

    public function index(Request $request){
        if($request->isPost()) {
            $data = $request->post();
//            if(!captcha_check($data['verifyCode'])) {
//                // 校验失败
//                $this->error('验证码不正确');
//            }
            $validate = validate('Check');
            if(!$validate->scene('charge')->check($data)){
                $this->error($validate->getError());
            };
            $insertData['uid'] = $this->uid;
            $insertData['money'] = (int)$data['money'];
            $insertData['way'] = (int)$data['recharge'];
            $insertData['name'] = session('member_info.name');
            if((int)$insertData['way']==1){
                $channelName = '微信';
            }else if((int)$insertData['way']==2){
                $channelName = '支付宝';
            }else{
                $channelName = '银行卡转账';
            }
            $insertData['remark'] = '前台'.$channelName.'充值';
            $insertData['create_at'] = time();
            $insertId = Db::name('recharge')->insertGetId($insertData);
            //$where['type'] = (int)$insertData['way'];
            //$img = Db::name('qrcode')->where($where)->value('qrcode');
            if($insertId){
                $ccRemind = Cache::get('ccRemind');
                if($ccRemind){
                    $ccRemind['charge'] += 1;
                }else{
                    $ccRemind['cash'] = 0;
                    $ccRemind['charge'] = 0;
                }
                Cache::set('ccRemind',$ccRemind);
                $return['skzh'] = $insertData['name'];
                $return['ddh'] = $insertId;
                $return['czje'] =  $insertData['money'];
                //$return['img'] =  $img;
                $returnData['code'] = 1;
                $returnData['data'] = $return;
                return json($returnData);
            }
        }else{
//            $memDetail = Db('member')->where('id',$this->uid)->field('id,nickname,money,is_proxy,rebate,bonus')->find();
//            $whereUserCardData['uid'] = $this->uid;
//            $userCard = Db::name('user_card')->where($whereUserCardData)->select();
//            foreach ($userCard as $uck=>$ucv){
//                $userCard[$uck]['num'] = '*************'.substr($ucv['num'],-4);
//                $userCard[$uck]['name'] = '*'.mb_substr($ucv['name'],-1,1,"utf-8");
//            }
//
//            $moneyPass = Db::name('member')->where('id',$this->uid)->value('money_password');
//            if($moneyPass){
//                $ismp = 1;
//            }else{
//                $ismp = 0;
//            }
            //查询是否添加银行卡
            $userCard = Db::name('user_card')->where('uid',$this->uid)->find();
            $time['start'] = date('Y-m-d',strtotime('-30 day', time()));
            $time['end'] = date('Y-m-d',time());
            //获取用户信息
            $memDetail = Db::name('member')->where('id',$this->uid)->field('gm_name,money,money_password')->find();
            //获取支付信息
            $qrcode = Db::name('qrcode')->field('type,qrcode,pic,path')->group('type')->select();
            foreach ($qrcode as $k=>$v){
                $qrcodeList[$v['type']] = $v;
            }
            return view('',[
                'qrcode'=>$qrcodeList,
                'time'=>$time,
                'userCard'=>$userCard,
                'mem'=>$memDetail,
                //'ismp'=>$ismp
            ]);
        }
    }

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

    public function cash(Request $request){
        $whereData['create_at'][] = array('gt', strtotime(date('Y-m-d 00:00:00')));
        $whereData['create_at'][] = array('lt', strtotime(date('Y-m-d 23:59:59')));
        $whereData['uid'] = $this->uid;
        $withdrawals = Db::name('withdrawals')->where($whereData)->count();
        if($withdrawals){
            $remainNum = 3 - $withdrawals;
            $remainNum = $remainNum<0? 0:$remainNum;
        }else{
            $remainNum = 3;
        }
        $whereUserCardData['uid'] = $this->uid;
        $userCard = Db::name('user_card')->where($whereUserCardData)->find();
        if($request->isPost()) {
            if($remainNum < 1){
                $this->error('今日提现申请已用完');
            }
            $data = $request->post();
            $validate = validate('Check');
            if(!$validate->scene('cash')->check($data)){
                $this->error($validate->getError());
            };
            if(!$userCard){
                $this->error('未绑定银行卡，请先绑定银行卡');
            }
            $memData = Db::name('member')->where('id',$this->uid)->field('money_password,money')->find();
            if($memData['money_password'] != md5($data['money_password'])){
                $this->error('资金密码不正确，请重新输入');
            }elseif($memData['money']<(int)$data['money']){
                $this->error('余额不足，无法提现');
            }
            $mem = session('member_info');
            $insertData['uid'] = $this->uid;
            $insertData['gm_name'] = $mem['name'];
            $insertData['username'] = $userCard['name'];
            $insertData['money'] = (int)$data['money'];
            $insertData['account_bank'] = $userCard['num'];
            $insertData['bank_name'] = $userCard['bank'];
            $insertData['branch_name'] = $userCard['bank_branch'];
            $insertData['create_at'] = time();
            //$insertData['remark'] = $userCard['province'].','.$userCard['city'].','.$userCard['area'];
            Db::startTrans();
            try {
                Db::name('member')->where('id', $this->uid)->setDec('money', $insertData['money']);
                Db::name('withdrawals')->where($whereData)->insert($insertData);
                $balance = Db::name('member')->where('id', $this->uid)->value('money');
                $explain = '提现扣款';
                addDetail($this->uid, 2, $insertData['money'], $balance, 4, 1, $explain);
                Db::commit();
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                $this->error('系统繁忙，请稍后再试');
            }
            $ccRemind = Cache::get('ccRemind');
            if($ccRemind){
                $ccRemind['cash'] += 1;
            }else{
                $ccRemind['cash'] = 0;
                $ccRemind['charge'] = 0;
            }
            Cache::set('ccRemind',$ccRemind);
            $this->success('申请成功');
        }
//        foreach ($userCard as $uck=>$ucv){
//            $userCard[$uck]['num'] = '*************'.substr($ucv['num'],-4);
//            $userCard[$uck]['name'] = '*'.mb_substr($ucv['name'],-1,1,"utf-8");
//        }
//        return view('',[
//            'remainNum'=>$remainNum,
//            'withdrawals'=>$withdrawals,
//            'userCard'=>$userCard,
//        ]);
    }

    public function rechargelist(Request $request){
        $data = $request->post();
        $thirtyDaysAgo = strtotime('-30 day', time());
        if(!empty($data['rangeTime'])){
            $rangeTime = explode('~',$data['rangeTime']);
            $start = strtotime($rangeTime[0]);
            $end = strtotime($rangeTime[1].' 23:59:59');
            if($start<$thirtyDaysAgo){
                $start = $thirtyDaysAgo;
            }
        }else{
            $start = $thirtyDaysAgo;
            $end = time();
        }
        $whereData['create_at'][] = array('>=', $start);
        $whereData['create_at'][] = array('<=', $end);
        $whereData['uid'] = $this->uid;
        if(!empty($data['status'])) {
            $whereData['status'] = (int)$data['status'];
        }
        $rechargeList = Db::name('recharge')->where($whereData)->order('id desc')->paginate(200,false,['path'=>url('rechargelist','',false)."?page=[PAGE]"]);

        $returnData['page'] = $rechargeList->render();
        $returnData['data'] = $rechargeList->toArray();
        if($returnData['data']['data']){
            foreach ($returnData['data']['data'] as $k=>$v){
                if($v['status'] == 1){
                    $returnData['data']['data'][$k]['status'] = '处理中';
                }else if($v['status'] == 2){
                    $returnData['data']['data'][$k]['status'] = '成功';
                }else{
                    $returnData['data']['data'][$k]['status'] = '失败';
                }
                if($v['way'] == 1){
                    $returnData['data']['data'][$k]['way'] = '微信';
                }else if($v['status'] == 2){
                    $returnData['data']['data'][$k]['way'] = '支付宝';
                }else{
                    $returnData['data']['data'][$k]['way'] = '银行转账';
                }
                $returnData['data']['data'][$k]['create_at'] = date('Y-m-d H:i:s',$v['create_at']);
            }
        }else{
            $this->error('暂无数据');
        }
        $returnData['code'] = 1;
        return json($returnData);
    }

    public function cashlist(Request $request){
        $data = $request->post();
        $thirtyDaysAgo = strtotime('-30 day', time());
        if(!empty($data['rangeTime'])){
            $rangeTime = explode('~',$data['rangeTime']);
            $start = strtotime($rangeTime[0]);
            $end = strtotime($rangeTime[1].' 23:59:59');
            if($start<$thirtyDaysAgo){
                $start = $thirtyDaysAgo;
            }
        }else{
            $start = $thirtyDaysAgo;
            $end = time();
        }
        $whereData['create_at'][] = array('>=', $start);
        $whereData['create_at'][] = array('<=', $end);
        $whereData['uid'] = $this->uid;
        if(!empty($data['status'])) {
            $whereData['status'] = (int)$data['status'];
        }
        //print_r($data);
        $rechargeList = Db::name('withdrawals')->where($whereData)->order('id desc')->paginate(200,false,['path'=>url('rechargelist','',false)."?page=[PAGE]"]);

        $returnData['page'] = $rechargeList->render();
        $returnData['data'] = $rechargeList->toArray();
        if($returnData['data']['data']){
            foreach ($returnData['data']['data'] as $k=>$v){
                if($v['status'] == 1){
                    $returnData['data']['data'][$k]['status'] = '处理中';
                }else if($v['status'] == 2){
                    $returnData['data']['data'][$k]['status'] = '成功';
                }else{
                    $returnData['data']['data'][$k]['status'] = '失败';
                }
                $returnData['data']['data'][$k]['account_bank'] =  '*************'.substr($v['account_bank'],-4);
                $returnData['data']['data'][$k]['username'] =  '*'.mb_substr($v['username'],-1,1,"utf-8");
                $returnData['data']['data'][$k]['create_at'] = date('Y-m-d H:i:s',$v['create_at']);
            }
        }else{
            $this->error('暂无数据');
        }
        $returnData['code'] = 1;
        return json($returnData);

        $cashList = Db::name('withdrawals')->where($whereData)->order('id desc')->paginate(20,false,['query'=>request()->param()]);
        $page = $cashList->render();
        $cashList = $cashList->toArray();
        foreach ($cashList['data'] as $clk=>$clv){
            $cashList['data'][$clk]['account_bank'] = '*************'.substr($clv['account_bank'],-4);
        }
        return view('',[
            'page'=>$page,
            'list'=>$cashList['data'],
        ]);
    }

    public function addcard(Request $request){
        if($request->isPost()) {
            $data = $request->post();
            $validate = validate('Check');
            if(!$validate->scene('bank')->check($data)){
                $this->error($validate->getError());
            };
//            $moneyPass = Db::name('member')->where('id',$this->uid)->value('money_password');
//            if($moneyPass != md5($data['money_password'])){
//                $this->error('资金密码错误');
//            }
            $memInfo = session('member_info');
            Db::startTrans();
            try {
                $insertData['bank'] = $data['bank'];
                $insertData['bank_branch'] = $data['bank_branch'];
                $insertData['num'] = $data['num'];
                $insertData['create_at'] = time();
                $whereUserCardData['uid'] = $this->uid;
                $userCard = Db::name('user_card')->where($whereUserCardData)->value('id');
                if($userCard){
                    Db::name('user_card')->where('uid',$this->uid)->update($insertData);
                }else{
                    $insertData['name'] = $memInfo['name'];
                    $insertData['uid'] = $this->uid;
                    Db::name('user_card')->insert($insertData);
                }


                Db::commit();
            } catch (\Exception $e) {
                Db::rollback();
                $this->error('服务器繁忙，请稍后再试');
            }
            $this->success('操作成功',url('index'),'',3);
        }

        foreach ($userCard as $uck=>$ucv){
            $userCard[$uck]['num'] = '*************'.substr($ucv['num'],-4);
        }
        return view('',[
            'userCard'=>$userCard,
        ]);
    }


}