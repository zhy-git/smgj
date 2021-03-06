<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/10/30
 * Time: 14:57
 */

namespace app\home\controller;


use app\admin\model\Members;
use think\Request;
use think\Cache;
use think\Db;

class Bet extends Home
{
    public function index(){

    }
    public function Confirm(Request $request){
        $data = $request->post();
        $time = time();
        $whereData['end_time'] = array('gt',$time);
        $stageData = Db::name('cqssc_stage')->where($whereData)->find();

        if(!$stageData){
            $returnData['ErrorMessage'] = '投注失败,请稍后再试(code:501)';
            return json($returnData);
        }
        if($time >= $stageData['end_bet_time']){
            $returnData['ErrorMessage'] = '该期已封单，不能下单';
            return json($returnData);
        }

        $totalMoney = 0;

        foreach ($data['Bets'] as $dak=>$dav){
            $sdv['uid'] = $this->uid;
            $sdv['stage'] = $stageData['stage'];
            $sdv['cate'] = $data['LotteryGameID'];
            $sdv['type'] = $dav['BetTypeCode'];
            $sdv['number'] = $dav['Number'];
            $sdv['wei'] = empty($dav['Position']) ? '1':$dav['Position'];
            $sdv['notes'] = $dav['Count'];
            $sdv['multiple'] = $dav['Multiple'];
            $sdv['money'] = $dav['Count']*$dav['Multiple']*$dav['Unit'];
            $sdv['end_bet_time'] = $stageData['end_bet_time'];
            $sdv['ip'] = get_client_ip();
            $sdv['create_at'] = $time;
            $sdv['denomination'] = $dav['Unit'];

            $totalMoney = $totalMoney + $sdv['money'];
            $insertData[] = $sdv;
            $typeName[] = $dav['TypeName'];
        }

        $memWhereData['id'] = $this->uid;
        $memData = Db('member')->where($memWhereData)->find();
        if($memData['money']<$totalMoney){
            $returnData['ErrorMessage'] = '余额不足';
            return json($returnData);
        }
        if(!$insertData){
            $returnData['ErrorMessage'] = '数据异常';
            return json($returnData);
        }
        $cateList = Db::name('cate')->cache('cate_list',60)->select();
        foreach ($cateList as $clk=>$clv){
            $cateListArr[$clv['id']] = $clv['name'];
        }
        foreach ($insertData as $inl=>$idv) {
            Db::startTrans();
            try {
                $returnInsertData[$inl] = $insertData[$inl];
                $returnInsertData[$inl]['ID'] = Db::name('single')->insertGetId($insertData[$inl]);
                $returnInsertData[$inl]['Number'] = $idv['number'];
                $returnInsertData[$inl]['BetTypeName'] = $typeName[$inl];
                $returnInsertData[$inl]['State'] = 0;
                $returnInsertData[$inl]['StateStr'] = '开奖中';
                $returnInsertData[$inl]['CreateDate'] = date('Y-m-d H:i:s',$idv['create_at']);
                $returnInsertData[$inl]['Prize'] = 0;
                $returnInsertData[$inl]['Cost'] = $idv['money'];
                $returnInsertData[$inl]['Count'] = $idv['notes'];

                Db::name('member')->where($memWhereData)->setDec('money',$idv['money']);
                $balance = Db::name('member')->where($memWhereData)->value('money');
                $explain = $insertData[$inl]['stage'].'期 '.$typeName[$inl].'：'.$idv['notes'].'注 '.$idv['multiple'].'倍';
                addDetail($this->uid,2,$idv['money'],$balance,5,$idv['cate'],$explain,1,$returnInsertData[$inl]['ID']);
                // 提交事务
                Db::commit();
            } catch (\Exception $e) {
                // 回滚事务
                unset($returnInsertData[$inl]);
            }
        }

        if(!empty($returnInsertData)){
            $returnData['WalletAmount'] = (float)$balance;
            $returnData['LotteryGameName'] = $cateListArr[$data['LotteryGameID']];
            $returnData['SerialNumber'] = $stageData['stage'];
            $returnData['BetDatas'] = $returnInsertData;
        }else{
            $returnData['ErrorMessage'] = '投注失败,请稍后再试(code:502)';
        }
        return json($returnData);
    }

    //撤单
    public function cedan(Request $request){
        $num = $request->post('num');
        $whereData['id'] = $num;
        $whereData['uid'] = $this->uid;
        $stageData = Db('single')->where($whereData)->find();
        $time = time();
        if($stageData){
            if($stageData['end_bet_time'] < $time){
                $returnData['code'] = 2;
                $returnData['msg'] = '已过撤单时间';
                $returnData['url'] = url('report/index');
                return json($returnData);
            }elseif($stageData['is_del']>0){
                $returnData['code'] = 3;
                $returnData['msg'] = '无效订单';
                $returnData['url'] = url('report/index');
                return json($returnData);
            };

            Db::startTrans();
            try {
                Db('single')->where($whereData)->setInc('is_del');
                Db('member')->where('id',$whereData['uid'])->setInc('money',$stageData['money']);
                $explain = $stageData['stage'].'期 撤单退款'.$stageData['money'];
                $balance = Db('member')->where('id',$whereData['uid'])->value('money');
                addDetail($whereData['uid'],1,$stageData['money'],$balance,8,1,$explain,$stageData['hall'],$stageData['id']);
                $returnData['code'] = 1;
                $returnData['msg'] = '撤单成功';
                // 提交事务
                Db::commit();
            } catch (\Exception $e) {
                // 回滚事务
                $returnData['code'] = 0;
                $returnData['msg'] = '撤单失败，请稍后再试';
                Db::rollback();
            }
        }
        return json($returnData);
    }
}