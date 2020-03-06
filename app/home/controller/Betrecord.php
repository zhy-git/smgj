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

class Betrecord extends Home
{
    public function index(){
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
//        $returnData['recordsFiltered'] = 1;
//        $returnData['recordsTotal'] = 1;
//        $returnData['draw'] = 0;
////        $returnData['data'][0]['ReturnAmount'] = 0.000;
////        $returnData['data'][0]['EarnedAmount'] = -5.000;
//        $returnData['data'][0]['Prize'] = 0.00000;
//        //$returnData['data'][0]['CreateTime'] = "/Date(1516683286587)/";
//        $returnData['data'][0]['Cost'] = 5.0000;
////        $returnData['data'][0]['HideBetNumber'] = false;
////        $returnData['data'][0]['State'] = 2;
////        $returnData['data'][0]['HashKey'] = 3;
////        $returnData['data'][0]['BetTypeCode'] = 21;
////        $returnData['data'][0]['ReturnRate'] = 0;
//        $returnData['data'][0]['ID'] = 335659620;
//        $returnData['data'][0]['StateStr'] = "未中奖";
//        $returnData['data'][0]['CreateTimeStr'] = "2018/01/23 12:54:46";
//        //$returnData['data'][0]['BetProposalID'] = null;
//        $returnData['data'][0]['WinningNumber'] = "6,6,7,5,0";
//        $returnData['data'][0]['IssueSerialNumber'] = "20180123042";
//        $returnData['data'][0]['LotteryGameName'] = "重庆时时彩";
//        $returnData['data'][0]['BetTypeName'] = "定位胆";
//        $returnData['data'][0]['Number'] = "4,4,4,4,4";
//        //$returnData['data'][0]['SerialNumber'] = "123125446203047";
    }

    //投注详情
    public function GetDetail(Request $request){
        $data = $request->post();
        $singleData = Db::name('single')
            ->alias('s')
            ->where('s.id',$data['ID'])
            ->join('dl_cate c','c.id=s.cate')
            ->join('dl_bet b','s.type=b.type and s.cate=b.cate')
            ->join('dl_member m','s.uid=m.id')
            ->field('s.id,s.stage,s.cate,s.type,s.uid,s.number,s.open_number,s.money,s.z_money,s.state,s.code,s.multiple,s.notes,s.create_at,s.wei,s.is_del,s.denomination,s.end_bet_time,c.name,b.title,m.gm_name')
            ->find();
        $returnData['bet']['UserInfoLoginID'] = $singleData['gm_name'];
        $returnData['bet']['IssueLotteryName'] = $singleData['name'];
        $returnData['bet']['BetTypeName'] = $singleData['title'];
        $returnData['bet']['IssueSerialNumber'] = $singleData['stage'];
        $returnData['bet']['CreateTimeStr'] = date('Y-m-d H:i:s',$singleData['create_at']);
        $denomination = strlen($singleData['denomination']);
        switch ($denomination){
            case 1:
                $returnData['bet']['UnitStr'] = '2元';
                break;
            case 3:
                $returnData['bet']['UnitStr'] = '2角';
                break;
            case 4:
                $returnData['bet']['UnitStr'] = '2分';
                break;
            case 5:
                $returnData['bet']['UnitStr'] = '2厘';
                break;
        }
        $returnData['bet']['Multiple'] = $singleData['multiple'];

        $returnData['bet']['Position'] = '1,2,3,4,5';
        $returnData['bet']['OddsDisplay'] = 96.6;
        $returnData['bet']['ReturnRate'] = 0;

        $returnData['bet']['SerialNumber'] = $singleData['id'];
        $returnData['bet']['Cost'] = $singleData['money'];
        $time = time();
        //{BET: 0, CANCEL: 1, NOPRIZE: 2, WIN: 3}
        if($singleData['is_del'] == 0) {
            if ($singleData['state'] == 1) {
                if ($singleData['code'] == 1) {
                    $returnData['bet']['StateStr'] = '已中奖';
                    $returnData['bet']['State'] = 3;
                } else {
                    $returnData['bet']['StateStr'] = '未中奖';
                    $returnData['bet']['State'] = 2;
                }
            } else {
                $returnData['bet']['StateStr'] = '开奖中';
            }
            if ($singleData['end_bet_time'] < $time) {
                $returnData['bet']['State'] = 1;
            } else {
                $returnData['bet']['State'] = 0;
            }
        }else{
            $returnData['bet']['State'] = 1;
            $returnData['bet']['StateStr'] = '已撤单';
        }
        $returnData['bet']['Prize'] = $singleData['z_money'];;
        $returnData['bet']['BetPrizes'] = array();

        $returnData['bet']['Count'] = $singleData['notes'];
        $returnData['bet']['WinningNumber'] = $singleData['notes'];
        $returnData['bet']['Number'] = $singleData['number'];

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

}