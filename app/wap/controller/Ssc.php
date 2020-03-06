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

class Ssc extends Home
{
    public function index(){
        $number = getNumberCache('ssc');
        $stage= key($number); //获取最新一期的key（即期数）
        $numbers =$number[$stage]; //获取最新开奖号
        $number_arr = explode(',',$numbers['number']);

        $whereData['cate'] = 1;
        $pl =  Db::name('odds')->where($whereData)->order('rate')->field('type,hall,rate,group_rate,bonus,win_type')->cache('odds_ssc',3)->select();
        $userOdds = array();
        $userPl = $this->userinfo;
        foreach ($pl as $plk=>$plv){
            if($plv['hall'] == 1){
                $userOdds[$plv['type']]['bonus'] = getBonus($plv,$userPl,$plv['type']);
            }else{
                $userOdds[$plv['type']][$plv['win_type']]['bonus'] = getBonus($plv,$userPl,$plv['type']);
            }
        }
        //计算下次期数 和 开间时间
        $ssc = setSscStageTime();
        $isGetOpenNum = 1;
        $limit = 1;
        if($ssc['stage_next']-1 != $stage){
            $number_arr = array('正','在','开','奖','中');
            $stage = $ssc['stage_next']-1;
            $isGetOpenNum = 2;
            $limit = 0;
        }
        //查询前10期开奖结果
        $sscHistory = Db('at_ssc')->order('id desc')->limit($limit,10)->select();
        foreach ($sscHistory as $shl=>$shv){
            $sscHistory[$shl]['numberArr'] = explode(',',$shv['number']);
        }

        //获取用户信息
        $memDetail = Db('member')->where('id',$this->uid)->field('nickname,money')->find();
        return view('',[
            'stage'=>$stage,
            'stage_next'=>$ssc['stage_next'],
            'number'=>$number_arr,
            'number_sum'=>array_sum($number_arr),
            'dateline'=>$ssc['dateline'],
            'wei'=>config('lottery_wei.ssc'),
            'sscHistory'=>$sscHistory,
            'nextNum'=>$numbers['number'],
            'mem'=>$memDetail,
            'userOdds'=>$userOdds,
            'bonus'=>$userOdds[1]['bonus'],
            'isGetOpenNum'=>$isGetOpenNum,
        ]);
    }

    public function index_te(){

//        $w['s.cate'] = 1;
//        $w['s.state'] = 0;
//        $w['s.code'] = 0;
//        $w['s.is_del'] = 0;
//        //$w['a.stage'] = 0;
//        //$w['hall'] = 1;
//        $list = Db::name('single')
//            ->where($w)
//            ->alias('s')
//            ->join('dl_bet b','s.type=b.type and s.cate=b.cate')
//            ->join('dl_member m','s.uid=m.id')
//            ->join('dl_at_ssc a','s.stage=a.stage')
//            ->field('s.id,s.stage,s.type,s.uid,s.number,s.money,s.z_money,s.multiple,s.notes,s.wei,s.denomination,b.title,m.gm_name,m.is_proxy,m.proxy_id,m.rebate,m.bonus,m.proxy_rebate,m.proxy_bonus,a.number open_number')
//            ->select();
        //print_r($list);
//        $time = '1515922800';
//        $whereData['end_time'] = array('gt',$time);
//        $stageData = Db::name('ssc_stage')->where($whereData)->find();
//        echo $stageData['stage'];

        //echo $cc;
//        $odds = Db('odds')->select();
//        $aa = round(bcdiv(6,1954,20),16);
//        foreach ($odds as $ok=>$ov){
//            $bb = round(bcmul($ov['rate'],$aa,20),16);
//            $cc = bcadd($ov['rate'],$bb,3);
//            $setData['rate'] = $cc;
//            $setData['bonus'] = 1960;
//            $where['id'] = $ov['id'];
//            Db('odds')->where($where)->setField($setData);
//        }

//        $odds = Db('odds')->select();
//        foreach ($odds as $a=>$b){
//            $ins['cate'] = $b['cate'];
//            $ins['type'] = $b['type'];
//            $id =  Db::name('bet')->where($ins)->value('id');
//            if(!$id){
//                $ins['title'] = $b['rule'];
//                Db::name('bet')->insert($ins);
//            }
//        }
//        $j = 10;
//        $k = 2000;
//        for ($i=0;$i<=100;$i++){
//            $insertData['rebate'] = $j;
//            $insertData['bonus'] = $k;
//            Db::name('rebate_list')->insert($insertData);
//            $j = $j - 0.1;
//            $k = $k - 1;
//        }


    }

    public function getStage(){
        $ssc = setSscStageTime();
        return json($ssc);
    }

    //获取开奖历史记录
    public function trend(){
        $number = getNumberCache('ssc');
        return json($number);
    }

    //获取当前用户 当前玩法奖金
    public function getReward(Request $request){
        $id = $request->post('id');
        if($id == 'lh'){
            $id = (int)$request->post('id');
            $whereData['cate'] = 1;
            $whereData['type'] = 142;
            $pl =  Db::name('odds')->where($whereData)->order('rate desc')->field('rate,group_rate,bonus,win_type')->cache(true,300)->select();
            $userPl = $this->userinfo;
            foreach ($pl as $pk=>$pv){
                $aa[$pv['win_type']] = getBonus($pv,$userPl,$id);
            }
        }else{
            $id = (int)$request->post('id');
            $whereData['cate'] = 1;
            $whereData['type'] = $id;
            $pl =  Db::name('odds')->where($whereData)->order('rate desc')->field('rate,group_rate,bonus')->cache(true,300)->find();
            $userPl = $this->userinfo;
            $aa = getBonus($pl,$userPl,$id);
        }
        return json($aa);
    }

