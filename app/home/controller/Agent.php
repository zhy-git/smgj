<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/9/13
 * Time: 16:48
 */

namespace app\home\controller;

use app\admin\model\Members;
use app\home\validate\Member;
use think\Db;
use think\Request;

class Agent extends Home
{
    //用户管理
    public function index(){
        $typePage = input('type');
        switch ($typePage){
            case 'add':
                $memDetail = Db::name('member')->where('id',$this->uid)->field('id,nickname,money,ag_money,bb_money,unpaid_money,is_proxy,rebate,bonus')->find();
                if($memDetail){
                    $whereData2['rebate'] = array('lt',$memDetail['rebate']);
                    $list = Db::name('rebate_list')->where($whereData2)->select();
                    $this->assign('list',$list);
                }
                break;
            case 'link':
                $memDetail = Db::name('member')->where('id',$this->uid)->field('id,nickname,money,ag_money,bb_money,unpaid_money,is_proxy,rebate,bonus')->find();
                if($memDetail){
                    $whereData2['rebate'] = array('lt',$memDetail['rebate']);
                    $list = Db::name('rebate_list')->where($whereData2)->select();
                    $this->assign('list',$list);
                }
                    $addLink = Db::name('add_link')->where('uid',$this->uid)->select();
                    foreach ($addLink as $k=>$v){
                        if($v['is_agent'] == 1){
                            $addLink[$k]['is_agent'] = '总代理';
                        }elseif ($v['is_agent'] == 2){
                            $addLink[$k]['is_agent'] = '一级代理';
                        }elseif ($v['is_agent'] == 3){
                            $addLink[$k]['is_agent'] = '二级代理';
                        }else{
                            $addLink[$k]['is_agent'] = '普通用户';
                        }
                    }
                    $this->assign('addLink',$addLink);
                break;
            case 'report':
                $memDetail = Db::name('member')->where('id',$this->uid)->field('id,nickname,money,ag_money,bb_money,unpaid_money,is_proxy,rebate,bonus')->find();
                if($memDetail){
                    $whereData2['rebate'] = array('lt',$memDetail['rebate']);
                    $list = Db::name('rebate_list')->where($whereData2)->select();
                    $this->assign('list',$list);
                }
                $time['start'] = date('Y-m-d',strtotime('-30 day', time()));
                $time['end'] = date('Y-m-d',time());
                $this->assign('time',$time);
                break;
            case 'betRecord':
                $memDetail = Db::name('member')->where('id',$this->uid)->field('id,nickname,money,ag_money,bb_money,unpaid_money,is_proxy,rebate,bonus')->find();
                $cateList = Db::name('cate')->cache('cate_list',60)->select();
                $this->assign('cateList',$cateList);
                $time['start'] = date('Y-m-d',strtotime('-30 day', time()));
                $time['end'] = date('Y-m-d',time());
                $this->assign('time',$time);
                break;
            case 'accountRecord':
                $memDetail = Db::name('member')->where('id',$this->uid)->field('id,nickname,money,ag_money,bb_money,unpaid_money,is_proxy,rebate,bonus')->find();
                $expList = Db::name('detail_exp')->cache('detail_exp_list',60)->select();
                $this->assign('expList',$expList);
                $time['start'] = date('Y-m-d',strtotime('-30 day', time()));
                $time['end'] = date('Y-m-d',time());
                $this->assign('time',$time);
                break;
            case 'listm':
                $memDetail = Db::name('member')->where('id',$this->uid)->field('id,nickname,money,ag_money,bb_money,unpaid_money,is_proxy,rebate,bonus')->find();
                $expList = Db::name('detail_exp')->cache('detail_exp_list',60)->select();
                $this->assign('expList',$expList);
                $time['start'] = date('Y-m-d',strtotime('-30 day', time()));
                $time['end'] = date('Y-m-d',time());
                $this->assign('time',$time);
                break;
            case 'manageTeam':
                $memDetail = Db::name('member')->where('id',$this->uid)->field('id,nickname,money,ag_money,bb_money,unpaid_money,is_proxy,rebate,bonus')->find();
                $time['start'] = date('Y-m-d',strtotime('-30 day', time()));
                $time['end'] = date('Y-m-d',time());
                $this->assign('time',$time);
                break;
            default:
                $typePage = 'add';
                $memDetail = Db::name('member')->where('id',$this->uid)->field('id,nickname,money,ag_money,bb_money,unpaid_money,is_proxy,rebate,bonus')->find();
                if($memDetail){
                    $whereData2['rebate'] = array('lt',$memDetail['rebate']);
                    $list = Db::name('rebate_list')->where($whereData2)->select();
                    $this->assign('list',$list);
                }
                break;
        }
        $memInfo = session('member_info');
        return view($typePage,[
            'memMoney'=>$memDetail,
            'memInfo'=>$memInfo,
        ]);
    }
    //用户管理操作
    public function groupList(Request $request){
        $memDetail = Db::name('member')->where('id',$this->uid)->field('id,nickname,money,is_proxy,rebate,bonus')->find();
        $arr['gm_name'] = $request->get('username');
        $whereData['proxy_id'] = $this->uid;

        if(!empty($arr['gm_name'])){
            $whereData['gm_name'] = $arr['gm_name'];
        }

        $list = Db('member')->where($whereData)->order('id desc')->paginate(20,false,['query'=>request()->param()]);
        $page = $list->render();
        $list = $list->toArray();
        return view('',[
            'mem'=>$memDetail,
            'page'=>$page,
            'list'=>$list['data'],
        ]);
    }
    //新增用户操作
    public function addDo(Request $request){
        $data = $request->post();
        $checkData['agent_user'] = $data['agent_user'];
        $checkData['username'] = $data['username'];
        $checkData['password'] = $data['password'];
        $checkData['repassword'] = $data['repassword'];
        $checkData['rebate'] = $data['rebate'];
        $validate = validate('Member');
        if(!$validate->scene('add')->check($checkData)){
            $this->error($validate->getError());
        };
        $rebateArr = explode(',',$data['rebate']);
        $insertData['password'] = md5($data['password']);
        $insertData['gm_name'] = $data['username'];
        $insertData['is_proxy'] = $data['agent_user'];
        $insertData['proxy_id'] = $this->uid;
        $insertData['rebate'] = $rebateArr[0];
        $insertData['bonus'] = $rebateArr[1];
        $member = new Members();
        $userInfo = $member->where('id',$this->uid)->field('id,is_proxy,rebate,bonus,proxy_ids,junior_ids')->find();
        if($userInfo['is_proxy']==0 && $data['agent_user'] >= 1){
            $this->error('不能开通代理用户');
        }
        if($userInfo['rebate']<=$insertData['rebate'] || $userInfo['bonus']<=$insertData['bonus']){
            $this->error('账号不符合规范');
        }
        $insertData['proxy_rebate'] = $userInfo['rebate'];
        $insertData['proxy_bonus'] = $userInfo['bonus'];
        if($userInfo['proxy_ids']){
            $insertData['proxy_ids'] = $userInfo['proxy_ids'].','.$userInfo['id'];
        }else{
            $insertData['proxy_ids'] = $userInfo['id'];
        }
        $whereData['gm_name'] = $data['username'];
        $ismem = $member->where($whereData)->value('id');
        if($ismem) {
            $returnData['code'] = 0;
            $returnData['msg'] = '登陆账号已存在';
            return json($returnData);
        }else{
            Db::startTrans();
            try {
                $res = $member->allowField(true)->insertGetId($insertData);
                $updateData['junior_num'] = array('exp','junior_num+1');
                $updateData['junior_ids'] = array('exp','concat(junior_ids,",'.$res.'")');
                $updateWhereData['id'] = array('in',$insertData['proxy_ids']);
                $member->where($updateWhereData)->update($updateData);
                Db::commit();
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                $returnData['code'] = 0;
                $returnData['msg'] = '注册失败,请稍后再试';
                return json($returnData);
            }
            $returnData['code'] = 1;
            $returnData['msg'] = '账号注册成功';
            $returnData['url'] = url('index');
        }
        return json($returnData);
    }
    //推广链接
    public function createLink(Request $request){
        $data = $request->post();
        $checkData['agent_user'] = $data['agent_user'];
        $checkData['rebate'] = $data['rebate'];
        $checkData['remark'] = $data['remark'];
        $validate = validate('Member');
        if(!$validate->scene('add_link')->check($checkData)){
            $this->error($validate->getError());
        };
        $addLink = Db::name('add_link')->where('uid',$this->uid)->field('id')->count();
        if($addLink >5){
            $this->error('只能保存5个推广地址');
        }
        $rebateArr = explode(',',$data['rebate']);
        $insertData['is_agent'] = $data['agent_user'];
        $insertData['uid'] = $this->uid;
        $insertData['rebate'] = $rebateArr[0];
        $insertData['bonus'] = $rebateArr[1];
        $insertData['remark'] = $data['remark'];
        $id = md5($this->uid.date('YmdHis').mt_rand(1,999));
        $insertData['param'] = $id;
        $url = url('Login/reg','param='.$id);
        $insertData['link'] = 'http://'.$_SERVER['HTTP_HOST'].$url;
        vendor('phpqrcode.phpqrcode');
        $qrCode=new \QrCode();
        $level=3;
        $size=5;
        $pathname = "share/";
        if(!is_dir($pathname)) { //若目录不存在则创建之
            mkdir($pathname);
        }
        $ad = $pathname . "qrcode_" . rand(10000,99999) . ".png";
        $errorCorrectionLevel =intval($level) ;//容错级别
        $matrixPointSize = intval($size);//生成图片大小
        $qrCode->png($insertData['link'], $ad, $errorCorrectionLevel, $matrixPointSize, 2);
        $insertData['qrcode'] = $ad;
        $member = new Members();
        $userInfo = Db::name('member')->where('id',$this->uid)->field('id,is_proxy,rebate,bonus,proxy_ids,junior_ids')->find();

        if($userInfo['is_proxy']==0 && $data['agent_user'] >= 1){
            $this->error('不能开通代理用户');
        }
        if($userInfo['rebate']<=$insertData['rebate'] || $userInfo['bonus']<=$insertData['bonus']){
            $this->error('账号不符合规范');
        }
        $res = Db::name('add_link')->insert($insertData);
        if($res){
            $this->success('成功');
        }else{
            $this->error('服务器繁忙，请稍后再试');
        }
    }
    public function delLink(Request $request){
        $data = $request->post();
        $whereData['uid'] = $this->uid;
        $whereData['id'] = $data['id'];
        $res = Db::name('add_link')->where($whereData)->delete();
        if($res){
            $this->success('成功');
        }else{
            $this->error('参数错误');
        }
    }
    public function edit(Request $request){
        $data = $request->post();
        $whereData['id'] = (int)$data['id'];
        $memRebate = Db::name('member')->where($whereData)->field('rebate,proxy_rebate')->find();
        $whereRebate['rebate'][] = array('egt', $memRebate['rebate']);
        $whereRebate['rebate'][] = array('lt', $memRebate['proxy_rebate']);
        $reList = Db::name('rebate_list')->where($whereRebate)->select();
        $returnData['code'] = 1;
        $str = '';
        foreach ($reList as $rlk=>$rlv){
            if($rlv['rebate'] == $memRebate['rebate']){
                $str .= '<option value="'.$rlv['id'].'" selected>返点：'.$rlv['rebate'].'  奖金：'.$rlv['bonus'].'</option>';
            }else{
                $str .= '<option value="'.$rlv['id'].'">返点：'.$rlv['rebate'].'  奖金：'.$rlv['bonus'].'</option>';
            }
        }
        $returnData['id'] = $whereData['id'];
        $returnData['html'] = $str;
        return json($returnData);
    }
    public function editDo(Request $request){
        $data = $request->post();
        $whereData['id'] = (int)$data['fdform'];
        $da = Db::name('rebate_list')->where($whereData)->field('rebate,bonus')->find();
        if($da){
            $updateData['rebate'] = $da['rebate'];
            $updateData['bonus'] = $da['bonus'];
            $whereDa['id'] = (int)$data['fduid'];
            $re = Db::name('member')->where($whereDa)->update($updateData);
            if($re !== false){
                $this->success('修改成功');
            }else{
                $this->error('服务器繁忙，请稍后再试2');
            }
        }else{
            $this->error('服务器繁忙，请稍后再试3');
        }

        $memRebate = Db::name('member')->where($whereData)->field('rebate,proxy_rebate')->find();
        $whereRebate['rebate'][] = array('egt', $memRebate['rebate']);
        $whereRebate['rebate'][] = array('lt', $memRebate['proxy_rebate']);
        $reList = Db::name('rebate_list')->where($whereRebate)->select();
        $returnData['code'] = 1;
        $str = '';
        foreach ($reList as $rlk=>$rlv){
            if($rlv['rebate'] == $memRebate['rebate']){
                $str .= '<option value="'.$rlv['id'].'" selected="selected">返点：'.$rlv['rebate'].'  奖金：'.$rlv['bonus'].'</option>';
            }else{
                $str .= '<option value="'.$rlv['id'].'">返点：'.$rlv['rebate'].'  奖金：'.$rlv['bonus'].'</option>';
            }
        }
        $returnData['html'] = $str;
        return json($returnData);
    }

