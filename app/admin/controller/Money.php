<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/9/4
 * Time: 9:36
 */

namespace app\admin\controller;


use app\admin\model\Cash;
use app\admin\model\Detail;
use app\admin\model\Members;
use app\admin\model\Recharge;
use think\Db;
use think\Request;
use think\Cache;

class Money extends Admin
{
    /**
     * 充值记录
     */
    public function recharge(Request $request){

        $from   = $request->param('from');
        $to     = $request->param('to');
        $status  = $request->param('status');
        $mobile = $request->param('mobile');
        $w='';
        if($from && $to){
            $from = strtotime($from);
            $to = strtotime($to);
            $w['create_at'] = [['>=',$from],['<=',$to]];
        }
        if($status){
            $w['status']=$status;
        }
        if($mobile){
            $uid = Members::where(array('mobile'=>$mobile))->value('id');
            $w['uid'] = $uid;
        }
        $gm_name = $request->param('gm_name');
        if($gm_name){
            $uid = Members::where(array('gm_name'=>$gm_name))->value('id');
            $w['uid']=$uid;
        }
        $list = Recharge::where($w)->order('id desc')->paginate(20,false,['query'=>request()->param()]);
        $renshu      = Recharge::where($w)->count();
        $totle_money = Recharge::where($w)->sum('money');
       // echo $totle_money;
        $ccRemind = Cache::get('ccRemind');
        $ccRemind['charge'] = 0;
        Cache::set('ccRemind',$ccRemind);
        return view('',[
            'list'=>$list,
            'page'=>$list->render(),
            'renshu'=>$renshu,
            'total_money'=>$totle_money,
        ]);
    }
    /**
     *  后台充值
     */
    public function addmoney(Request $request){

        $gm_name   = $request->post('gm_name');
        $money    = $request->post('money');
        $remark   = $request->post('remark');
        $Members = new Members();
        $uid = $Members->get_username_id($gm_name);
        if(!$uid){
            $this->error_new('用户不存在');
        }
        Db::startTrans();
        try {
            $up_data["money"] = array("exp", "money+" . $money);
            $result0 = Db::name('member')->where(array('id'=>$uid))->update($up_data);
            $Recharge = new Recharge();
            $data['uid'] = $uid;
            $data['remark'] = $remark;
            $data['money'] = $money;
            $data['status'] = 2;
            $data['type'] = 3;
            $data['create_at'] = time();
            $result1 = $Recharge->addData($data);
            $this->add_charge_detail($uid,$money,1);
            $content = "恭喜您，本次后台成功充值".$money."元";
            add_member_msg($uid,$content);
        }catch (\Exception $e){
            Db::rollback();
            $this->error_new('添加失败');
        }
        if ($result0 && $result1 ) {
            Db::commit();
            $this->success_new('添加成功',url('admin/money/recharge'));
        }else{
            $this->error_new('添加失败');
        }



    }