    //投注
    public function betting(Request $request){
        $returnData['code'] = 0;
        $returnData['msg'] = '系统错误,请稍后再试';
        $dataArr = $_POST['data'];//$request->post('data');
        //$dataStage = $_POST['stage'];
        $betToken = input('bettoken');
        $bettokenCa = Cache::get('bettoken_'.$this->uid);
        if($bettokenCa){
            if($bettokenCa == $betToken){
                $returnData['code'] = 0;
                $returnData['msg'] = '请勿重复投注';
                return json($returnData);
            }else{
                Cache::set('bettoken_'.$this->uid,$betToken,3600);
            }
        }else{
            Cache::set('bettoken_'.$this->uid,$betToken,3600);
        }
        $time = time();
        $whereData['end_time'] = array('gt',$time);
        $stageData = Db::name('ssc_stage')->where($whereData)->find();

        if(!$stageData){
            $returnData['code'] = 0;
            $returnData['msg'] = '投注失败,请稍后再试(code:501)';
            return json($returnData);
        }
        if($time >= $stageData['end_bet_time']){
            $returnData['code'] = 0;
            $returnData['msg'] = '该期已封单，不能下单';
            return json($returnData);
        }

        $totalMoney = 0;

        foreach ($dataArr as $dak=>$dav){
            $singleData = object2array(json_decode($dataArr[$dak]));

            $sdv['uid'] = $this->uid;
            $sdv['stage'] = $stageData['stage'];
            $sdv['cate'] = 1;
            $sdv['type'] = $singleData['typeId'];
            $sdv['number'] = $singleData['numbers'];
            $sdv['wei'] = $singleData['place'];
            $sdv['notes'] = $singleData['zhu'];
            $sdv['multiple'] = $singleData['bei'];
            $sdv['money'] = $singleData['money'];
            $sdv['end_bet_time'] = $stageData['end_bet_time'];
            $sdv['ip'] = get_client_ip();
            $sdv['create_at'] = $time;
            $sdv['denomination'] = $singleData['denomination'];
            if(isset($singleData['hall'])){
                $sdv['hall'] = $singleData['hall'];
            }else{
                $sdv['hall'] = 1;
            }
            $totalMoney = $totalMoney + $singleData['money'];
            $insertData[] = $sdv;
            $typeName[] = $singleData['nav'];
        }

        $memWhereData['id'] = $this->uid;
        $memData = Db('member')->where($memWhereData)->find();
        if($memData['money']<$totalMoney){
            $returnData['code'] = 0;
            $returnData['msg'] = '余额不足';
            return json($returnData);
        }
        if(!$insertData){
            $returnData['code'] = 0;
            $returnData['msg'] = '数据异常';
            return json($returnData);
        }

        foreach ($insertData as $inl=>$idv) {
            Db::startTrans();
            try {
                $returnInsertData[$inl] = $insertData[$inl];
                $returnInsertData[$inl]['id'] = Db::name('single')->insertGetId($insertData[$inl]);
                $returnInsertData[$inl]['typeName'] = $typeName[$inl];
                $returnInsertData[$inl]['createTime'] = date('Y-m-d H:i:s',$idv['create_at']);
                Db::name('member')->where($memWhereData)->setDec('money',$idv['money']);
                $balance = Db::name('member')->where($memWhereData)->value('money');
                $explain = $insertData[$inl]['stage'].'期 '.$typeName[$inl].'：'.$idv['notes'].'注 '.$idv['multiple'].'倍';
                addDetail($this->uid,2,$idv['money'],$balance,5,1,$explain,$idv['hall'],$returnInsertData[$inl]['id']);
                // 提交事务
                Db::commit();
            } catch (\Exception $e) {
                // 回滚事务
                unset($returnInsertData[$inl]);
                Db::rollback();
            }
        }
        if(!empty($returnInsertData)){
            $returnData['code'] = 1;
            $returnData['data'] = $returnInsertData;
            $returnData['msg'] = '投注成功';
        }else{
            $returnData['code'] = 0;
            $returnData['msg'] = '投注失败,请稍后再试(code:502)';
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

//            if(Db('single')->where($whereData)->setInc('is_del')){
//                Db('member')->where('id',$whereData['uid'])->setInc('money',$stageData['money']);
//                $explain = $stageData['stage'].'期 撤单退款'.$stageData['money'];
//                $balance = Db('member')->where('id',$whereData['uid'])->value('money');
//                addDetail($whereData['uid'],1,$stageData['money'],$balance,8,1,$explain);
//                $returnData['code'] = 1;
//                $returnData['msg'] = '撤单成功';
//            };
        }
        return json($returnData);
    }

    public function flashMoney(){
        $uid = $this->uid;
        $returnData['code'] = 0;
        $money = Db('member')->where('id',$uid)->value('money');
        if($money){
            $returnData['code'] = 1;
            $returnData['money'] = $money;
        }
        return json($returnData);
    }

    public function playStyle(){
        return view('play_style',[

        ]);
    }

}