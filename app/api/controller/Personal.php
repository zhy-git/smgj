<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/10/30
 * Time: 11:08
 */
namespace app\api\controller;


use app\admin\model\Members;
use app\home\controller\Biapi;
use think\Config;
use think\Controller;
use think\Db;
use think\Request;

class Personal extends Base
{

    /**
     * 交易记录
     */
    public function transaction_record(Request $request){
        $uid     = $request ->post('uid');
        $cate    = $request ->post('cate_id');
        $start_p = $request ->post('start');
        $end_p   = $request ->post('end');
        $page    = $request ->post('page')?$request->post('page'):1;

        if(!$uid || !$cate || !$start_p || !$end_p  ){
            json_return(204,'缺少参数');
        }
        $limit = 20;
        $start = ($page-1)*$limit;

        $start_p = strtotime($start_p.' 00:00:00');
        $end_p   = strtotime($end_p.' 23:59:59');

        $condition['dl_single.uid']  = $uid;
        $condition['dl_single.cate'] = $cate;
        $condition['dl_single.create_at'] = array('between',[$start_p,$end_p]);
        $data = Db::name('single')
            ->alias('s')
            ->field('s.id as id,c.name as name,b.title as title,number,code,s.create_at')
            ->join('dl_cate c','s.cate = c.id')
            ->join('dl_bet b','s.type = b.type and s.cate =b.cate')
            ->where($condition)
            ->limit($start,$limit)
            ->order('s.id desc')
            ->select();
        $count=Db::name('single')
            ->where($condition)
            ->count();
        $return_data['data'] = $data;
        $return_data['now_page'] = $page;
        $return_data['per_page'] = $limit;
        $return_data['total_page'] = ceil($count/$limit);

        json_return(200,'成功',$return_data);

    }

    /**
     * 统计记录
     */
    public function statistical_record(Request $request){
        $uid     = $request ->post('uid');
        $cate    = $request ->post('cate_id')?$request ->post('cate_id'):1;
        $start_p = $request ->post('start');
        $end_p   = $request ->post('end');

        if(!$uid || !$cate || !$start_p || !$end_p  ){
            json_return(204,'缺少参数');
        }

        $start_p = strtotime($start_p.' 00:00:00');
        $end_p   = strtotime($end_p.' 23:59:59');

       //计算所有游戏总的
        $condition0['dl_single.uid']       = $uid;
        $condition0['dl_single.create_at'] = array('between',[$start_p,$end_p]);
        $all_total   = Db::name('single')->where($condition0)->count();
        $money_total = Db::name('single')->where($condition0)->sum('money');

        $condition1['uid']       = $uid;
        $condition1['create_at'] = array('between',[$start_p,$end_p]);
        $condition1['exp']       = 2;
        $total_win = Db::name('detail')
                    ->where($condition1)
                    ->sum('money');
        $total_win_lose = $total_win-$money_total;

        //计算某一彩种
        $condition['uid']  = $uid;
        $condition['cate'] = $cate;
        $condition['create_at'] = array('between',[$start_p,$end_p]);
        $cate_total = Db::name('single')
            ->where($condition)
            ->sum('money');

        $condition2['uid']       = $uid;
        $condition2['cate']      = $cate;
        $condition2['exp']       = 2;
        $condition2['create_at'] = array('between',[$start_p,$end_p]);
        $cate_win =   $win_money = Db::name('detail')
            ->where($condition2)
            ->sum('money');
        $cate_win_lose = $cate_win-$cate_total;


        $all_total      = number_format($all_total,2);
        $money_total    = number_format($money_total,2);
        $total_win_lose = number_format($total_win_lose,2);
        $cate_total     = number_format($cate_total,2);
        $cate_win_lose  = number_format($cate_win_lose,2);
        $return_data['all_total']      = $all_total;
        $return_data['money_total']    = $money_total;
        $return_data['total_win_lose'] = $total_win_lose;
        $return_data['cate_total']     = $cate_total;
        $return_data['cate_win_lose']  = $cate_win_lose;
        json_return(200,'成功',$return_data);

    }

