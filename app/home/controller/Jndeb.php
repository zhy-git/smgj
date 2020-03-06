<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/11/1
 * Time: 16:02
 */

namespace app\home\controller;
use app\admin\model\Members;
use Nx\RongCloud\RongCloud;
use think\Request;
use think\Cache;
use think\Db;

class Jndeb extends Home
{
    public function index(){
        $hall = input('hall');
        $cate = input('cate');
        $room_id = $cate.'0'.$hall;
        $rongData=[];
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
        $number = getNumberCache('jndeb');
        $openStage = key($number); //获取最新一期的key（即期数）
        //获取用户信息
        $memDetail = Db::name('member')->where('id',$this->uid)->field('gm_name,money,unpaid_money,head,ag_money,bb_money,rebate,bonus')->find();
        //获取公共赔率
        $oddsList = Db::name('odds')->field($field)->where('cate',$cate)->cache(10)->select();
        //获取历史开奖数据
        $whereTime['end_time'][] = array('gt', strtotime(date('Y-m-d 00:00:00')));
        $whereTime['end_time'][] = array('lt', strtotime(date('Y-m-d 23:59:59')));
        $openList = Db::name('pcdd_stage')->where($whereTime)->order('id DESC')->select();
        $notice = Db::name('notice')->order('id desc')->limit(5)->select();
        //计算下期的数字
        $whereData['end_time'] = array('gt',time());
        $stage = Db::name('jndeb_stage')->where($whereData)->find();
        $whereSingle['s.uid'] =  $this->uid;
        $whereSingle['s.cate'] = $cate;
        $whereSingle['s.state'] = 0;
        $whereSingle['stage'] = $stage['stage'];
        $newSingleList = Db::name('single')
            ->alias('s')
            ->where($whereSingle)
            ->where('is_del',0)
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
        $title='加拿大28';
        if($hall==1){
            switch ($typePage){
                case 'two':
                    $template = 'two';
                    break;
                case 'three':
                    $template = 'three';
                    break;
                default:
                    $rule_data['hh'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type',1)->where('status',1)->order('sort')->cache(60)->select();
                    $rule_data['hh'] = oneToTwo($rule_data['hh'],4);
                    $rule_data['tm'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type',2)->where('status',1)->order('sort')->cache(60)->select();
                    $rule_data['tm'] = oneToTwo($rule_data['tm'],4);
                    $rule_data['ts'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type',3)->where('status',1)->order('sort')->cache(60)->select();
                    $rule_data['ts'] = oneToTwo($rule_data['ts'],4);
                    $template = 'index';
                    break;
            }
        }else{
            $rule_data['hh'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type',1)->where('status',1)->order('sort')->cache(60)->select();
            $rule_data['hh'] = oneToTwo($rule_data['hh'],4);
            $rule_data['tm'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type',2)->where('status',1)->order('sort')->cache(60)->select();
            $rule_data['tm'] = oneToTwo($rule_data['tm'],4);
            $rule_data['ts'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type',3)->where('status',1)->order('sort')->cache(60)->select();
            $rule_data['ts'] = oneToTwo($rule_data['ts'],4);
            $template='room';
            if($hall==2){
                $title="加拿大1.85模式";
            }elseif ($hall==3){
                $title="加拿大1.6模式";
            }
            // 获取融云key
            $rong_key_secret=get_rong_key_secret();
            $rongData=array(
                'uid'=>$this->uid, // 用户id
                'head'=>($memDetail['head']?$memDetail['head']:'/static/home/img/wap_new/head.png'),// 头像
                'username'=>$memDetail['gm_name'],             // 用户名
                'rong_key'=>$rong_key_secret['key'],           // 融云key
                'rong_token'=>get_rongcloud_token($this->uid), //获取融云token
                'room_id' => $room_id,
            );
            //创建加入聊天室content
            $RongCloud =new RongCloud($rong_key_secret['key'],$rong_key_secret['secret']);
            //加入聊天
            $RongCloud->chatroom()->join($this->uid, $room_id);
            $welcome='欢迎【'.$memDetail['gm_name'].'进入房间';
            $memDetail['head'] = $memDetail['head']?$memDetail['head']:'/static/home/img/wap_new/head.png';
            $content = json_encode(array('content'=>$welcome,'extra'=>array('head'=>$memDetail['head'],'name'=>$memDetail['gm_name'],'time'=>date('H:i:s',time()),'type'=>2)));
            //加入聊天室消息
            $re = rongMsg(9999999,[$room_id],$content);
        }
        return view($template,[
            'openList'=>$openList,
            'openListNew'=>$openListNew,
            'openStage'=>$openStage,
            'openNum'=>$number[$openStage]['number'],
            'mem'=>$memDetail,
            'oddsList'=>$oddsList,
            'rule_data'=>$rule_data,
            'newSingleList'=>$newSingleList,
            'cate'=>$cate,
            'hall'=>$hall,
            'title'=>$title,
            'cache'=>'jndeb',
            'rongData'=>$rongData,
            'notice'=>$notice,
        ]);
    }
    public function getStage(){
        $ssc = setJndebStageTime();
        return json($ssc);
    }
    public function getStageList(Request $request){
        $list=array();
        $data = $request->post();
        $list = Db::name('single')
            ->where('cate',2)
            ->where('stage',$data['stage'])
            ->where('is_del',0)
            ->where('state',0)
            ->where('uid',session('member_info')['uid'])
            ->order('create_at')->select();
        if($list){
            foreach ($list as $k => $v) {
                $list[$k]['typeName']=Db::name('bet')->where('type',$v['type'])->where('cate',$v['cate'])->value('title');
            }
        }
        return json($list);
    }
    //投注
    public function betting(Request $request){
        $data = $request->post();
        $returnData['code'] = 0;
        $returnData['msg'] = '系统错误,请稍后再试';
        $time = time();
        $whereData['end_time'] = array('gt',$time);
        $stageData = Db::name('jndeb_stage')->where($whereData)->find();
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

        $cate_info = Db::name('cate')->where('id',$data['cate'])->find();
        $hall_info = Db::name('hall')->where('cate',$data['cate'])->where('hall',$data['hall'])->find();
        if($cate_info['status']!=1){
            $returnData['msg'] = '彩种已关闭！';
        }
        if($hall_info['status']){
            $returnData['msg'] = '该房间已关闭！';
        }
        $totalMoney = 0;
        foreach ($data['data'] as $dak=>$dav){
            if($dav['money']<5){
                $returnData['msg'] = '下注单码5元起';
                return json($returnData);
            }
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
            if($data['hall']>1){
                $sdv['is_room']=1;
            }
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
                $betting_money = Db::name('single')->where('stage',$idv['stage'])->where('cate',$idv['cate'])->where('hall',$idv['hall'])->where('is_del',0)->where('number',$idv['number'])->sum('money');
                if(bcadd($idv['money'],$betting_money,2)>$bet_max){
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
                $explain = getCate($idv['cate'],'name').'-'.getHall($idv['cate'],$idv['hall']).'-'.$insertData[$inl]['stage'].'期 '.$typeNameArr[$v['cate']][$idv['type']].'-'.$idv['number'].'：'.$idv['notes'].'注 '.$idv['multiple'].'倍';
                if($idv['hall']>1){
                    $is_room=1;
                }else{
                    $is_room=0;
                }
                addDetail($this->uid,2,$idv['money'],$balance,5,$idv['cate'],$explain,$idv['cate'],$returnInsertData[$inl]['id'],$is_room);
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
            if($data['hall']==2 || $data['hall'] == 3){
                $memberInfo = Db::name('member')->where('id',$this->uid)->cache(60)->find();
                $memberInfo['head'] = $memberInfo['head']?$memberInfo['head']:'/static/home/img/wap_new/head.png';
                $returnData['info'] = array('head'=>$memberInfo['head'],'name'=>$memberInfo['gm_name'] ,'time'=>date('H:i:s',time()),'type'=>1);
                $returnData['money'] = Db::name('member')->where('id',$this->uid)->value('money');
                $content=array('content'=>$returnData['data'],'extra'=>$returnData['info']);
                $re = rongMsg($this->uid,[$data['cate'].'0'.$data['hall']],json_encode($content));
            }
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
            return 10000;
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

