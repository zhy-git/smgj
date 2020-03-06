<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/11/1
 * Time: 16:02
 */

namespace app\home\controller;
use app\admin\model\Members;
use think\Request;
use think\Cache;
use think\Db;

class Pcdd extends Home
{
    public function index(){
        $number = getNumberCache('pcdd');
        $openStage = key($number); //获取最新一期的key（即期数）
        //获取用户信息
        $memDetail = Db::name('member')->where('id',$this->uid)->field('gm_name,money,unpaid_money,ag_money,bb_money,rebate,bonus')->find();
        //获取公共赔率
        $oddsList = Db::name('odds')->where('cate',6)->cache(10)->select();
        //获取历史开奖数据
        $whereTime['end_time'][] = array('gt', strtotime(date('Y-m-d 00:00:00')));
        $whereTime['end_time'][] = array('lt', strtotime(date('Y-m-d 23:59:59')));
        $openList = Db::name('pcdd_stage')->where($whereTime)->order('id DESC')->select();
        //获取当前最新注单
        //计算下期的数字
        $whereData['end_time'] = array('gt',time());
        $stage = Db::name('pcdd_stage')->where($whereData)->find();
        $whereSingle['s.uid'] =  $this->uid;
        $whereSingle['s.cate'] = 6;
        $whereSingle['s.state'] = 0;
        $whereSingle['stage'] = $stage['stage'];
        $newSingleList = Db::name('single')
            ->alias('s')
            ->where($whereSingle)
            ->join('dl_bet b','s.type=b.type and s.cate=b.cate')
            ->order('s.id DESC')
            ->limit(30)
            ->field('s.stage,s.odds,s.money,s.number,b.title')
            ->select();
        if($newSingleList){
            foreach ($newSingleList as $k=>$v){
                $openListNew[$v['stage']] = $v;
            }
        }else{
            $openListNew = '';
        }
        $typePage = input('type');
        switch ($typePage){
            case 'two':
                $template = 'two';
                break;
            case 'three':
                $template = 'three';
                break;
            default:
                $template = 'index';
                break;
        }
        return view($template,[
            'openList'=>$openList,
            'openListNew'=>$openListNew,
            'openStage'=>$openStage,
            'openNum'=>$number[$openStage]['number'],
            'mem'=>$memDetail,
            'oddsList'=>$oddsList,
            'newSingleList'=>$newSingleList
        ]);
    }
    public function getStage(){
        $ssc = setPcddStageTime();
        return json($ssc);
    }
    //投注
    public function betting(Request $request){
        $data = $request->post();
        $returnData['code'] = 0;
        $returnData['msg'] = '系统错误,请稍后再试';
//        $betToken = input('bettoken');
//        $bettokenCa = Cache::get('bettoken_'.$this->uid);
//        if($bettokenCa){
//            if($bettokenCa == $betToken){
//                $returnData['code'] = 0;
//                $returnData['msg'] = '请勿重复投注';
//                return json($returnData);
//            }else{
//                Cache::set('bettoken_'.$this->uid,$betToken,3600);
//            }
//        }else{
//            Cache::set('bettoken_'.$this->uid,$betToken,3600);
//        }
        $time = time();
        $whereData['end_time'] = array('gt',$time);
        $stageData = Db::name('pcdd_stage')->where($whereData)->find();

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
        foreach ($data['data'] as $dak=>$dav){
            $sdv['uid'] = $this->uid;
            $sdv['stage'] = $stageData['stage'];
            $sdv['cate'] = 6;
            $sdv['type'] = $dav['type'];
            $sdv['number'] = $dav['num'];
            $sdv['notes'] = 1;
            $sdv['multiple'] = 1;
            $sdv['money'] = $dav['money'];
            $sdv['end_bet_time'] = $stageData['end_bet_time'];
            $sdv['ip'] = get_client_ip();
            $sdv['create_at'] = $time;
            $sdv['denomination'] = 2;

            $totalMoney = $totalMoney + $dav['money'];
            $insertData[] = $sdv;
        }

        $memWhereData['id'] = $this->uid;
        $memData = Db::name('member')->where($memWhereData)->find();

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
        $typeName = Db::name('bet')->cache('bet_list',60)->select();
        foreach ($typeName as $k=>$v){
            $typeNameArr[$v['cate']][$v['type']] = $v['title'];
        }
//        print_r($typeNameArr);
//        print_r($insertData);
        foreach ($insertData as $inl=>$idv) {

            Db::startTrans();
            try {
                $returnInsertData[$inl] = $insertData[$inl];
                $insertData[$inl]['odds'] = $this->getOdds($idv['type'],$idv['number'],$memData);
                $returnInsertData[$inl]['id'] = Db::name('single')->insertGetId($insertData[$inl]);
                $returnInsertData[$inl]['typeName'] = $typeNameArr[6][$idv['type']];
                $returnInsertData[$inl]['createTime'] = date('Y-m-d H:i:s',$idv['create_at']);
                $returnInsertData[$inl]['odds'] = $insertData[$inl]['odds'];
                $updateData['money'] = array('exp', 'money-'.$idv['money']);
                $updateData['unpaid_money'] = array('exp', 'unpaid_money+'.$idv['money']);
                Db::name('member')->where($memWhereData)->update($updateData);
                $balance = Db::name('member')->where($memWhereData)->value('money');
                $explain = $insertData[$inl]['stage'].'期 '.$typeNameArr[2][$idv['type']].'：'.$idv['notes'].'注 '.$idv['multiple'].'倍';
                addDetail($this->uid,2,$idv['money'],$balance,5,6,$explain,1,$returnInsertData[$inl]['id']);
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
            $returnData['data'] = array_reverse($returnInsertData);
            $returnData['msg'] = '投注成功';
        }else{
            $returnData['code'] = 0;
            $returnData['msg'] = '投注失败,请稍后再试(code:502)';
        }
        return json($returnData);
    }
    //获取赔率
    public function getOdds($type,$number,$user){
        switch ($type){
            case 1:
                switch ($number){
                    case '大':
                    case '小':
                    case '单':
                    case '双':
                        $returnData['win_id'] = 62;
                        break;
                    case '极大':
                    case '极小':
                        $returnData['win_id'] = 64;
                        break;
                    case '豹子':
                        $returnData['win_id'] = 65;
                        break;
                }
                break;
            case 2:
                $returnData['win_id'] = 66;
                break;
            case 3:
                switch ($number){
                    case 0:
                        $returnData['win_id'] = 67;
                        break;
                    case 1:
                    case 26:
                        $returnData['win_id'] = 68;
                        break;
                    case 2:
                    case 25:
                        $returnData['win_id'] = 69;
                        break;
                    case 3:
                        $returnData['win_id'] = 70;
                        break;
                    case 4:
                    case 23:
                        $returnData['win_id'] = 71;
                        break;
                    case 5:
                    case 22:
                        $returnData['win_id'] = 72;
                        break;
                    case 6:
                    case 21:
                        $returnData['win_id'] = 73;
                        break;
                    case 7:
                    case 20:
                        $returnData['win_id'] = 74;
                        break;
                    case 8:
                    case 19:
                        $returnData['win_id'] = 75;
                        break;
                    case 9:
                    case 18:
                        $returnData['win_id'] = 76;
                        break;
                    case 10:
                    case 17:
                        $returnData['win_id'] = 77;
                        break;
                    case 11:
                    case 16:
                        $returnData['win_id'] = 78;
                        break;
                    case 12:
                    case 15:
                        $returnData['win_id'] = 79;
                        break;
                    case 13:
                    case 14:
                        $returnData['win_id'] = 80;
                        break;
                    case 24:
                        $returnData['win_id'] = 81;
                        break;
                    case 27:
                        $returnData['win_id'] = 82;
                        break;
                }
                break;
        }
        $pl = getPl($returnData['win_id']);
        $perMoney = getBonus($pl, $user);
        return $perMoney;
    }
}