    /**
     * 充值记录
     */
    public function recharge_record(Request $request){
        $uid     = $request ->post('uid');

        $page    = $request ->post('page')?$request->post('page'):1;

        if(!$uid){
            json_return(204,'缺少参数');
        }

        $limit = 20;
        $start = ($page-1)*$limit;
        $data = Db::name('recharge')
            ->field('id,create_at,money,status')
            ->where(array('uid'=>$uid))
            ->limit($start,$limit)
            ->order('id desc')
            ->select();
        foreach ($data as $k=>$v){
            if($v['status']==1) {
                $data[$k]['status'] = "申请中";
                }
            if($v['status']==2) {
                $data[$k]['status'] = "成功";
            }
            if($v['status']==3) {
                $data[$k]['status'] = "失败";
            }
        }
        $count = Db::name('recharge')
            ->where(array('uid'=>$uid))
            ->count();

        $return_data['data']       = $data;
        $return_data['now_page']   = $page;
        $return_data['per_page']   = $limit;
        $return_data['total_page'] = ceil($count/$limit);
        if($data) {
            json_return(200, '成功', $return_data);
        }else{
            json_return(205, '暂无数据');
        }

    }

    /**
     * 获取个人信息
     */
    public function get_personal(Request $request){
        $uid          = $request->post('uid');
        $data = Db::name('member')->where(array('id'=>$uid))->find();
        $back_money = Db::name('detail')
            ->where(array('uid'=>$uid))
            ->where('exp','in','3,6')
            ->sum('money');
        if($back_money){
            $back_money = number_format($back_money,2);
        }else{
            $back_money = '0.00';
        }
        $data['back_money'] = $back_money;
        unset($data['password']);
        unset($data['star']);
        unset($data['remark']);
        unset($data['agent']);
        unset($data['code']);
        unset($data['ip']);
        unset($data['tid']);
        if($data['head']){
            $data['head'] = Config::get('img_url').$data['head'];
        }
        json_return(200, '成功', $data);

    }

    /**
     * 修改个人信息
     */
    public function edit_personal(Request $request){

        $uid          = $request->post('uid');
        $file         = request()->file('head');
        $QQ           = $request->post('QQ');
        $wx           = $request->post('wx');
        $alipay       = $request->post('alipay');
        $true_name    = $request->post('true_name');
        $nickname     = $request->post('nickname');
        $bank         = $request->post('bank');
        $branch_bank  = $request->post('branch_bank');
        $bank_card    = $request->post('bank_card');
        if(!$uid){
            json_return(204,'缺少参数');
        }
        if($QQ){
            $data['QQ'] = $QQ;
        }
        if($wx){
            $data['wx'] = $wx;
        }
        if($alipay){
            $data['alipay'] = $alipay;
        }
        if($true_name){
            $data['true_name'] = $true_name;
        }
        if($nickname){
            $data['nickname'] = $nickname;
        }
        if($bank){
            $data['bank'] = $bank;
        }
        if($branch_bank){
            $data['branch_bank'] = $branch_bank;
        }
        if($bank_card){
            $data['bank_card'] = $bank_card;
        }
        if($file){
            $path = ROOT_PATH . 'public' . DS . 'uploads'. DS .'head_img';
            $info = $file->move($path);
            if($info){
                $data['head'] = 'head_img/'.$info->getSaveName();
            }else{
                json_return(201,'上传头像失败');
            }
        }

        $data['update_at'] = time();
        $result = Db::name('member')->where(array('id'=>$uid))->update($data);
        
        $return_data = $data;
        if(isset($return_data['head'])){
            $return_data['head'] = Config::get('img_url').$data['head'];
        }
        
        
        if($result){
            json_return(200,'修改成功',$return_data);
        }else{
            json_return(500,'修改失败');
        }
    }

    /**
     * 提现前获取数据
     */
    public function before_withdrawals(Request $request){
        $uid           = $request->post('uid');
        $data          = Db::name('member')
                            ->field('bank,branch_bank,bank_card,true_name')
                            ->where(array('id'=>$uid))
                            ->find();
        json_return(200,'成功',$data);
    }