    /**
     *  后台提现
     */
    public function adminWithdrawals(Request $request){

        $gm_name   = $request->post('gm_name');
        $money    = $request->post('money');
        $remark   = $request->post('remark');
        $Members = new Members();
        $uid = $Members->get_username_id($gm_name);
        if(!$uid){
            $this->error_new('用户不存在');
        }
        $user = Members::get($uid);
        $my_money = $user['money'];
        if($my_money<$money){
            $this->error_new('余额不足');
        }
        $new_money = bcsub(round($my_money,2), round($money,2));
        $result0 = Db::name('member')
            ->where(array('id'=>$uid))
            ->update(array('money'=>$new_money));
        if($result0) {
            $data['uid'] = $uid;
            $data['money'] = $money;
            $data['status'] = 2;
            $data['remark'] = $remark;
            $data['create_at'] = time();
            $result = Db::name('withdrawals')->insert($data);

            $explain = '提现扣款';
            $save['uid']     = $uid;
            $save['type']    = 2;
            $save['money']   = $money;
            $save['balance'] = $new_money;
            $save['exp']     = 9;
            $save['explain'] =  $explain;
            $save['create_at'] = time();
            $result = Db::name('detail')->insert($save);
            $this->success_new('提现成功');
        }else{
            $this->error_new('操作失败，请稍后再试');
        }


    }
    /**
     * 修改充值状态
     */
    public function edit_status(Request $request){
        $type   = $request->post('type');
        $uid    = $request->post('uid');
        $id     = $request->post('id');

        Db::startTrans();
        try{
            if($type==1) {
                $result_up = Db::name('recharge')->where(array('id' =>$id,'status'=>1))->update(array('status' => 2,'update_at'=>time()));
                $money     = Db::name('recharge')->where(array('id' =>$id))->value('money');
                $up_data["money"] = array("exp", "money+" . $money);
                $result = Db::name('member')->where(array('id'=>$uid))->update($up_data);
                $this->add_charge_detail($uid,$money,2);
                $content = "恭喜您，本次线下成功充值".$money."元";
                add_member_msg($uid,$content);
            }
            if($type==2) {
                $result_up = Db::name('recharge')->where(array('id' =>$id,'status'=>1))->update(array('status' => 3,'update_at'=>time()));
            }
        }catch (\Exception $e){
            Db::rollback();
            json_return(500,'失败');
        }
        if($result_up){
            Db::commit();
            json_return(200,'成功');
        }else{
            Db::rollback();
            json_return(500,'失败');
        }
    }
    /**
     * 提现
     */
    public function cash(Request $request){
        $mobile    = $request->param('mobile');
        $status    = $request->param('status');
        $from      = $request->param('from');
        $to        = $request->param('to');
        $uid='';
        if($mobile){
            $Members = new Members();
            $uid = $Members->get_mobile_id($mobile);
            if(!$uid){
                $this->error_new('用户不存在');
            }
        }
        $w=[];
        if($from && $to){
            $from = strtotime($from);
            $to   = strtotime($to);
            $w['create_at'] = [['>=',$from],['<=',$to]];
        }
        if($status){
            $w['status']=$status;
        }
        if($uid){
            $w['uid']=$uid;
        }
        $gm_name = $request->param('gm_name');
        if($gm_name){
            $uid = Members::where(array('gm_name'=>$gm_name))->value('id');
            $w['uid']=$uid;
        }
        $list        = Cash::where($w)->order('id desc')->paginate(20,false,['query'=>request()->param()]);
        $renshu      = Cash::where($w)->count();
        $totle_money = Cash::where($w)->sum('money');
        $ccRemind = Cache::get('ccRemind');
        $ccRemind['cash'] = 0;
        Cache::set('ccRemind',$ccRemind);
        return view('',[
            'list'=>$list,
            'page'=>$list->render(),
            'renshu'=>$renshu,
            'total_money'=>$totle_money,
        ]);
    }
    /**
     * 修改提现记录
     */
    public function edit_withdrawal_status(Request $request){
        $type   = $request->post('type');
        $uid    = $request->post('uid');
        $id     = $request->post('id');
        Db::startTrans();
        try{
            if($type==1) {
                $result_up = Db::name('withdrawals')->where(array('id' =>$id))->update(array('status' => 2,'update_at'=>time()));
                $content = "恭喜您，提现审核成功！";
                add_member_msg($uid,$content);
            }
            if($type==2) {
                $result_up = Db::name('withdrawals')->where(array('id' =>$id))->update(array('status' => 3,'update_at'=>time()));
                $money     = Db::name('withdrawals')->where(array('id' =>$id))->value('money');
                $up_data["money"] = array("exp", "money+" . $money);
                $result = Db::name('member')->where(array('id'=>$uid))->update($up_data);
            }
        }catch (\Exception $e){
            Db::rollback();
            json_return(500,'失败');
        }
        if($result_up){
            Db::commit();
            json_return(200,'成功');
        }else{
            Db::rollback();
            json_return(500,'失败');
        }

    }
    /**
     *投注记录
     */
    public function betting(Request $request){
        $from    = $request->param('from');
        $to      = $request->param('to');
        $id      = $request->param('id');
        $cate    = $request->param('cate');
        $code    = $request->param('code');
        $w =[];
        if($from && $to){
            $from = strtotime($from);
            $to   = strtotime($to);
            $w['s.create_at'] = [['>=',$from],['<=',$to]];
        }
        if($cate){
            $w['s.cate'] = $cate;
        }
        if($id){
            $w['s.uid']  = $id;
        }
        if($code!=null && $code>=0){
            $w['s.code']  = $code;
        }
        $gm_name = $request->param('gm_name');
        if($gm_name){
            $w['m.gm_name']=$gm_name;
        };
        $w['m.is_temporary'] = 0;
        $list = Db::name('single')
            ->alias('s')
            ->field('s.*,c.name,b.title,m.mobile,m.gm_name')
            ->join('dl_cate c','c.id=s.cate')
            ->join('dl_bet b','s.type=b.type and s.cate=b.cate')
            ->join('dl_member m','s.uid=m.id')
            ->where($w)
            ->order('s.id desc')
            ->paginate(20,false,['query'=>request()->param()]);
        unset($w['m.gm_name']);
        unset($w['m.is_temporary']);
        $total_number =  Db::name('single')
            ->alias('s')
            ->where($w)
            ->count();
        $total_money =  Db::name('single')
            ->alias('s')
            ->where($w)
            ->sum('money');
        $w['code'] = 1;
        $zj_money =  Db::name('single')
            ->alias('s')
            ->where($w)
            ->sum('z_money');
        $cates = Db::name('cate')->select();
        return view('',[
            'cates'=>$cates,
            'list' =>$list,
            'page' =>$list->render(),
            'id'   =>$id,
            'cate' =>$cate,
            'total_number'=>$total_number,
            'total_money' =>$total_money,
            'zj_money' =>$zj_money
        ]);
    }
    /**
     * 回水流水
     */
    public function back_water(Request $request){
        $from    = $request->param('from');
        $to      = $request->param('to');
        $id      = $request->param('uid');
        $mobile  = $request->param('mobile');
        $exp     = $request->param('exp');
        $w =[];
        if($exp) {
            $w['exp'] = $exp;
        }else{
            $w['exp'] = array('in','3,4,6');
        }
        if($from && $to){
            $from = strtotime($from);
            $to   = strtotime($to);
            $w['s.create_at'] = [['>=',$from],['<=',$to]];
        }
        if($id){
            $w['s.uid']  = $id;
        }
        if($mobile){
            $Members = new Members();
            $uid = $Members->get_mobile_id($mobile);
            if(!$uid){
                $this->error_new('用户不存在');
            }else{
                $w['s.uid']  = $uid;
            }
        }
        $list = Detail::where($w)->order('id desc')->paginate(20,false,['query'=>request()->param()]);

        $total_money = Detail::where($w)->sum('money');
        return view('',[
            'list' =>$list,
            'page' =>$list->render(),
            'total_money'=>$total_money,
        ]);
    }
    /**
     * 金额记录
     */
    public function transaction(Request $request){
        $from    = $request->param('from');
        $to      = $request->param('to');
        $id      = $request->param('id');
        $cate    = $request->param('exp');
        $mobile  = $request->param('mobile');
        $junior_ids  = urldecode($request->param('junior_ids'));
        $w =[];
        if($from && $to){
            $from = strtotime($from);
            $to   = strtotime($to);
            $w['create_at'] = [['>=',$from],['<=',$to]];
        }
        if($cate){
            $w['exp'] = $cate;
        }
        if($id){
            $w['uid']  = $id;
        }
        if($mobile){
            $Members = new Members();
            $uid = $Members->get_mobile_id($mobile);
            if(!$uid){
                $this->error_new('用户不存在');
            }else{
                $w['uid']  = $uid;
            }
        }
        if($junior_ids){
            $w['uid'] = array('in',$junior_ids);
        }
        $gm_name = $request->param('gm_name');
        if($gm_name){
            $uid = Members::where(array('gm_name'=>$gm_name))->value('id');
            $w['uid']=$uid;
        }
        else{
            $uid = Members::where(array('is_temporary'=>0))->column('id');
            $w['uid']=['in',$uid];
        }
        $w['status']  = 2;
        $list = Detail::where($w)->order('id desc')->paginate(20,false,['query'=>request()->param()]);
        $data = $list->all();
        foreach ( $data as $k=>$v){
            if($v['proxy_uid']) {
                $t_name = Db::name('member')->where(array('id' => $v['proxy_uid']))->value('nickname');
            }else{
                $t_name = '无';
            }

            $v['t_name'] = $t_name;
            $list[$k] = $v;
        }
        $detail_exp = Db::name('detail_exp')->select();
        return view('',[
            'detail_exp'=>$detail_exp,
            'list' =>$list,
            'id'   =>$id,
            'page' =>$list->render(),
        ]);

    }
    /**
     * 修改流水状态
     */
    public function edit_water_status(Request $request){
        $type   = $request->post('type');
        $uid    = $request->post('uid');
        $id     = $request->post('id');

        Db::startTrans();
        try{
            if($type==1) {
                $result_up = Db::name('detail')->where(array('id' =>$id))->update(array('status' => 2));
                $money     = Db::name('detail')->where(array('id' =>$id))->value('money');
                $up_data["money"] = array("exp", "money+" . $money);
                $result = Db::name('member')->where(array('id'=>$uid))->update($up_data);
            }
            if($type==2) {
                $result_up = Db::name('detail')->where(array('id' =>$id))->update(array('status' => 3));
            }
        }catch (\Exception $e){
            Db::rollback();
            json_return(500,'失败');
        }
        if($result_up){
            Db::commit();
            json_return(200,'成功');
        }else{
            Db::rollback();
            json_return(500,'失败');
        }
    }
    /**
     * 查看充值回执
     */
    public function hui(Request $request){
        $id     = $request->param('id');
        $data   = Db::name('recharge')->where(array('id'=>$id))->find();
        return view('',[
            'data' =>$data,
        ]);

    }
    /**
     * 盈亏
     */
    public function win_lose(Request $request){
        $from    = $request->param('from');
        $to      = $request->param('to');
        $id      = $request->param('uid');
        $mobile  = $request->param('mobile');
        $w =[];
        $uid = "";
        if($from && $to){
            $from = strtotime($from);
            $to   = strtotime($to);
            $w['create_at'] = [['>=',$from],['<=',$to]];
        }
        if($id){
            $w['uid']  = $id;
            $uid  = $id;
        }else{
            $uid_arr = Db::name('member')->where('is_temporary',0)->column('id');
            $w['uid'] = ['in',$uid_arr]; 
        }
        if($mobile){
            $Members = new Members();
            $uid = $Members->get_mobile_id($mobile);
            if(!$uid){
                $this->error_new('用户不存在');
            }else{
                $w['uid']  = $uid;
            }
        }
        $gm_name = $request->param('gm_name');
        if($gm_name){
            $uid = Members::where(array('gm_name'=>$gm_name))->value('id');
            $w['uid']=$uid;
        }
        //总返利
        $fan_total = Detail::where($w)
            ->where(array('exp'=>6))
            ->sum('money');
        //总投注
        $betting_total = Detail::where($w)
            ->where(array('exp'=>5))
            ->sum('money');
        //总中奖
        $winning_total = Detail::where($w)
            ->where(array('exp'=>2))
            ->sum('money');

        //总充值
        $recharge_total = Recharge::where($w)
            ->where(array('status'=>2))
            ->sum('money');

        //总提现
        $withdrawals_total = Db::name('withdrawals')->where($w)
            ->where(array('status'=>2))
            ->sum('money');
        //总盈亏    
        $profit = $winning_total + $fan_total - $betting_total;

        $profit            = number_format($profit,2);
        $betting_total     = number_format($betting_total,2);
        $winning_total     = number_format($winning_total,2);

        $recharge_total    = number_format($recharge_total,2);
        $withdrawals_total = number_format($withdrawals_total,2);

        if($profit>0){
            $now_profit = "+".$profit;
        }elseif ($profit<0){
            $now_profit = $profit;
        }else{
            $now_profit=0.00;
            $now_profit            = number_format($now_profit,2);
        }
        return view('',[
            'profit'=> $now_profit,
            'fan_total'=>$fan_total,
            'betting_total' =>$betting_total,
            'winning_total'=>$winning_total,
            'recharge_total'=>$recharge_total,
            'withdrawals_total'=> $withdrawals_total,
        ]);
    }
    //盈亏报表
    public function win_lose_table(Request $request){
        $from       = $request->param('from');
        $to         = $request->param('to');
        $gm_name   = $request->param('gm_name');
        $w =[];
        $w1=[];
        $uid = "";
        if($from && $to){
            $from = strtotime($from);
            $to   = strtotime($to);
            $w['create_at'] = [['>=',$from],['<=',$to]];
            $w1['d.create_at'] = [['>=',$from],['<=',$to]];
        }
        if($gm_name){
            $Members = new Members();
            $uid = $Members->get_username_id($gm_name);
            if(!$uid){
                $this->error_new('用户不存在');
            }else{
                $w['uid']  = $uid;
                $w1['d.uid'] = $uid;
            }
        }
        $w1['m.is_temporary']=0;
        $type = Db::name('detail_exp')->column('id');
        $data = Db::name('member')
            ->alias('m')
            ->where($w1)
            ->field('m.id as uid,m.money as over,m.junior_ids,d.type,d.exp,sum(d.money) as all_money')
            ->join('dl_detail d','m.id = d.uid','LEFT')
            ->group('m.id,d.exp')
            ->paginate(20,false,['query'=>request()->param()]);
        foreach ($data as $key => $value) {
            $data1[$value['uid']]['over']=$value['over'];
            $data1[$value['uid']]['junior_ids']=$value['junior_ids'];
            $data1[$value['uid']]['exp'][]=$value['exp'];
            $data1[$value['uid']]['gm_name']=Db::name('member')->where(array('id'=>$value['uid']))->value('gm_name');
            $data1[$value['uid']]['money'][$value['exp']]=$value['all_money'];
        }
        $list=[];
        if(!empty($data1)){
            foreach ($data1 as $key => $value) {                      
                for ($i=0; $i <count($type) ; $i++) {
                    $list[$key]['gm_name']=$value['gm_name'];
                    $list[$key]['over']=$value['over'];
                    $list[$key]['junior_ids']=$value['junior_ids'];
                    if(in_array($i+1,$value['exp'])){
                        $list[$key][$i+1]=(+$value['money'][$i+1]);
                    }else{
                        $list[$key][$i+1]=null;
                    }
                }
            }
            foreach ($list as $key => $value) {
                $w['uid']=$key;
                //总充值
                $list[$key]['recharge'] = Recharge::where($w)
                    ->where(array('status'=>2))
                    ->sum('money');

                //总提现
                $list[$key]['withdrawals'] = Db::name('withdrawals')->where($w)
                    ->where(array('status'=>2))
                    ->sum('money');
                //盈亏
                $list[$key]['profit']=$value['6']+$value['2']-$value['5'];
            }
        }
        //总返利
        $fan_total = Detail::where($w)
            ->where(array('exp'=>6))
            ->sum('money');
        //总投注
        $betting_total = Detail::where($w)
            ->where(array('exp'=>5))
            ->sum('money');
        //总中奖
        $winning_total = Detail::where($w)
            ->where(array('exp'=>2))
            ->sum('money');

        //总充值
        $recharge_total = Recharge::where($w)
            ->where(array('status'=>2))
            ->sum('money');

        //总提现
        $withdrawals_total = Db::name('withdrawals')->where($w)
            ->where(array('status'=>2))
            ->sum('money');
        //所有会员余额
        $all_money = Db::name('member')->where('is_temporary',0)->sum('money');
        $profit = $winning_total + $fan_total - $betting_total;
        $totle['gm_name']   = '总计：';
        $totle[6]           = number_format($fan_total,2);
        $totle[5]           = number_format($betting_total,2);
        $totle[2]           = number_format($winning_total,2);
        $totle[1]           = number_format($recharge_total,2);
        $totle[4]           = number_format($withdrawals_total,2);
        $totle['profit']    = number_format($profit,2);
        return view('',['list'=>$list,'all_money'=>$all_money,'page'=>$data->render(),'empty'=>'<tr><td colSpan="99" style="text-align:center;">没有数据</td></tr>']);
    }
    /**
     * 下级盈亏
     */
    public function child_table(Request $request){
        $uid = $request->param('uid');
        $uid = explode(',', $uid);
        array_filter($uid);
        $w['d.uid'] =array('in',$uid);
        $w['m.is_temporary']=0;
        $w1['uid']=array('in',$uid);
        $type = Db::name('detail_exp')->column('id');
        $data = Db::name('member')
            ->alias('m')
            ->where($w)
            ->field('m.id as uid,m.money as over,m.junior_ids,d.type,d.exp,sum(d.money) as all_money')
            ->join('dl_detail d','m.id = d.uid','LEFT')
            ->group('m.id,d.exp')
            ->select();
        if(empty($data)){
            return json(array('list'=>0));exit;
        }
        $list=[];
        foreach ($data as $key => $value) {
            $data1[$value['uid']]['over']=$value['over'];
            $data1[$value['uid']]['exp'][]=$value['exp'];
            $data1[$value['uid']]['gm_name']=Db::name('member')->where(array('id'=>$value['uid']))->value('gm_name');
            $data1[$value['uid']]['money'][$value['exp']]=$value['all_money'];
        }
        if(!empty($data1)){
            foreach ($data1 as $key => $value) {                      
                for ($i=0; $i <count($type) ; $i++) {
                    $list[$key]['over']=$value['over'];
                    $list[$key]['gm_name']=$value['gm_name'];
                    if(in_array($i+1,$value['exp'])){
                        $list[$key][$i+1]=(+$value['money'][$i+1]);
                    }else{
                        $list[$key][$i+1]=0;
                    }
                }
            }
            foreach ($list as $key => $value) {
                $w2['uid']=$key;
                $recharge_all = Recharge::where($w2)
                    ->where(array('status'=>2))
                    ->sum('money');
                $list[$key]['recharge']=($recharge_all?$recharge_all:0);
                //总提现
                $withdrawals_all= Db::name('withdrawals')->where($w2)
                    ->where(array('status'=>2))
                    ->sum('money');
                $list[$key]['withdrawals'] =($withdrawals_all?$withdrawals_all:0);
                $list[$key]['profit']=$value['6']+$value['2']-$value['5'];
            }
        }
        //总返利
        $fan_total = Detail::where($w1)
            ->where(array('exp'=>6))
            ->sum('money');
        //总投注
        $betting_total = Detail::where($w1)
            ->where(array('exp'=>5))
            ->sum('money');
        //总中奖
        $winning_total = Detail::where($w1)
            ->where(array('exp'=>2))
            ->sum('money');

        //总充值
        $recharge_total = Recharge::where($w1)
            ->where(array('status'=>2))
            ->sum('money');

        //总提现
        $withdrawals_total = Db::name('withdrawals')->where($w1)
            ->where(array('status'=>2))
            ->sum('money');

        $profit = $winning_total + $fan_total - $betting_total;
        $totle['gm_name']   = '总计：';
        $totle[6]           = number_format($fan_total,2);
        $totle[5]           = number_format($betting_total,2);
        $totle[2]           = number_format($winning_total,2);
        $totle[1]           = number_format($recharge_total,2);
        $totle[4]           = number_format($withdrawals_total,2);
        $totle['profit']    = number_format($profit,2);
        return json(array('list'=>$list,'totle'=>$totle));
    }
    /**
     * 订单详情
     */
    public function detail(Request $request){
        $data = $request->post('id');
        $whereData['s.id'] = $data;
        $re = Db::name('single')
            ->alias('s')
            ->where($whereData)
            ->join('dl_cate c','c.id=s.cate')
            ->join('dl_bet b','s.type=b.type and s.cate=b.cate')
            ->join('dl_member m','s.uid=m.id')
            ->field('s.id,s.stage,s.cate,s.type,s.uid,s.number,s.open_number,s.money,s.z_money,s.state,s.code,s.multiple,s.notes,s.create_at,s.wei,s.is_del,s.denomination,s.end_bet_time,c.name,b.title,m.gm_name,m.bonus')
            //->cache(true,10)
            ->find();
        $re['create_at'] = date('Y-m-d H:i:s',$re['create_at']);
        $denomination = strlen($re['denomination']);
        switch ($denomination){
            case 1:
                $re['denomination'] = '2元';
                break;
            case 3:
                $re['denomination'] = '2角';
                break;
            case 4:
                $re['denomination'] = '2分';
                break;
            case 5:
                $re['denomination'] = '2厘';
                break;
        }
        $wei = array('万','千','百','十','个');
        $aArr = array();

        if($re['wei']=='0'){
            $numArr = explode(',',$re['number']);
            if(count($numArr)==5){
                foreach ($numArr as $nak=>$nav){
                    if(!empty($nav)){
                        array_push($aArr,$wei[$nak]);
                    }
                }
                $re['wei'] = implode(',',$aArr);
            }else{
                $re['wei'] = '-----';
            }
        }else{
            $reWeiArr = explode(',',$re['wei']);
            foreach ($reWeiArr as $rwak=>$rwav){
                if($rwav == 1){
                    array_push($aArr,$wei[$rwak]);
                }
            }
            $re['wei'] = implode(',',$aArr);
        }

        $whereDa['cate'] =  $re['cate'];
        $whereDa['type'] =  $re['type'];
        $pl =  Db::name('odds')->where($whereDa)->field('rate,group_rate,bonus')->cache(true,300)->select();
        $userPl['bonus'] = $re['bonus'];
        foreach ($pl as $pk=>$pv){
            $bonus[] = getBonus($pv,$userPl,1,$re['cate']);
        }
        $time = time();
        if($re['is_del'] == 0) {
            if ($re['state'] == 1) {
                if ($re['code'] == 1) {
                    $re['stateCn'] = '已中奖';
                } else {
                    $re['stateCn'] = '未中奖';
                }
            } else {
                $re['stateCn'] = '开奖中';
            }
            if ($re['end_bet_time'] < $time) {
                $re['is_ce'] = 0;
            } else {
                $re['is_ce'] = 1;
            }
        }else{
            $re['is_ce'] = 0;
            $re['stateCn'] = '已撤单';
        }

        $re['bonus'] = implode('/',$bonus);
        if($re){
            //$re['cate']
            $returnData['code'] = 1;
            $returnData['data'] = $re;
        }else{
            $returnData['code'] = 0;
            $returnData['msg'] = '服务器繁忙,请稍后再试';
        }
        return json($returnData);
    }


}