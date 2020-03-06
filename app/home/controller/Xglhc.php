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

class Xglhc extends Home
{
    public function index(){
        $hall = input('hall');
        $cate = input('cate');
        switch ($hall){
            case 1:
                $field = 'id,cate,rule,win_rule,rate,rate_two,bonus,bet_max,stage_bet_max,type,sort';
                break;
            case 2:
                $field = 'id,cate,rule,win_rule,rate_two as rate,bonus,bet_max,stage_bet_max,type,sort';
                break;
            case 3:
                $field = 'id,cate,rule,win_rule,rate_three as rate,bonus,bet_max,stage_bet_max,type,sort';
                break;
        }
        $number = getNumberCache('xglhc');
        $openStage = key($number); //获取最新一期的key（即期数）
        //获取用户信息
        $memDetail = Db::name('member')->where('id',$this->uid)->field('gm_name,money,unpaid_money,ag_money,bb_money,rebate,bonus')->find();
        //获取公共赔率
        $oddsList = Db::name('odds')->field($field)->where('cate',$cate)->cache(10)->select();
        //获取历史开奖数据
        $whereTime['end_time'][] = array('gt', strtotime(date('Y-m-d 00:00:00')));
        $whereTime['end_time'][] = array('lt', strtotime(date('Y-m-d 23:59:59')));
        $openList = Db::name('xglhc_stage')->where($whereTime)->order('id DESC')->select();
        $notice = Db::name('notice')->order('id desc')->limit(5)->select();
        //计算下期的数字
        $whereData['end_time'] = array('gt',time());
        $stage = Db::name('xglhc_stage')->where($whereData)->find();
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
        switch ($typePage){
            case 'two':
                $rule_data['tmlm'] = Db::name('odds')->field($field)->where('cate',8)->where('type',1)->where('status',1)->where('sort','>',49)->limit(16)->order('sort')->cache(60)->select();
                $rule_data['tmlm'] = oneToTwo($rule_data['tmlm'],4);
                $rule_data['zmzh'] = Db::name('odds')->field($field)->where('cate',8)->where('type',2)->where('status',1)->where('sort','>',49)->order('sort')->cache(60)->select();
                $rule_data['zmzh'] = oneToTwo($rule_data['zmzh'],4);
                $type_arr = Db::name('bet')->where('cate',$cate)->where('type','<=','8')->where('type','>=',3)->column('type');
                $type_title_arr = Db::name('bet')->where('cate',$cate)->where('type','<=','8')->where('type','>=',3)->column('title');
                foreach ($type_arr as $k => $v){
                    $rule_data['qiu'][$k]['info'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type',$v)->where('sort','>',49)->limit(8)->where('status',1)->order('sort')->cache(60)->select();
                    $rule_data['qiu'][$k]['type']=$v;
                    $rule_data['qiu'][$k]['type_name'] = $type_title_arr[$k];
                }
                $template = 'two';
                break;
            case 'three':
                $rule_data=[];
                $rule_data['tx'] = Db::name('odds')->field($field)->where('cate',8)->where('type',1)->where('sort','>',67)->limit(12)->where('status',1)->order('sort')->cache(60)->select();
                foreach ($rule_data['tx'] as $k=>&$v){
                    $v['win_rule']=explode(',',$v['win_rule']);
                }
                $rule_data['tx'] = oneToTwo($rule_data['tx'],2);
                $rule_data['tmbs'] = Db::name('odds')->field($field)->where('cate',8)->where('type',1)->where('sort','>',64)->limit(3)->where('status',1)->order('sort')->cache(60)->select();
                $template = 'three';
                break;
            case 'four':
                $rule_data=[];
                $template = 'four';
                break;
            case 'five':
                $rule_data['hxz'] = Db::name('odds')->field($field)->where('cate',8)->where('type',26)->where('status',1)->order('sort')->cache(60)->select();
                foreach ($rule_data['hxz'] as $k=>&$v){
                    $v['win_rule']=explode(',',$v['win_rule']);
                }
                $rule_data['hxz'] = oneToTwo($rule_data['hxz'],2);
                $template = 'five';
                break;
            case 'six':
                $rule_data=[];
                $template = 'six';
                break;
            case 'seven':
                $rule_data['zmsz'] = Db::name('odds')->field($field)->where('cate',8)->where('type',2)->where('status',1)->where('sort','<=',49)->order('sort')->cache(60)->select();
                $rule_data['zmsz'] = oneToTwo($rule_data['zmsz'],5);
                $rule_data['zmzh'] = Db::name('odds')->field($field)->where('cate',8)->where('type',2)->where('status',1)->where('sort','>',49)->order('sort')->cache(60)->select();
                $rule_data['zmzh'] = oneToTwo($rule_data['zmzh'],4);
                $template = 'seven';
                break;
            case 'eight':
                $type_arr = Db::name('bet')->where('cate',$cate)->where('type','<=','8')->where('type','>=',3)->column('type');
                $rule_data['type'] = Db::name('bet')->where('cate',$cate)->where('type','<=',8)->where('type','>=',3)->select();
                foreach ($type_arr as $k => $v){
                    $rule_data['zmsz'][$k]['info'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type',$v)->where('sort','<=',49)->where('status',1)->order('sort')->cache(60)->select();
                    $rule_data['zmsz'][$k]['info'] = oneToTwo($rule_data['zmsz'][$k]['info'],5);
                    $rule_data['zmsz'][$k]['type']=$v;
                    $rule_data['zmsz'][$k]['type_name'] = $rule_data['type'][$k]['title'];
                }
                $template = 'eight';
                break;
            case 'nine':
                $type_arr = Db::name('bet')->where('cate',$cate)->where('type','<=','8')->where('type','>=',3)->column('type');
                $type_title_arr = Db::name('bet')->where('cate',$cate)->where('type','<=','8')->where('type','>=',3)->column('title');
                foreach ($type_arr as $k => $v){
                    $rule_data['zmlm'][$k]['info'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type',$v)->where('sort','>',49)->limit(8)->where('status',1)->order('sort')->cache(60)->select();
                    $rule_data['zmlm'][$k]['type'] =$v;
                    $rule_data['zmlm'][$k]['type_name'] = $type_title_arr[$k];
                }
                $template = 'nine';
                break;
            case 'ten':
                $template = 'ten';
                break;
            case 'eleven':
                $rule_data['ptyx'] = Db::name('odds')->field($field)->where('cate',8)->where('type',30)->where('status',1)->order('sort')->cache(60)->select();
                foreach ($rule_data['ptyx'] as $k=>&$v){
                    $v['win_rule']=explode(',',$v['win_rule']);
                }
                $rule_data['ptyx'] = oneToTwo($rule_data['ptyx'],2);
                $rule_data['ptws'] = Db::name('odds')->field($field)->where('cate',8)->where('type',31)->where('status',1)->order('sort')->cache(60)->select();
                foreach ($rule_data['ptws'] as $k=>&$v){
                    $v['win_rule']=explode(',',$v['win_rule']);
                }
                $rule_data['ptws'] = oneToTwo($rule_data['ptws'],5);
                $template = 'eleven';
                break;
            case 'twelve':
                $rule_data['zx'] = Db::name('odds')->field($field)->where('cate',8)->where('type',32)->where('status',1)->order('sort')->cache(60)->select();
                foreach ($rule_data['zx'] as $k=>&$v){
                    $v['win_rule']=explode(',',$v['win_rule']);
                }
                $rule_data['zx'] = oneToTwo($rule_data['zx'],2);
                $template = 'twelve';
                break;
            case 'thirteen':
                $template = 'thirteen';
                break;
            case 'fourteen':
                $rule_data=[];
                $template = 'fourteen';
                break;
            case 'fifteen':
                $rule_data['type'] = Db::name('bet')->where('cate',$cate)->where('type','<=',25)->where('type','>=',18)->select();
                $rule_data['zxbz'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type','<=',25)->where('type','>=',18)->where('status',1)->order('sort')->cache(60)->select();
                $template = 'fifteen';
                break;
            case 'sixteen':
                $type_arr = Db::name('bet')->where('cate',$cate)->where('type','<=',13)->where('type','>=',10)->column('type');
                $rule_data['type'] = Db::name('bet')->where('cate',$cate)->where('type','<=',13)->where('type','>=',10)->select();
                foreach ($type_arr as $k => $v){
                    $rule_data['sx'][$k]['info'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type',$v)->where('status',1)->order('sort')->cache(60)->select();
                    foreach ($rule_data['sx'][$k]['info'] as $kk=>&$vv){
                        $vv['win_rule'] = explode(',',$vv['win_rule']);
                    }
                    $rule_data['sx'][$k]['info'] = oneToTwo($rule_data['sx'][$k]['info'],2);
                    $rule_data['sx'][$k]['type'] =$v;
                    $rule_data['sx'][$k]['type_name'] = $rule_data['type'][$k]['title'];
                }
                $template = 'sixteen';
                break;
            case 'seventeen':
                $rule_data['type'] = Db::name('bet')->where('cate',$cate)->where('type','<=',38)->where('type','>=',34)->select();
                $rule_data['lm'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type','<=',38)->where('type','>=',34)->where('status',1)->order('sort')->cache(60)->select();
                $template = 'seventeen';
                break;
            case 'eighteen':
                $rule_data=[];
                $type_arr = Db::name('bet')->where('cate',$cate)->where('type','<=',17)->where('type','>=',14)->column('type');
                $rule_data['type'] = Db::name('bet')->where('cate',$cate)->where('type','<=',17)->where('type','>=',14)->select();
                foreach ($type_arr as $k => $v){
                    $rule_data['lw'][$k]['info'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type',$v)->where('status',1)->order('sort')->cache(60)->select();
                    foreach ($rule_data['lw'][$k]['info'] as $kk=>&$vv){
                        $vv['win_rule'] = explode(',',$vv['win_rule']);
                    }
                    $rule_data['lw'][$k]['info'] = oneToTwo($rule_data['lw'][$k]['info'],2);
                    $rule_data['lw'][$k]['type'] =$v;
                    $rule_data['lw'][$k]['type_name'] = $rule_data['type'][$k]['title'];
                }
                $template = 'eighteen';
                break;
            default:
                $rule_data['tmszo'] = Db::name('odds')->field($field)->where('cate',8)->where('type',1)->where('status',1)->where('sort','<=',49)->order('sort')->cache(60)->select();
                $rule_data['tmsz'] = oneToTwo($rule_data['tmszo'],5);
                $rule_data['tmlmo'] = Db::name('odds')->field($field)->where('cate',8)->where('type',1)->where('status',1)->where('sort','>',49)->limit(16)->order('sort')->cache(60)->select();
                $rule_data['tmlm'] = oneToTwo($rule_data['tmlmo'],4);
                $rule_data['zmzh'] = Db::name('odds')->field($field)->where('cate',8)->where('type',2)->where('status',1)->where('sort','>',49)->order('sort')->cache(60)->select();
                $rule_data['zmsz'] = Db::name('odds')->field($field)->where('cate',8)->where('type',2)->where('status',1)->where('sort','<=',49)->order('sort')->cache(60)->select();
                $type_zm_arr = Db::name('bet')->where('cate',$cate)->where('type','<=',8)->where('type','>=',3)->column('type');
                $type_zm_title_arr = Db::name('bet')->where('cate',$cate)->where('type','<=',8)->where('type','>=',3)->column('title');
                foreach ($type_zm_arr as $k => $v){
                    $rule_data['zmlm'][$k]['info'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type',$v)->where('sort','>',49)->limit(8)->where('status',1)->order('sort')->cache(60)->select();
                    $rule_data['zmlm'][$k]['type'] =$v;
                    $rule_data['zmlm'][$k]['type_name'] = $type_zm_title_arr[$k];
                }
                $rule_data['type_zt'] = Db::name('bet')->where('cate',$cate)->where('type','<=',8)->where('type','>=',3)->select();
                foreach ($type_zm_arr as $k => $v){
                    $rule_data['ztsz'][$k]['info'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type',$v)->where('sort','<=',49)->where('status',1)->order('sort')->cache(60)->select();
                    $rule_data['ztsz'][$k]['type']=$v;
                    $rule_data['ztsz'][$k]['type_name'] = $rule_data['type_zt'][$k]['title'];
                }
                $rule_data['type_lm'] = Db::name('bet')->where('cate',$cate)->where('type','<=',38)->where('type','>=',34)->select();
                $rule_data['lm'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type','<=',38)->where('type','>=',34)->where('status',1)->order('sort')->cache(60)->select();
                $type_lx_arr = Db::name('bet')->where('cate',$cate)->where('type','<=',13)->where('type','>=',10)->column('type');
                $rule_data['type_lx'] = Db::name('bet')->where('cate',$cate)->where('type','<=',13)->where('type','>=',10)->select();
                foreach ($type_lx_arr as $k => $v){
                    $rule_data['lx'][$k]['info'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type',$v)->where('status',1)->order('sort')->cache(60)->select();
                    foreach ($rule_data['lx'][$k]['info'] as $kk=>&$vv){
                        $vv['win_rule'] = explode(',',$vv['win_rule']);
                    }
                    $rule_data['lx'][$k]['type'] =$v;
                    $rule_data['lx'][$k]['type_name'] = $rule_data['type_lx'][$k]['title'];
                }
                $type_lw_arr = Db::name('bet')->where('cate',$cate)->where('type','<=',17)->where('type','>=',14)->column('type');
                $rule_data['type_lw'] = Db::name('bet')->where('cate',$cate)->where('type','<=',17)->where('type','>=',14)->select();
                foreach ($type_lw_arr as $k => $v){
                    $rule_data['lw'][$k]['info'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type',$v)->where('status',1)->order('sort')->cache(60)->select();
                    foreach ($rule_data['lw'][$k]['info'] as $kk=>&$vv){
                        $vv['win_rule'] = explode(',',$vv['win_rule']);
                    }
                    $rule_data['lw'][$k]['type'] =$v;
                    $rule_data['lw'][$k]['type_name'] = $rule_data['type_lw'][$k]['title'];
                }
                $rule_data['type_bz'] = Db::name('bet')->where('cate',$cate)->where('type','<=',25)->where('type','>=',18)->select();
                $rule_data['zxbz'] = Db::name('odds')->field($field)->where('cate',$cate)->where('type','<=',25)->where('type','>=',18)->where('status',1)->order('sort')->cache(60)->select();
                $rule_data['hxz'] = Db::name('odds')->field($field)->where('cate',8)->where('type',26)->where('status',1)->order('sort')->cache(60)->select();
                foreach ($rule_data['hxz'] as $k=>&$v){
                    $v['win_rule']=explode(',',$v['win_rule']);
                }
                $rule_data['tx'] = Db::name('odds')->field($field)->where('cate',8)->where('type',1)->where('sort','>',67)->limit(12)->where('status',1)->order('sort')->cache(60)->select();
                foreach ($rule_data['tx'] as $k=>&$v){
                    $v['win_rule']=explode(',',$v['win_rule']);
                }
                $rule_data['tmbs'] = Db::name('odds')->field($field)->where('cate',8)->where('type',1)->where('sort','>',64)->limit(3)->where('status',1)->order('sort')->cache(60)->select();
                $rule_data['ptyx'] = Db::name('odds')->field($field)->where('cate',8)->where('type',30)->where('status',1)->order('sort')->cache(60)->select();
                foreach ($rule_data['ptyx'] as $k=>&$v){
                    $v['win_rule']=explode(',',$v['win_rule']);
                }
                $rule_data['ptws'] = Db::name('odds')->field($field)->where('cate',8)->where('type',31)->where('status',1)->order('sort')->cache(60)->select();
                foreach ($rule_data['ptws'] as $k=>&$v){
                    $v['win_rule']=explode(',',$v['win_rule']);
                }
                $rule_data['zx'] = Db::name('odds')->field($field)->where('cate',8)->where('type',32)->where('status',1)->order('sort')->cache(60)->select();
                foreach ($rule_data['zx'] as $k=>&$v){
                    $v['win_rule']=explode(',',$v['win_rule']);
                }
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
            'template'=>$template,
            'notice'=>$notice,
        ]);
    }

    //获取倒计时
    public function getStage(){
        $ssc = setXglhcStageTime();
        return json($ssc);
    }
    //投注
    public function betting(Request $request){
        $data = $request->post();
        $returnData['code'] = 0;
        $returnData['msg'] = '系统错误,请稍后再试';
        $time = time();
        $whereData['end_time'] = array('gt',$time);
        $stageData = Db::name('xglhc_stage')->where($whereData)->find();

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
        $typeName = Db::name('bet')->cache(60)->select();
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
                $explain = getCate($idv['cate'],'name').'-'.getHall($idv['cate'],$idv['hall']).'-'.$insertData[$inl]['stage'].'期 '.$typeNameArr[$idv['cate']][$idv['type']].'-'.$idv['number'].'：'.$idv['notes'].'注 '.$idv['multiple'].'倍';
                addDetail($this->uid,2,$idv['money'],$balance,5,$idv['cate'],$explain,$idv['hall'],$returnInsertData[$inl]['id']);
                // 提交事务
                Db::commit();
            } catch (\Exception $e) {
                print_r($e->getMessage());
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