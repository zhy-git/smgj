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

class Report extends Home
{
    //投注记录
    public function noteRecord(){
        return view('',[
        ]);
    }
    //投注记录查询
    public function betRecord(Request $request){
        $data = $request->post();
        if (!empty($data['from'])) {
            $whereData['s.create_at'][] = array('gt', strtotime($data['from'].' 00:00:00'));
            if(!empty($data['to'])){
                $whereData['s.create_at'][] = array('lt', strtotime($data['to'].' 23:59:59'));
            }else{
                $whereData['s.create_at'][] = array('lt', time());
            }
        } else {
            if(!empty($data['to'])){
                $whereData['s.create_at'] = array('lt', strtotime($data['to']));
            }else{
                $whereData['s.create_at'][] = array('gt', strtotime(date('Y-m-d 00:00:00')));
                $whereData['s.create_at'][] = array('lt', strtotime(date('Y-m-d 23:59:59')));
            }
        }
        $whereData['s.uid'] = $this->uid;
//        if($data['target'] == 1){
//            $whereData['s.uid'] = $this->uid;
//        }
//        if($data['lotteryId']){
//            $whereData['s.cate'] = $data['lotteryId'];
//            if($data['issueNum']){
//                $whereData['s.stage'] = $data['issueNum'];
//            }
//        }
        $re = Db::name('single')
            ->where($whereData)
            ->where('is_del',0)
            ->alias('s')
            ->join('dl_cate c','c.id=s.cate')
            ->join('dl_bet b','s.type=b.type and s.cate=b.cate')
            ->join('dl_member m','s.uid=m.id')
            ->field('s.id,s.stage,s.cate,s.hall,s.type,s.uid,s.number,s.open_number,s.money,s.z_money,s.state,s.code,s.multiple,s.notes,s.create_at,s.wei,s.is_del,s.denomination,s.end_bet_time,s.odds,c.name,b.title,m.gm_name')
            ->order('s.id desc')
            ->cache(10)
            ->select();
            //->paginate(10,false,['path'=>url('betRecord','',false)."?page=[PAGE]"]);
        //$returnData['page'] = $re->render();
        //$returnData['data'] = $re->toArray();
        //print_r($re);
        if($re) {
            $newData = array();
            foreach ($re as $k => $v) {
                $date = date('Y-m-d', $v['create_at']);
                $hall_name= Db::name('hall')->where('cate',$v['cate'])->where('hall',$v['hall'])->cache(600)->value('name');
                if (array_key_exists($date, $newData)) {
                    $newData[$date]['bet']++;
                    $newData[$date]['money'] += $v['money'];
                    $newData[$date]['win'] += $v['z_money']-$v['money'];
                    if(array_key_exists($v['cate'],$newData[$date]['cate'])) {
                        $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['name'] = $v['name'];
                        $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['hall_name'] =$hall_name;
                        if(empty($newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['bet'])){
                            $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['bet']=0;
                        }
                        $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['bet'] ++;
                        $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['money'] += $v['money'];
                        $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['fan'] = 0;
                        $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['win'] += bcsub($v['z_money'],$v['money'],3);
                        $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['data'][] = $v;
                    }else{
                        $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['name'] = $v['name'];
                        $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['hall_name'] =$hall_name;
                        if(empty($newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['bet'])){
                            $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['bet']=0;
                        }
                        $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['bet'] ++;
                        if(empty($newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['money'])){
                            $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['money']=0;
                        }
                        $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['money'] += $v['money'];
                        $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['fan'] = 0;
                        if(empty($newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['win'])){
                            $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['win']=0;
                        }
                        $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['win'] += bcsub($v['z_money'],$v['money'],3);
                        $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['name'] = $v['name'];
                        $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['data'][] = $v;
                    }
                } else {
                    $newData[$date]['bet'] = 1;
                    $newData[$date]['money'] = $v['money'];
                    $newData[$date]['fan'] = 0;
                    $newData[$date]['win'] = $v['z_money']-$v['money'];
                    $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['name'] = $v['name'];
                    $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['hall_name'] =$hall_name;
                    $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['bet'] = 1;
                    $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['money'] = $v['money'];
                    $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['fan'] = 0;
                    $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['win'] = bcsub($v['z_money'],$v['money'],3);
                    $newData[$date]['cate'][$v['cate'].'0'.$v['hall']]['data'][] = $v;
                }
            }
            $returnData['code'] = 1;
            $returnData['data'] = $newData;
        }else{
            $this->error('查无资料');
        }
        //print_r($newData);
//        if($returnData['data']['data']){
//            foreach ($returnData['data']['data'] as $k=>$v){
//                if($v['is_del'] == 0) {
//                    if ($v['state'] == 1) {
//                        if ($v['code'] == 1) {
//                            $returnData['data']['data'][$k]['status'] = '已中奖';
//                        } else {
//                            $returnData['data']['data'][$k]['status'] = '未中奖';
//                        }
//                    } else {
//                        $returnData['data']['data'][$k]['status'] = '开奖中';
//                    }
//
//                }else{
//                    $returnData['data']['data'][$k]['status'] = '已撤单';
//                }
//                $returnData['data']['data'][$k]['create_at'] = date('Y-m-d H:i:s',$v['create_at']);
//            }
//        }else{
//            $returnData['data'] = null;
//        }
        return json($returnData);
    }
    //未结算明细
    public function unsettled(Request $request){
        $data = $request->post();
        if($data) {
            $s = strtotime(date('Y') . '-' . date('m') . '-' . date('d') . ' 0:0:0');
            $e = strtotime(date('Y') . '-' . date('m') . '-' . date('d') . ' 23:59:59');
            $whereData['s.create_at'] = [['>=', $s], ['<=', $e]];
            $whereData['s.state'] = 0;
            $whereData['s.is_del'] = 0;
            $whereData['s.uid'] = $this->uid;
            $re = Db::name('single')
                ->alias('s')
                ->where($whereData)
                ->join('dl_cate c','c.id=s.cate')
                ->field('s.id,s.stage,s.cate,s.hall,s.type,s.number,s.money,s.create_at,s.odds,c.name')
                ->order('s.id desc')
                ->paginate(15, false, ['path' => url('unsettled', '', false) . "?page=[PAGE]"]);
            $returnData['page'] = $re->render();
            $returnData['data'] = $re->toArray();
            if($returnData['data']['data']){
                $typeName = Db::name('bet')->cache('bet_list',60)->select();
                $oddsList = Db::name('odds')->cache(60)->select();
                $memOdds = Db::name('member')->where('id',$this->uid)->field('rebate,bonus')->find();
                foreach ($typeName as $k=>$v){
                    $typeNameArr[$v['cate']][$v['type']] = $v['title'];
                }
                foreach ($returnData['data']['data'] as $k=>$v){
                    $returnData['data']['data'][$k]['typeName'] = $typeNameArr[$v['cate']][$v['type']];
                    $returnData['data']['data'][$k]['create_at'] = date('Y-m-d H:i:s',$v['create_at']);
                }
                $returnData['data']['oddsList'] = $oddsList;
                $returnData['data']['memOdds'] = $memOdds;
            }else{
                $returnData['data'] = null;
            }
            return json($returnData);
        }else {
            return view('', [
            ]);
        }
    }
    //今日结算明细
    public function settled(Request $request){
        $data = $request->post();
        if($data) {
            $s = strtotime(date('Y') . '-' . date('m') . '-' . date('d') . ' 0:0:0');
            $e = strtotime(date('Y') . '-' . date('m') . '-' . date('d') . ' 23:59:59');
            $whereData['s.create_at'] = [['>=', $s], ['<=', $e]];
            $whereData['s.state'] = 1;
            $whereData['s.is_del'] = 0;
            $whereData['s.uid'] = $this->uid;
            $re = Db::name('single')
                ->alias('s')
                ->where($whereData)
                ->join('dl_cate c','c.id=s.cate')
                ->field('s.id,s.stage,s.cate,s.hall,s.type,s.number,s.money,s.create_at,s.is_del,s.code,s.odds,s.z_money,c.name')
                ->order('s.id desc')
                ->paginate(15, false, ['path' => url('settled', '', false) . "?page=[PAGE]"]);
            $returnData['page'] = $re->render();
            $returnData['data'] = $re->toArray();
            if($returnData['data']['data']){
                $typeName = Db::name('bet')->cache('bet_list',60)->select();
                foreach ($typeName as $k=>$v){
                    $typeNameArr[$v['cate']][$v['type']] = $v['title'];
                }
                foreach ($returnData['data']['data'] as $k=>$v){
                    $returnData['data']['data'][$k]['typeName'] = $typeNameArr[$v['cate']][$v['type']];
                    $returnData['data']['data'][$k]['create_at'] = date('Y-m-d H:i:s',$v['create_at']);
                    if($v['is_del'] == 0) {
                        if ($v['code'] == 1) {
                            $returnData['data']['data'][$k]['status'] = '已中奖';
                        } else {
                            $returnData['data']['data'][$k]['status'] = '未中奖';
                        }
                    }else{
                        $returnData['data']['data'][$k]['status'] = '已撤单';
                    }
                    $returnData['data']['data'][$k]['win'] = bcsub($v['z_money'],$v['money'],3);
                }
            }else{
                $returnData['data'] = null;
            }
            return json($returnData);
        }else {
            return view('', [
            ]);
        }
    }
    //个人资讯
    public function personalInformation(){
        $oddsList = Db::name('odds')->cache(60)->select();
        $mem = Db::name('member')->where('id',$this->uid)->field('rebate,bonus')->find();
        return view('',[
            'oddsList'=>$oddsList,
            'mem'=>$mem
        ]);
    }
    //规则
    public function rule(Request $request){
        $cate=$request->param('cate');
        return view('',[
            'cate'=>$cate,
        ]);
    }
    //开奖结果
    public function openResult(Request $request){
        $data = $request->post();
        if($data) {
            if($data['cate'] == 8){
                $thirtyDaysAgo = strtotime('-30 day', time());
                $whereTime['create_time'][] = array('gt', date($thirtyDaysAgo));
                $whereTime['create_time'][] = array('lt', date($data['date'].' 23:59:59'));
            }else{
                $whereTime['create_time'][] = array('gt', date($data['date'].' 00:00:00'));
                $whereTime['create_time'][] = array('lt', date($data['date'].' 23:59:59'));
            }
            $database = Db::name('cate')->where('id',$data['cate'])->value('nickname');
            $openNumList = Db::name('at_'.$database)->where($whereTime)->order('id DESC')->paginate(10, false, ['path' => url('openResult', '', false) . "?page=[PAGE]"]);
            $returnData['page'] = $openNumList->render();
            $returnData['data'] = $openNumList->toArray();
            return json($returnData);
        }else{
            $cate_id = $request->param('cate');
            $cateList = Db::name('cate')->cache('cate_list', 60)->field('id,name')->select();
            return view('', [
                'cateList' => $cateList,
                'cate_id'=>$cate_id,
            ]);
        }
    }
}