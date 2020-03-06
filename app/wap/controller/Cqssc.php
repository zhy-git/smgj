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

class Cqssc extends Home
{
    public function index(){
        $number = getNumberCache('cqssc');
        $openStage = key($number); //获取最新一期的key（即期数）
        //获取用户信息
        $memDetail = Db::name('member')->where('id',$this->uid)->field('gm_name,money,unpaid_money,ag_money,bb_money,rebate,bonus')->find();
        //获取公共赔率
        $oddsList = Db::name('odds')->where('cate',2)->cache(10)->select();

        //获取历史开奖数据
        $whereTime['end_time'][] = array('gt', strtotime(date('Y-m-d 00:00:00')));
        $whereTime['end_time'][] = array('lt', strtotime(date('Y-m-d 23:59:59')));
        $openList = Db::name('cqssc_stage')->where($whereTime)->order('id DESC')->select();
        //获取当前最新注单
        //计算下期的数字
        $whereData['end_time'] = array('gt',time());
        $stage = Db::name('cqssc_stage')->where($whereData)->find();
        $whereSingle['s.uid'] =  $this->uid;
        $whereSingle['s.cate'] = 2;
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
            case 'ballOne':
                $template = 'ballone';
                break;
            case 'ballTwo':
                $template = 'balltwo';
                break;
            case 'ballThree':
                $template = 'ballthree';
                break;
            case 'ballFour':
                $template = 'ballfour';
                break;
            case 'ballFive':
                $template = 'ballfive';
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
    //我的投注
    public function quickSearch(){
        $whereData['uid'] = $this->uid;
        $singleList = Db::name('single')->alias('s')
            ->join('dl_cate c','c.id=s.cate')
            ->join('dl_bet b','b.type=s.type')
            ->field('c.name,b.title,s.*')
            ->order('s.id DESC')
            ->where($whereData)
            ->limit(100)
            ->select();
        $returnData['recordsTotal'] = 0;
        $returnData['draw'] = 0;
        $time = time();
        foreach ($singleList as $k=>$v){
            $returnData['data'][$k]['Prize'] = $v['z_money'];
            $returnData['data'][$k]['Cost'] = $v['money'];
            if($v['is_del'] == 0) {
                if ($v['end_bet_time'] < $time) {
                    $returnData['data'][$k]['State'] = 1;
                } else {
                    $returnData['data'][$k]['State'] = 0;
                }
            }else{
                $returnData['data'][$k]['is_ce'] = 1;
            }
            $returnData['data'][$k]['ID'] = $v['id'];
            if($v['is_del'] == 0) {
                if ($v['state'] == 1) {
                    if ($v['code'] == 1) {
                        $returnData['data'][$k]['StateStr'] = '已中奖';
                    } else {
                        $returnData['data'][$k]['StateStr'] = '未中奖';
                    }
                } else {
                    $returnData['data'][$k]['StateStr'] = '开奖中';
                }
            }else{
                $returnData['data'][$k]['StateStr'] = '已撤单';
            }
            $returnData['data'][$k]['CreateTimeStr'] = date('Y-m-d H:i:s',$v['create_at']);
            $returnData['data'][$k]['WinningNumber'] = $v['open_number'];
            $returnData['data'][$k]['IssueSerialNumber'] = $v['stage'];
            $returnData['data'][$k]['LotteryGameName'] = $v['name'];
            $returnData['data'][$k]['BetTypeName'] = $v['title'];
            $returnData['data'][$k]['Number'] = $v['number'];
            $returnData['recordsTotal'] ++;
        }
        return json($returnData);
    }
    //获取倒计时
    public function getStage(){
        $ssc = setCqSscStageTime();
        return json($ssc);
    }
    public function info(){
        $ccRemind = Cache::pull('ccRemind');

        print_r($ccRemind);
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
        $stageData = Db::name('cqssc_stage')->where($whereData)->find();

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
            $sdv['cate'] = 2;
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
        foreach ($insertData as $inl=>$idv) {
            Db::startTrans();
            try {
                $returnInsertData[$inl] = $insertData[$inl];
                $insertData[$inl]['odds'] = $this->getOdds($idv['type'],$idv['number'],$memData);
                $returnInsertData[$inl]['id'] = Db::name('single')->insertGetId($insertData[$inl]);
                $returnInsertData[$inl]['typeName'] = $typeNameArr[2][$idv['type']];
                $returnInsertData[$inl]['createTime'] = date('Y-m-d H:i:s',$idv['create_at']);
                $returnInsertData[$inl]['odds'] = $insertData[$inl]['odds'];
                $updateData['money'] = array('exp', 'money-'.$idv['money']);
                $updateData['unpaid_money'] = array('exp', 'unpaid_money+'.$idv['money']);
                Db::name('member')->where($memWhereData)->update($updateData);
                $balance = Db::name('member')->where($memWhereData)->value('money');
                $explain = $insertData[$inl]['stage'].'期 '.$typeNameArr[2][$idv['type']].'：'.$idv['notes'].'注 '.$idv['multiple'].'倍';
                addDetail($this->uid,2,$idv['money'],$balance,5,2,$explain,1,$returnInsertData[$inl]['id']);
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
            case 1://总和-龙虎和
                switch ($number){
                    case '总和大':
                    case '总和小':
                    case '总和单':
                    case '总和双':
                        $returnData['win_id'] = 1;
                        break;
                    case '龙':
                        $returnData['win_id'] = 2;
                        break;
                    case '虎':
                        $returnData['win_id'] = 3;
                        break;
                    case '和':
                        $returnData['win_id'] = 4;
                        break;
                    default :
                        $returnData['error_code'] = 501;
                        return $returnData;
                        break;
                }
                break;
            case 2://第一球
            case 3://第二球
            case 4://第三球
            case 5://第四球
            case 6://第五球
                switch ($number){
                    case '大':
                    case '小':
                    case '单':
                    case '双':
                        $returnData['win_id'] = 5;
                        break;
                    default :
                        $returnData['win_id'] = 6;
                        break;
                }
                break;
            case 7://前三
            case 8://中三
            case 9://后三
                switch ($number){
                    case '豹子':
                        $returnData['win_id'] = 7;
                        break;
                    case '顺子':
                        $returnData['win_id'] = 8;
                        break;
                    case '对子':
                        $returnData['win_id'] = 9;
                        break;
                    case '半顺':
                        $returnData['win_id'] = 10;
                        break;
                    case '杂六':
                        $returnData['win_id'] = 11;
                        break;
                }
                break;
        }
        $pl = getPl($returnData['win_id']);
        $perMoney = getBonus($pl, $user);
        return $perMoney;
    }
}