    /**
     * 用户提现
     */
    public function do_withdrawals(Request $request){

        $uid           = $request->post('uid');
        $username      = $request->post('username');
        $bank_name     = $request->post('bank_name');
        $account_bank  = $request->post('account_bank');
        $branch_name   = $request->post('branch_name');
        $money         = $request->post('money');

        if(!$username || !$branch_name || !$account_bank || !$bank_name || !$uid ||!$money){
            json_return(204,'缺少参数');
        }
        $user = Members::get($uid);
        $up['true_name']   = $username;
        $up['branch_bank'] = $branch_name;
        $up['bank_card']   = $account_bank;
        $up['bank']        = $bank_name;
        Db::name('member')->where(array('id'=>$uid))->update($up);
        $my_money = $user['money'];
        $m_status = $user['m_status'];
        if($m_status==1){
            json_return(201,'您的账号已被冻结!');
        }
        if($my_money<$money){
            json_return(207,'余额不足');
        }
        Db::startTrans();
        try {
            $new_money = bcsub(round($my_money,2), round($money,2));
            $result0 = Db::name('member')
                ->where(array('id'=>$uid))
                ->update(array('money'=>$new_money));

            $data['uid']          = $uid;
            $data['username']     = $username;
            $data['bank_name']    = $bank_name;
            $data['account_bank'] = $account_bank;
            $data['branch_name']  = $branch_name;
            $data['money']        = $money;
            $data['create_at']  = time();
            $result = Db::name('withdrawals')->insert($data);
            Db::commit();
        }catch (\Exception $e){
            Db::rollback();
            json_return(500,'提现失败');
        }
        if($result && $result0){
            json_return(200,'申请提现成功');
        }else{
            json_return(500,'提现失败');
        }

    }

    /**
     * 获取提现记录
     */
    public function withdrawals_record(Request $request){

        $uid     = $request->post('uid');
        $page    = $request ->post('page')?$request->post('page'):1;
        $limit   = 20;
        $start   = ($page-1)*$limit;
        $data = Db::name('withdrawals')
            ->field('id,money,bank_name,status,create_at')
            ->where(array('uid'=>$uid))
            ->limit($start,$limit)
            ->order('id desc')
            ->select();
        $count = Db::name('withdrawals')
            ->where(array('uid'=>$uid))
            ->count();
        if(!$data){
            json_return(205,'暂无数据');
        }
        foreach ($data as $k=>$v){
           if($v['status']==1){
               $data[$k]['status'] = "审核中";
           }elseif ($v['status']==2){
               $data[$k]['status'] = "成功";
           }elseif ($v['status']==3){
               $data[$k]['status'] = "失败";
           }
        }
        $return_data['data']       = $data;
        $return_data['now_page']   = $page;
        $return_data['per_page']   = $limit;
        $return_data['total_page'] = ceil($count/$limit);
        json_return(200,'成功',$return_data);

    }

    /**
     * 获取银行列表
     */
    public function get_banks(){
        $data = Db::name('banks')->select();
        json_return(200,'成功',$data);
    }

    /**
     * 修改登陆密码
     */
    public function edit_pass(Request $request){

        $uid        = $request->post('uid');
        $old_pass   = $request->post('old_pass');
        $new_pass1  = $request->post('new_pass1');
        $new_pass2  = $request->post('new_pass2');
        if(!$old_pass || !$new_pass1 || !$new_pass2 || !$uid ){
            json_return(204,'缺少参数');
        }
        if($new_pass1 != $new_pass2){
            json_return(201,'两次密码不同');
        }
        $my_pass = Db::name('member')->where(array('id'=>$uid))->value('password');

        if(md5($old_pass) != $my_pass){
            json_return(201,'原密码不正确');
        }
        $result = Db::name('member')
            ->where(array('id'=>$uid))
            ->update(array('password'=>md5($new_pass1)));
        if($result){
            json_return(200,'修改密码成功');
        }else{
            json_return(500,'失败');
        }


    }

