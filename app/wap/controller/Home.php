<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/10/30
 * Time: 11:08
 */

namespace app\wap\controller;

use app\admin\model\Members;
use think\Controller;
use think\Db;
use think\Request;
use app\wap\controller\Biapi;
use think\Cache;

class Home extends Controller
{
    public $uid;
    public function _initialize()
    {
        $url = $_SERVER['PHP_SELF'];
        // 如果是支付回调，不判断登录
        if(!strpos($url,'payNotifyUrl')){
            //判断是否登入成功
            if(!isHomeLogin()){
                $this->redirect('Login/index');
            }
            $this->uid = session('member_info.uid');
            //$member = Members::get($this->uid,'',3);
            //$umoney = Members::where('id',$this->uid)->value('money');
            //$this->userinfo = ['uid'=>$this->uid,'name'=>$member->gm_name,'mobile'=>$member->mobile,'head'=>$member->head,'money'=>$umoney,'is_proxy'=>$member->is_proxy,'rebate'=>$member->rebate,'bonus'=>$member->bonus];
            //$this->assign('users',['uid'=>$this->uid,'name'=>$member->gm_name,'mobile'=>$member->mobile,'head'=>$member->head,'money'=>$umoney,'rebate'=>$member->rebate]);
            $request = Request::instance();
            $controllerName = $request->controller();
            $this->assign('controllerName',strtolower($controllerName));
            $this->setLoginNum();
        }
    }
    /*记录登入记录
        */
    public function setLoginNum(){
        $login_array = cache('login_array');
        $login_array['uid_'.$this->uid] = time()+300;
        cache('login_array',$login_array);
    }
    //刷新余额
    public function refresh(){
        $moneyData = Db::name('member')->where('id',$this->uid)->field('money,unpaid_money')->find();
        if($moneyData){
            $returnData['code'] = 1;
            $returnData['data'] = $moneyData;
        }else{
            $returnData['code'] = 0;
        }
        return json($returnData);
    }

    //刷新余额
    public function refreshRealMoney(Request $request){
        $data = $request->post();
        if($data['type'] == 'SS'){
            $gameType = 'SS';
            $updateDataStr = 'bb_money';
        }else{
            $gameType = 'AG';
            $updateDataStr = 'ag_money';
        }
        $gn = 'gameMoney_'.$gameType.$this->uid;
        $gameMoney = Cache::get($gn);
        if($gameMoney){
            $returnData['code'] = 1;
            $returnData['data'] = $gameMoney;
        }else{
            $user = session('member_info.name');
            $api = new BiApi();
            $res = $api->balances($gameType,$user);
            if($res){
                $gameMoney = Cache::set($gn,$res,300);
                $updateData[$updateDataStr] = $res;
                Db::name('member')->where('id',$this->uid)->update($updateData);
                $returnData['code'] = 1;
                $returnData['data'] = $gameMoney;
            }else{
                $returnData['code'] = 0;
                $returnData['msg'] = '查询失败，请稍后再试';
            }
        }
        return json($returnData);
    }
}