    //盈亏报表
    public function yingkui(Request $request){
        $data = $request->post();
        $thirtyDaysAgo = strtotime(date('Y-m-d 00:00:00',strtotime('-30 day', time())));
        if(!empty($data['rangeTime'])){
            $rangeTime = explode('~',$data['rangeTime']);
            $start = strtotime($rangeTime[0].' 00:00:00');
            if(isset($rangeTime[1])){
                $end = strtotime($rangeTime[1].' 23:59:59');
            }else{
                $start = strtotime($rangeTime[0].' 00:00:00');
                $end = strtotime($rangeTime[0].' 23:59:59');
            }
            if($start<$thirtyDaysAgo){
                $start = $thirtyDaysAgo;
            }
        }else{
            // $start = strtotime(date('Y-m-d 00:00:00',strtotime('-90 day', time())));
            // $end = time();
            $start = strtotime(date('Y-m-d 00:00:00'));
            $end = time();

        }
        if(!empty($data['username'])){
            $username = $data['username'];
            $checkData[''] = $data['username'];
            $validate = validate('Member');
            if(!$validate->scene('username_rule')->check($checkData)){
                $this->error('暂无数据');
            };
            $userInfo = session('member_info');
            if($data['username'] == $userInfo['name']){
                $mem = Db::name('member')->where('id',$this->uid)->field('id,gm_name,rebate')->select();
            }else{
                $mem = Db::name('member')->where('gm_name',$username)->field('id,gm_name,rebate,proxy_ids')->select();
                if($mem){
                    $proxyIdsArr = explode(',',$mem[0]['proxy_ids']);
                    if(array_search($this->uid,$proxyIdsArr) === false){
                        $this->error('暂无数据');
                    }
                }else{
                    $this->error('暂无数据');
                }
            }
            $whereData['d.uid'] = $mem[0]['id'];
        }else{
            $memJunIds = Db::name('member')->where('id',$this->uid)->field('id,junior_ids')->find();
            $memJunIds['junior_ids']=$this->uid.','.$memJunIds['junior_ids'];
            //$whereMdata['id'] = array('in',$memJunIds['junior_ids']);
            //$mem = Db::name('member')->where($whereMdata)->field('id,gm_name,rebate')->select();
            $whereData['d.uid'] = array('in',$memJunIds['junior_ids']);
        }
        $whereData['d.create_at'][] = array('>=',$start);
        $whereData['d.create_at'][] = array('<=',$end);
        $res = Db::name('detail')
            ->alias('d')
            ->where($whereData)
            ->join('dl_member m', 'd.uid=m.id')
            ->field('d.uid,d.type,d.money,d.exp,m.gm_name,m.rebate')
            ->select();
        $returnData['code'] = 1;
        $returnData['data'] = array();
        if($res){
                foreach ($res as $k => $v) {
                    if(!array_key_exists($v['uid'],$returnData['data'])){
                        $returnData['data'][$v['uid']]['name'] = $v['gm_name'];
                        $returnData['data'][$v['uid']]['rebate'] = $v['rebate'];
                        $returnData['data'][$v['uid']]['charge'] = 0;
                        $returnData['data'][$v['uid']]['win'] = 0;
                        $returnData['data'][$v['uid']]['cedan'] = 0;
                        $returnData['data'][$v['uid']]['cash'] = 0;
                        $returnData['data'][$v['uid']]['bet'] = 0;
                        $returnData['data'][$v['uid']]['back'] = 0;
                        $returnData['data'][$v['uid']]['act'] = 0;
                        $returnData['data'][$v['uid']]['in'] = 0;
                        $returnData['data'][$v['uid']]['out'] = 0;
                        $returnData['data'][$v['uid']]['other'] = 0;
                    }
                    switch ($v['exp']) {	
                        case 1:
                            $returnData['data'][$v['uid']]['charge'] = bcadd($returnData['data'][$v['uid']]['charge'], $v['money'], 3);
                            // $totleData['charge'][]=$returnData['data'][$v['uid']]['charge'];
                            break;
                        case 2:
                            $returnData['data'][$v['uid']]['win'] = bcadd($returnData['data'][$v['uid']]['win'], $v['money'], 3);
                            // $totleData['win'][]=$returnData['data'][$v['uid']]['win'];
                            break;
                        case 3:
                            $returnData['data'][$v['uid']]['cedan'] = bcadd($returnData['data'][$v['uid']]['cedan'], $v['money'], 3);
		// $totleData['cedan'][]=$returnData['data'][$v['uid']]['cedan'];
                            break;
                        case 4:
                            $returnData['data'][$v['uid']]['cash'] = bcadd($returnData['data'][$v['uid']]['cash'], $v['money'], 3);
                            // $totleData['cash'][]=$returnData['data'][$v['uid']]['cash'];
                            break;
                        case 5:
                            $returnData['data'][$v['uid']]['bet'] = bcadd($returnData['data'][$v['uid']]['bet'], $v['money'], 3);
                            // $totleData['bet'][]=$returnData['data'][$v['uid']]['bet'];
                            break;
                        case 6:
                            $returnData['data'][$v['uid']]['back'] = bcadd($returnData['data'][$v['uid']]['back'], $v['money'], 3);
                            // $totleData['back'][]=$returnData['data'][$v['uid']]['back'];
                            break;
                        case 7:
                            $returnData['data'][$v['uid']]['act'] = bcadd($returnData['data'][$v['uid']]['act'], $v['money'], 3);
                            // $totleData['in'][]=$returnData['data'][$v['uid']]['in'];
                            break;
                        case 8:
                            $returnData['data'][$v['uid']]['in'] = bcadd($returnData['data'][$v['uid']]['in'], $v['money'], 3);
                            // $totleData['out'][]=$returnData['data'][$v['uid']]['out'];
                            break;
                        case 9:
                            $returnData['data'][$v['uid']]['out'] = bcadd($returnData['data'][$v['uid']]['out'], $v['money'], 3);
                            // $totleData['back'][]=$returnData['data'][$v['uid']]['back'];
                            break;
                        case 10:
                            $returnData['data'][$v['uid']]['other'] = bcadd($returnData['data'][$v['uid']]['other'], $v['money'], 3);
                            // $totleData['other'][]=$returnData['data'][$v['uid']]['other'];
                            break;
                    }
                }
                // print_r($totleData);die;
                // $totleData['charge'] = array_sum($totleData['charge']);
                // $totleData['win'] = array_sum($totleData['win']);
                // $totleData['cedan'] = array_sum($totleData['cedan']);
                // $totleData['cash'] = array_sum($totleData['cash']);
                // $totleData['bet'] = array_sum($totleData['bet']);
                // $totleData['back'] = array_sum($totleData['back']);
                // $totleData['act'] = array_sum($totleData['act']);
                // $totleData['in'] = array_sum($totleData['in']);
                // $totleData['out'] = array_sum($totleData['out']);
                // $totleData['other'] = array_sum($totleData['other']);
                // array_unshift($returnData['data'],$totleData);
            return json($returnData);
        }else{
            $returnData['code'] = 0;
            return json($returnData);
        }
    }
    //账变记录查询
    public function accRecord(Request $request){
        $data = $request->post();
//        $thirtyDaysAgo = strtotime('-30 day', time());
//        if(!empty($data['rangeTime'])){
//            $rangeTime = explode('~',$data['rangeTime']);
//            $start = strtotime($rangeTime[0]);
//            $end = strtotime($rangeTime[1]);
//            if($start<$thirtyDaysAgo){
//                $start = $thirtyDaysAgo;
//            }
//        }else{
//            $start = $thirtyDaysAgo;
//            $end = time();
//        }
        $thirtyDaysAgo = strtotime(date('Y-m-d 00:00:00',strtotime('-30 day', time())));
        if(!empty($data['rangeTime'])){
            $rangeTime = explode('~',$data['rangeTime']);
            $start = strtotime($rangeTime[0].' 00:00:00');
            if(isset($rangeTime[1])){
                $end = strtotime($rangeTime[1].' 23:59:59');
            }else{
                $start = strtotime($rangeTime[0].' 00:00:00');
                $end = strtotime($rangeTime[0].' 23:59:59');
            }
            if($start<$thirtyDaysAgo){
                $start = $thirtyDaysAgo;
            }
        }else{
            $start = strtotime(date('Y-m-d 00:00:00'));
            $end = time();
        }

        $whereData['d.create_at'][] = array('>=', $start);
        $whereData['d.create_at'][] = array('<=', $end);
        $userData = Db::name('member')->where('id',$this->uid)->field('junior_ids')->find();
        if($data['target'] == 1){
            $whereData['d.uid'] = $this->uid;
        }else{
            if($userData['junior_ids']){
                $whereData['d.uid'] = array('in',$userData['junior_ids']);
            }else{
                $this->error('暂无数据');
            }
        }
        if($data['typeTitle']){
            $whereData['d.exp'] = $data['typeTitle'];
        }
        if(!empty($data['username'])){
            $username = $data['username'];
            $checkData[''] = $data['username'];
            $validate = validate('Member');
            if(!$validate->scene('username_rule')->check($checkData)){
                $this->error('暂无数据');
            };
            $userInfo = session('member_info');
            if($data['username'] != $userInfo['name']){
                $memId = Db::name('member')->where('gm_name',$data['username'])->field('id')->find();
                if($memId){
                    $userDataJuniorIdsArr = explode(',',$userData['junior_ids']);
                    if(array_search($memId['id'],$userDataJuniorIdsArr) === false){
                        $this->error('暂无数据');
                    }else{
                        $whereData['d.uid'] = $memId['id'];
                    }
                }else{
                    $this->error('暂无数据');
                }
            }else{
                $whereData['d.uid'] = $this->uid;
            }
        }
        $re = Db::name('detail')
            ->alias('d')
            ->where($whereData)
            ->join('dl_detail_exp e','e.id=d.exp')
            ->join('dl_member m','m.id=d.uid')
            ->field('e.name,m.gm_name,d.*')
            ->order('d.id desc')
            ->paginate(10,false,['path'=>url('accRecord','',false)."?page=[PAGE]"]);
        $returnData['page'] = $re->render();
        $returnData['data'] = $re->toArray();
        if($returnData['data']['data']){
            foreach ($returnData['data']['data'] as $k=>$v){
                if($v['type'] == 1){
                    $returnData['data']['data'][$k]['pre_balance'] = $v['balance'] - $v['money'];
                }else{
                    $returnData['data']['data'][$k]['pre_balance'] = $v['balance'] + $v['money'];
                }
                $returnData['data']['data'][$k]['create_at'] = date('Y-m-d H:i:s',$v['create_at']);
            }
        }else{
            $this->error('暂无数据');
        }
        $returnData['code'] = 1;
        return json($returnData);
    }
    //投注记录查询
    public function betRecord(Request $request){
        $data = $request->post();
        $thirtyDaysAgo = strtotime('-30 day', time());
        if(!empty($data['rangeTime'])){
            $rangeTime = explode('~',$data['rangeTime']);
            $start = strtotime($rangeTime[0]);
            $end = strtotime($rangeTime[1]);
            if($start<$thirtyDaysAgo){
                $start = $thirtyDaysAgo;
            }
        }else{
            $start = $thirtyDaysAgo;
            $end = time();
        }
        $whereData['s.create_at'][] = array('>=', $start);
        $whereData['s.create_at'][] = array('<=', $end);
        $userData = Db::name('member')->where('id',$this->uid)->field('junior_ids')->find();
//        if($data['target'] == 1){
//            $whereData['s.uid'] = $this->uid;
//        }else{
//            if($userData['junior_ids']){
//                $whereData['s.uid'] = array('in',$userData['junior_ids']);
//            }else{
//                $this->error('暂无数据');
//            }
//        }
        if(!empty($data['username'])){
            $username = $data['username'];
            $checkData[''] = $data['username'];
            $validate = validate('Member');
            if(!$validate->scene('username_rule')->check($checkData)){
                $this->error('暂无数据');
            };
            $userInfo = session('member_info');
            if($data['username'] != $userInfo['name']){
                $memId = Db::name('member')->where('gm_name',$data['username'])->field('id')->find();
                if($memId){
                    $userDataJuniorIdsArr = explode(',',$userData['junior_ids']);
                    if(array_search($memId['id'],$userDataJuniorIdsArr) === false){
                        $this->error('暂无数据');
                    }else{
                        $whereData['s.uid'] = $memId['id'];
                    }
                }else{
                    $this->error('暂无数据');
                }
            }else{
                $whereData['s.uid'] = $this->uid;
            }
        }else{
            $whereData['s.uid'] = $this->uid;
        }
        if(!empty($data['lotteryId'])){
            $whereData['s.cate'] = $data['lotteryId'];
            if($data['issueNum']){
                $whereData['s.stage'] = $data['issueNum'];
            }
        }
        $re = Db::name('single')
            ->where($whereData)
            ->alias('s')
            ->join('dl_cate c','c.id=s.cate')
            ->join('dl_bet b','s.type=b.type and s.cate=b.cate')
            ->join('dl_member m','s.uid=m.id')
            ->field('s.id,s.stage,s.cate,s.type,s.uid,s.number,s.open_number,s.money,s.z_money,s.state,s.code,s.multiple,s.notes,s.create_at,s.wei,s.is_del,s.denomination,s.end_bet_time,s.odds,c.name,b.title,m.gm_name')
            ->order('s.id desc')
            ->paginate(10,false,['path'=>url('betRecord','',false)."?page=[PAGE]"]);
        $returnData['page'] = $re->render();
        $returnData['data'] = $re->toArray();
        if($returnData['data']['data']){
            foreach ($returnData['data']['data'] as $k=>$v){
                if($v['is_del'] == 0) {
                    if ($v['state'] == 1) {
                        if ($v['code'] == 1) {
                            $returnData['data']['data'][$k]['status'] = '已中奖';
                        } else {
                            $returnData['data']['data'][$k]['status'] = '未中奖';
                        }
                    } else {
                        $returnData['data']['data'][$k]['status'] = '开奖中';
                    }

                }else{
                    $returnData['data']['data'][$k]['status'] = '已撤单';
                }
                $returnData['data']['data'][$k]['create_at'] = date('Y-m-d H:i:s',$v['create_at']);
            }
        }else{
            $this->error('暂无数据');
        }
        $returnData['code'] = 1;
        return json($returnData);
    }
    //团队查询
    public function getTeam(Request $request){
        $data = $request->post();
        if($data['username']){
            $validate = validate('Member');
            $checkData['username_rule'] = $data['username'];
            if(!$validate->scene('username_rule')->check($checkData)){
                $this->error('暂无数据');
            };
            $mem = Db::name('member')->where('gm_name',$data['username'])->field('id,gm_name,rebate,bonus,proxy_id,proxy_ids,junior_ids,junior_num,money,is_proxy,is_tmoney')->select();
            if($mem){
                $proxyIdsArr = explode(',',$mem[0]['proxy_ids']);
                if(array_search($this->uid,$proxyIdsArr) === false){
                    $this->error('暂无数据');
                }
                foreach ($mem as $k=>$v){
                    $login_array = cache('login_array');
                    if (isset($login_array['uid_'.$v['id']])){
                        $time = $login_array['uid_'.$v['id']];
                        if ($time > time()){
                            $mem[$k]['onLine'] ='在线';
                        }else{
                            $mem[$k]['onLine'] ='离线';
                        }
                    }else{
                        $mem[$k]['onLine'] = '离线';
                    }
                    if($v['junior_ids']){
                        $whereData2['id'] = array('in',$v['junior_ids']);
                        $mem[$k]['teamMoney'] = Db::name('member')->where($whereData2)->sum('money');
                        foreach (explode(',',$v['junior_ids']) as $k2=>$v2){
                            $countNum = 0;
                            if(isset($login_array['uid_'.$v2]) && $login_array['uid_'.$v2]>time()){
                                $countNum ++;
                            }
                        }
                        $mem[$k]['onlineNum'] = $countNum;
                    }else{
                        $mem[$k]['teamMoney'] = 0;
                        $mem[$k]['onlineNum'] = 0;
                    }
                    $mem[$k]['is_proxy'] = $v['is_proxy']==0?'普通用户' :($v['is_proxy']==1?'总代理':($v['is_proxy']==2?'一级代理':($v['is_proxy']==3?'二级代理':'普通用户')));
                }
                $returnData['code'] = 1;
                $returnData['data'] = $mem;
            }else{
                $this->error('暂无数据');
            }
        }else{
            $mem = Db::name('member')->where('id',$this->uid)->field('id,gm_name,rebate,proxy_id,proxy_ids,junior_ids,junior_num')->find();
            $whereData['id'] = array('in',$mem['junior_ids']);
            $res = Db::name('member')->where($whereData)->field('id,gm_name,rebate,bonus,proxy_id,proxy_ids,junior_ids,junior_num,money,is_proxy,is_tmoney')->select();
            if($res){
                $login_array = cache('login_array');
                foreach ($res as $k=>$v){
                    if (isset($login_array['uid_'.$v['id']])){
                        $time = $login_array['uid_'.$v['id']];
                        if ($time > time()){
                            $res[$k]['onLine'] ='在线';
                        }else{
                            $res[$k]['onLine'] ='离线';
                        }
                    }else{
                        $res[$k]['onLine'] = '离线';
                    }
                    if($v['junior_ids']){
                        $whereData2['id'] = array('in',$v['junior_ids']);
                        $res[$k]['teamMoney'] = Db::name('member')->where($whereData2)->sum('money');
                        foreach (explode(',',$v['junior_ids']) as $k2=>$v2){
                            $countNum = 0;
                            if(isset($login_array['uid_'.$v2]) && $login_array['uid_'.$v2]>time()){
                                $countNum ++;
                            }
                        }
                        $res[$k]['onlineNum'] = $countNum;
                    }else{
                        $res[$k]['teamMoney'] = 0;
                        $res[$k]['onlineNum'] = 0;
                    }
                    $res[$k]['is_proxy'] = $v['is_proxy']==0?'普通用户' :($v['is_proxy']==1?'总代理':($v['is_proxy']==2?'一级代理':($v['is_proxy']==3?'二级代理':'普通用户')));
                    $res[$k]['pid'] =$mem['id']; 
                }
                $returnData['code'] = 1;
                $returnData['data'] = $res;
            }else{
                $this->error('暂无数据');
            }
        }
        return json($returnData);
    }
    public function getNextTeam(Request $request){
        $data = $request->post();
        $validate = validate('Check');
        $checkData['id'] = $data['id'];
        if(!$validate->scene('id')->check($checkData)){
            $this->error($validate->getError());
        };
        $mem = Db::name('member')->where('id',$data['id'])->field('id,gm_name,rebate,proxy_ids,junior_ids,junior_num')->find();
        $whereData['id'] = array('in',$mem['junior_ids']);
        $res = Db::name('member')->where($whereData)->field('id,gm_name,rebate,bonus,proxy_ids,junior_ids,junior_num,money,is_proxy')->select();
        if($res){
            $login_array = cache('login_array');
            foreach ($res as $k=>$v){
                if($v['junior_ids']){
                    $whereData2['id'] = array('in',$v['junior_ids']);
                    $res[$k]['teamMoney'] = Db::name('member')->where($whereData2)->sum('money');
                    foreach (explode(',',$v['junior_ids']) as $k2=>$v2){
                        $countNum = 0;
                        if(isset($login_array['uid_'.$v2]) && $login_array['uid_'.$v2]>time()){
                            $countNum ++;
                        }
                    }
                    $res[$k]['onlineNum'] = $countNum;
                }else{
                    $res[$k]['teamMoney'] = 0;
                    $res[$k]['onlineNum'] = 0;
                }
                $res[$k]['is_proxy'] = $v['is_proxy']==0?'普通用户' :($v['is_proxy']==1?'总代理':($v['is_proxy']==2?'一级代理':($v['is_proxy']==3?'二级代理':'普通用户')));
            }
            $returnData['code'] = 1;
            $returnData['data'] = $res;
        }else{
            $returnData['code'] = 0;
            $returnData['data'] = '暂无数据';
        }
        return json($returnData);
    }
    //团队总览
    public function teamDetail(Request $request){
        $data = $request->post();
        $validate = validate('Check');
        $checkData['id'] = $data['id'];
        if(!$validate->scene('id')->check($checkData)){
            $this->error($validate->getError());
        };
        $mem = Db::name('member')->where('id',$data['id'])->field('id,gm_name,rebate,bonus,proxy_ids,junior_ids,junior_num,money,is_proxy,create_at,update_at')->find();
        if($mem){
            $mem['onlineNum'] = 0;
            if($mem['junior_ids']){
                $login_array = cache('login_array');
                foreach (explode(',',$mem['junior_ids']) as $k2=>$v2){
                    if(isset($login_array['uid_'.$v2]) && $login_array['uid_'.$v2]>time()){
                        $mem['onlineNum'] ++;
                    }
                }
                $whereData2['id'] = array('in',$mem['junior_ids']);
                $mem['teamMoney'] = Db::name('member')->where($whereData2)->sum('money');
            }else{
                $mem['teamMoney'] = 0;
            }
            if($mem['is_proxy'] == 1){
                $mem['is_proxy'] = '总代理';
            }elseif ($mem['is_proxy']==2){
                $mem['is_proxy'] = '一级代理';
            }elseif ($mem['is_proxy']==3){
                $mem['is_proxy'] = '二级代理';
            }else{
                $mem['is_proxy'] = '普通用户';
            }
            $mem['create_at'] = date('Y-m-d H:i:s',$mem['create_at']);
            $mem['update_at'] = date('Y-m-d H:i:s',$mem['update_at']);
            $mem['teamRecharge'] = 0;
            $mem['teamWin'] = 0;
            $mem['teamCash'] = 0;
            $mem['teamBet'] = 0;
            $mem['teamFan'] = 0;
            $mem['teamYk'] = 0;

            $thirtyDaysAgo = strtotime('-30 day', time());
            if(!empty($data['rangeTime'])){
                $rangeTime = explode('~',$data['rangeTime']);
                $start = strtotime($rangeTime[0]);
                $end = strtotime($rangeTime[1]);
                if($start<$thirtyDaysAgo){
                    $start = $thirtyDaysAgo;
                }
            }else{
                $start = $thirtyDaysAgo;
                $end = time();
            }
            $detailWhereData['uid'] = array('in',$mem['junior_ids']);
            $detailWhereData['create_at'][] = array('>=',$start);
            $detailWhereData['create_at'][] = array('<=',$end);
            $detailData = Db::name('detail')->where($detailWhereData)->select();
            foreach ($detailData as $k=>$v){
                switch ($v['exp']){
                    case 1:
                        $mem['teamRecharge'] += $v['money'];
                        break;
                    case 2:
                        $mem['teamWin'] += $v['money'];
                        break;
                    case 4:
                        $mem['teamCash'] += $v['money'];
                        break;
                    case 5:
                        $mem['teamBet'] += $v['money'];
                        break;
                    case 6:
                        $mem['teamFan'] += $v['money'];
                        break;
                }
            }
            $mem['teamYk'] = $mem['teamWin'] - $mem['teamBet'] + $mem['teamFan'];
            $returnData['code'] = 1;
            $returnData['data'] = $mem;
//                $whereData['id'] = array('in',$mem['junior_ids']);
//                Db::name('member')->where($whereData)->field('id,gm_name,rebate,proxy_ids,junior_ids,junior_num')->find();
        }else{
            $returnData['code'] = 1;
            $returnData['data'] = '服务器繁忙，请稍后再试';
        }
        return json($returnData);
    }
    //团队转账
    public function ransferMoney(Request $request){
        $data = $request->post();
        $validate = validate('Check');
        $checkData['money'] = $data['money'];
        $checkData['id'] = $data['id'];
        if(!$validate->scene('ransferMoney')->check($checkData)){
            $this->error($validate->getError());
        };
        $self_money = Db::name('member')->where('id',$this->uid)->value('money');
        if($self_money<$data['money']){
            return json(array('code'=>0,'msg'=>'你的余额不足！'));
        }
        //直接下级成员id
        $ids = Db::name('member')->where('proxy_id',session('member_info')['uid'])->where('m_status','0')->column('id');
        if(!in_array($data['id'], $ids)){

            $this->error('仅允许向直接下级转账');

        }
        // $is_tmoney = Db::name('member')->where('id',$data['id'])->value('is_tmoney');
        // if($is_tmoney == 0){
        //     $this->error('不允许向该下级转账');
        // }
        Db::startTrans();
        try {
            Db::name('member')->where('id',$data['id'])->setInc('money',$data['money']);
            Db::name('member')->where('id',$this->uid)->setDec('money',$data['money']);
            $balance = Db::name('member')->where('id', $data['id'])->field('money,gm_name')->find();
            $balance2 = Db::name('member')->where('id', $this->uid)->field('money,gm_name')->find();
            $explain = $balance2['gm_name'].'向你转入'.$data['money'];
            $explain2 = '向用户'.$balance['gm_name'].'转入'.$data['money'];
            addDetail($data['id'], 1, $data['money'], $balance['money'], 8, 1, $explain,1);
            addDetail($this->uid, 2, $data['money'], $balance2['money'], 9, 1, $explain2,1);
            $returnData['code'] = 1;
            $returnData['msg'] = '操作成功';
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            $returnData['code'] = 0;
            $returnData['msg'] = '服务器繁忙，请稍后再试';
        }
        return json($returnData);
    }
    //wap
    //团队页面
    public function team_page(Request $request){
        $time = $request->param('time');
        $w=[];
        if(empty($time)){
            $w['create_at'] = ['<',time()];
            $w['create_at'] = ['>=',strtotime(date('Y-m-d',time()))];
        }else{
            $w['create_at'] = ['<',strtotime($time)];
            $w['create_at'] = ['>=',(strtotime($time)+86400)];
        }
        $mem = Db::name('member')->where('id',$this->uid)->field('id,gm_name,rebate,proxy_id,proxy_ids,junior_ids,junior_num')->find();
        $whereData['id'] = array('in',$mem['junior_ids']);
        $res = Db::name('member')->where($whereData)->field('id,gm_name,rebate,bonus,proxy_id,proxy_ids,junior_ids,junior_num,money,is_proxy,is_tmoney')->select();
        if($res){
            foreach ($res as $k=>&$v){
                $v['flow'] = Db::name('single')->where('uid',$v['id'])->where($w)->where('is_del',0)->where('state',1)->sum('money');
                $v['z_money'] = Db::name('single')->where('uid',$v['id'])->where($w)->where('is_del',0)->where('state',1)->sum('z_money');
            }
        }
        array_multisort($res,SORT_DESC);
        $flow = array_sum(array_map(function ($val){return $val['flow'];},$res));
        return view('',[
            'data'=>$res,
            'flow'=>$flow,
        ]);
    }
    //分享页面
    public function share(){
        $shareList = Db::name('add_link')->where('uid',$this->uid)->select();
        return view('',[
            'shareList' =>$shareList,
        ]);
    }
}