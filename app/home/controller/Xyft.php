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

class Xyft extends Home
{
    public function index(){
        $hall = input('hall');
        $cate = input('cate');
        switch ($hall){
            case 1:
                $field = 'id,cate,rule,win_rule,rate,bonus,bet_max,stage_bet_max,type,sort';
                break;
            case 2:
                $field = 'id,cate,rule,win_rule,rate_two as rate,bonus,bet_max,stage_bet_max,type,sort';
                break;
            case 3:
                $field = 'id,cate,rule,win_rule,rate_three as rate,bonus,bet_max,stage_bet_max,type,sort';
                break;
        }
        $number = getNumberCache('xyft');
        $openStage = key($number); //获取最新一期的key（即期数）
        //获取用户信息
        $memDetail = Db::name('member')->where('id',$this->uid)->field('gm_name,money,unpaid_money,ag_money,bb_money,rebate,bonus')->find();
        //获取公共赔率
        $oddsList = Db::name('odds')->field($field)->where('cate',$cate)->cache(10)->select();
        //获取历史开奖数据
        $whereTime['end_time'][] = array('gt', strtotime(date('Y-m-d 00:00:00')));
        $whereTime['end_time'][] = array('lt', strtotime(date('Y-m-d 23:59:59')));
        $openList = Db::name('xyft_stage')->where($whereTime)->order('id DESC')->select();
        //获取当前最新注单
        //计算下期的数字
        $whereData['end_time'] = array('gt',time());
        $stage = Db::name('xyft_stage')->where($whereData)->find();
        $whereSingle['s.uid'] =  $this->uid;
        $whereSingle['s.cate'] = $cate;
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
                $type_arr = Db::name('bet')->where('cate',$cate)->where('type','<=','10')->column('type');
                $type_title_arr = Db::name('bet')->where('cate',$cate)->where('type','<=','10')->column('title');
                foreach ($type_arr as $k => $v){
                    $rule_data['qiu'][$k]['info'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type',$v)->where('sort','>',8)->where('status',1)->order('sort')->cache(60)->select();
                    $rule_data['qiu'][$k]['type']=$v;
                    $rule_data['qiu'][$k]['type_name'] = $type_title_arr[$k];
                }
                $rule_data['qiu'] = oneToTwo($rule_data['qiu'],5);
                $template = 'two';
                break;
            case 'three':
                $rule_data['gyhsz'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type',14)->where('status',1)->order('id')->cache(60)->select();
                $rule_data['gyhsz'] = oneToTwo($rule_data['gyhsz'],4);
                $rule_data['gyhlm'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type',13)->where('status',1)->order('sort')->cache(60)->select();
                $template = 'three';
                break;
            default:
                $type_arr = Db::name('bet')->where('cate',$cate)->where('type','<=','10')->column('type');
                $type_title_arr = Db::name('bet')->where('cate',$cate)->where('type','<=','10')->column('title');
                foreach ($type_arr as $k => $v){
                    $rule_data['qiu'][$k]['info'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type',$v)->where('sort','<=',8)->where('status',1)->order('sort')->cache(60)->select();
                    $rule_data['qiu'][$k]['type']=$v;
                    $rule_data['qiu'][$k]['type_name'] = $type_title_arr[$k];
                }
                $rule_data['qiu'] = oneToTwo($rule_data['qiu'],5);
                foreach ($type_arr as $k => $v){
                    $rule_data['mc'][$k]['info'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type',$v)->where('status',1)->order('sort')->cache(60)->select();
                    $rule_data['mc'][$k]['type']=$v;
                    $rule_data['mc'][$k]['type_name'] = $type_title_arr[$k];
                }
                $rule_data['gyh'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type',13)->where('status',1)->order('sort')->cache(60)->select();
                $rule_data['gyhsz'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type',14)->where('status',1)->order('sort')->cache(60)->select();
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
            'newSingleList'=>$newSingleList,
            'rule_data'=>$rule_data,
            'cate'=>$cate,
            'hall'=>$hall,
        ]);
    }
    public function getStage(){
        $ssc = setXyftStageTime();
        return json($ssc);
    }
    //投注
    public function betting(Request $request){
        $data = $request->post();
        $returnData['code'] = 0;
        $returnData['msg'] = '系统错误,请稍后再试';
        $time = time();
        $whereData['end_time'] = array('gt',$time);
        $stageData = Db::name('xyft_stage')->where($whereData)->find();

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
            $sdv['cate'] = $data['cate'];
            $sdv['hall'] = $data['hall'];
            $sdv['odds'] = $dav['odds'];
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
                $bet_status = Db::name('bet')->where('cate',$idv['cate'])->where('type',$idv['type'])->value('status');
                if(!$bet_status){
                    Db::rollback();
                    $error = '玩法：'.$typeNameArr[$idv['cate']][$idv['type']].'&nbsp;&nbsp;&nbsp;&nbsp;'.'已关闭';
                    return json(array('code'=>0,'msg'=>$error));
                    break;
                }
                $bet_max = $this->getBetMax($idv['type'],$idv['number'],$idv['cate']);
                if($idv['money']>$bet_max){
                    Db::rollback();
                    $error = $typeNameArr[$idv['cate']][$idv['type']].'-'.$idv['number'].'单注投注超额，单注最高投注'.$bet_max;
                    return json(array('code'=>0,'msg'=>$error));
                    break;
                }
                $returnInsertData[$inl] = $insertData[$inl];
                $insertData[$inl]['odds'] = $this->getOdds($idv['type'],$idv['number'],$idv['cate'],$idv['hall'],$idv['odds']);
                $returnInsertData[$inl]['id'] = Db::name('single')->insertGetId($insertData[$inl]);
                $returnInsertData[$inl]['typeName'] = $typeNameArr[$idv['cate']][$idv['type']];
                $returnInsertData[$inl]['createTime'] = date('Y-m-d H:i:s',$idv['create_at']);
                $returnInsertData[$inl]['odds'] = $insertData[$inl]['odds'];
                $updateData['money'] = array('exp', 'money-'.$idv['money']);
                $updateData['unpaid_money'] = array('exp', 'unpaid_money+'.$idv['money']);
                Db::name('member')->where($memWhereData)->update($updateData);
                $balance = Db::name('member')->where($memWhereData)->value('money');
                $explain = $insertData[$inl]['stage'].'期 '.$typeNameArr[$idv['cate']][$idv['type']].'：'.$idv['notes'].'注 '.$idv['multiple'].'倍';
                addDetail($this->uid,2,$idv['money'],$balance,5,$idv['cate'],$explain,1,$returnInsertData[$inl]['id']);
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
    public function getBetMax($type,$number,$cate){
        $a = Db::name('odds')->where('type',$type)->where('rule',$number)->where('cate',$cate)->find();
        if($a){
            return $a['bet_max'];
        }else{
            $returnData['error_code'] = 501;
            return $returnData;
        }
    }
    //获取赔率
    public function getOdds($type,$number,$cate,$hall,$odds){
        $a = Db::name('odds')->where('type',$type)->where('rule',$number)->where('cate',$cate)->find();
        if($a){
            switch ($hall){
                case 1:
                    $rate = $a['rate'];
                    break;
                case 2:
                    $rate = $a['rate_two'];
                    break;
                case 3:
                    $rate = $a['rate_three'];
                    break;
            }
            return $rate;
        }else{
            return $odds;
        }
//        $pl = getPl($returnData['win_id']);
//        $perMoney = getBonus($pl, $user);
//        return $perMoney;
    }
}