    /**
     * 退出登陆
     */
    public function logout(Request $request){
       $uid    = $request->post('uid');
       $data['token'] = 0;
       $result = Db::name('member')->where(array('id'=>$uid))->update($data);
       if($result){
            json_return(200,'成功');
       }else{
            json_return(500,'失败');
       }

    }

    /**
     * 线下充值
     */
    public function offline_charge(Request $request){
        $uid      = $request->post('uid');
        $money    = $request->post('money');
        $name     = $request->post('name');
        $remark   = $request->post('remark');
        $way      = $request->post('way');
        $file         = request()->file('hui');
        if(!$uid || !$name || !$money || !$remark  ){
            json_return(204,'缺少参数');
        }
        if($file) {
            $path = ROOT_PATH . 'public' . DS . 'uploads' . DS . 'hui';
            $info = $file->move($path);
            if ($info) {
                $charge['hui'] = 'hui/' . $info->getSaveName();
            }
        }
        $charge['way']    = $way;
        $charge['uid']    = $uid;
        $charge['money']  =  $money;
        $charge['name']   = $name;
        $charge['type']   = 2;
        $charge['remark'] = $remark;
        $charge['create_at'] = time();
        $result = Db::name('recharge')->insert($charge);
        if($result){
            json_return(200,'提交成功，等待后台审核');
        }else{
            json_return(500,'提交失败');
        }



    }

    /**
     * 代理中心
     */
    public function proxy_center(Request $request){
        $uid      = $request->post('uid');
        $page    = $request ->post('page')?$request->post('page'):1;
        if(!$uid ){
            json_return(204,'缺少参数');
        }
        $limit = 20;
        $start = ($page-1)*$limit;

        $data = Db::name('member')
            ->field('id,nickname,create_at,mobile')
            ->where(array('tid'=>$uid))
            ->limit($start,$limit)
            ->select();
        if(!$data){
            json_return(205,'去邀请小伙伴吧!');
        }
        foreach ($data as $k=>$v){
            $data[$k]['proxy_money'] = Db::name('detail')
                ->where(array('uid'=>$v['id'],'exp'=>4))
                ->sum('money');
        }
        $count=Db::name('member')
            ->where(array('tid'=>$uid))
            ->count();
        $return_data['data'] = $data;
        $return_data['now_page'] = $page;
        $return_data['per_page'] = $limit;
        $return_data['total_page'] = ceil($count/$limit);

        json_return(200,'成功',$return_data);

    }

    /**
     * 返利详情
     */
    public function rebate_detail(Request $request){
        $uid      = $request->post('uid');
        $cate     =Db::name('cate')->field('id,name')->select();
        foreach ($cate as $k=>$v){
            $tz = Db::name('detail')
                ->where(array('uid'=>$uid,'exp'=>5,'cate'=>$v['id']))
                ->sum('money');
            $zj = Db::name('detail')
                ->where(array('uid'=>$uid,'exp'=>2,'cate'=>$v['id']))
                ->sum('money');
            $hs = Db::name('detail')
                ->where(array('uid'=>$uid,'cate'=>$v['id']))
                ->where('exp','in','3,6')
                ->sum('money');
            if(!$tz){
                $tz = '0.00';
            }
            if(!$zj){
                $zj = '0.00';
            }
            if(!$hs){
                $hs = '0.00';
            }
            number_format($zj - $tz,2);
            $detail['win_lose']   =  number_format($zj - $tz,2);
            $detail['back_water'] = number_format($hs,2);
            $detail['fact_win']   = number_format($zj +$hs - $tz,2);
            $detail['my_win']     = number_format($zj +$hs - $tz,2);
            $cate[$k]['detail']   =$detail;
        }
        json_return(200,'成功',$cate);

    }

    /**
     * 转账到AG、BB
     */
    public function money_to_game(Request $request){
        $uid        = $request->post('uid');
        $money      = $request->post('money');
        $type       = $request->post('type');
        $game       = $request->post('game');
        if(!$uid || !$money ||!$type || !$game ){
            json_return(204,'缺少参数');
        }
        if($game=='AG'){
            $cate = 13;
        }elseif ($game=='BB'){
            $cate = 14;
        }else{
            json_return(201,'游戏类型不正确');
        }
        if($type==1) {//转入AG、BB平台
            $user_info = Db::name('member')->where(array('id' => $uid))->field('mobile,money,is_ag,is_bb,gm_name')->find();
            $is_open = 0;
            if($game=='AG' && $user_info['is_ag']==1){
                $is_open = 1;
           }
            if($game=='BB' && $user_info['is_bb']==1){
                $is_open = 1;
            }
            $my_money = $user_info['money'];
            $mobile   =  $user_info['gm_name'];
            if ($my_money < $money) {
                json_return(207, '余额不足');
            }
            Db::startTrans();
            try {
            $new_money = bcsub(round($my_money, 2), round($money, 2));
            if($is_open==0){
                if($game=='AG'){
                    $up_data['is_ag'] = 1;
                }
                if($game=='BB'){
                    $up_data['is_bb'] = 1;
                }
            }
            $up_data['money']=$new_money;
            $result0 = Db::name('member')
                ->where(array('id' => $uid))
                ->update($up_data);
            $data['uid'] = $uid;
            $data['type'] = 2;
            $data['money'] = $money;
            $data['balance'] = $new_money;
            $data['exp'] = 7;
            $data['cate'] = $cate;
            $data['explain'] = $game . '上分';
            $data['create_at'] = time();
            $result1 = Db::name('detail')->insert($data);
            error_reporting(0);
            $API = new Biapi();
            $result2 = $API->zzmoney($game, $mobile, 'IN', $money,$is_open);
            $gm_money = $API->balances($game,$mobile);
            }catch (\Exception $e){

                Db::rollback();
                json_return(500,'转换失败');
            }
            if($result0 && $result1 && $result2){
                $back['uid']   = $uid;
                $back['money'] = $new_money;
                $back['gm_money'] = $gm_money;
                Db::commit();
                json_return(200,'转出成功',$back);
            }

        }
        if($type==2) {//转出AG、BB平台
            $API = new Biapi();
            $user_info = Db::name('member')->where(array('id'=>$uid))->field('gm_name,mobile,money')->find();
            $yc_money  = $user_info['money'];
            $mobile    = $user_info['gm_name'];
            $my_money = $API->balances($game,$mobile);
            if($my_money<$money){
                json_return(207,'余额不足');
            }
            Db::startTrans();
            try {
                $new_money = $yc_money+$money;
                $result0 = Db::name('member')
                    ->where(array('id'=>$uid))
                    ->update(array('money'=>$new_money));
                $data['uid']          = $uid;
                $data['type']         = 1;
                $data['money']        = $money;
                $data['balance']      = $new_money;
                $data['exp']          = 7;
                $data['cate']         = $cate;
                $data['explain']      = $game.'下分';
                $data['create_at']    = time();
                $result1 = Db::name('detail')->insert($data);
                $result2 = $API-> zzmoney($game,$mobile,'OUT',$money);
            }catch (\Exception $e){
                Db::rollback();
                json_return(500,'转出失败');
            }
            if($result0 && $result1 && $result2){
                Db::commit();
                $back['uid']   = $uid;
                $back['money'] = $new_money;
                $back['gm_money'] = $my_money-$money;
                json_return(200,'转出成功',$back);
            }
        }

    }

    /**
     * 获取AG、BB账户余额
     */
    public function get_game_money(Request $request){
        $uid        = $request->post('uid');
        $game       = $request->post('game');
        if(!$uid || !$game ){
            json_return(204,'缺少参数');
        }
        if($game!='AG' && $game!='BB'){
            json_return(201,'游戏类型不正确');
        }
        if(!$uid || !$game ){
            json_return(204,'缺少参数');
        }
        $mobile = Db::name('member')->where(array('id'=>$uid))->value('gm_name');
        error_reporting(0);
        $API = new Biapi();
        $my_money = $API->balances($game,$mobile);
        $data['uid']   = $uid;
        $data['money'] = $my_money;
        json_return(200,'成功',$data);

    }



}