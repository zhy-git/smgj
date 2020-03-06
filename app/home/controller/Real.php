<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/10/30
 * Time: 11:08
 */
namespace app\home\controller;
use app\home\controller\Biapi;
use think\Db;
class Real extends Home
{
    public function index(){
        error_reporting(0);
        //include('ApiBi/BiApi.class.php');
        $typePage = input('type');
        $platformCode= $typePage;
        //BB AG;
        //$gameType = 'ball';
        if($platformCode == 'SS'){
            $gameType = 'ball';
        }else{
            $gameType = '';
        }
        $username = session('member_info.name');
        $api = new Biapi();
        if($gameType){
            $url=$api->loginbi($platformCode,$username,$gameType);
        }else{
            $url=$api->loginbi($platformCode,$username);
        }
        return view('',[
            'url'=>$url,
        ]);
    }

    public function wap(){
        error_reporting(0);
        //include('ApiBi/BiApi.class.php');
        $typePage = input('type');
        $platformCode= $typePage;
        //BB AG;
        //$gameType = 'ball';
        if($platformCode == 'SS'){
            $gameType = 'ball';
        }else{
            $gameType = '';
        }
        $username = session('member_info.name');
        $api = new Biapi();
        if($gameType){
            $url=$api->loginbi($platformCode,$username,$gameType);
        }else{
            $url=$api->loginbi($platformCode,$username);
        }
       $this->redirect($url);
    }



    public function chaxun(){
        error_reporting(0);
        //include('ApiBi/BiApi.class.php');
//        $game = 'SS';
//        $user = session('member_info.name');
//        if($game!=''){
//            $api=new BiApi();
//            $res=$api->balances($game,$user);
//            echo $res;
//
//        }
//        $api = new BiApi();
//        $platformCode = 'AG';
//        $StartTime = 1520925961;
//        $EndTime = 1520926131;
//        $TimeStamp = time();
//        $PageIndex = 1;
//        $PageSize = 1;
//        $res = $api->GetMerchantReport($platformCode, $StartTime, $EndTime, $TimeStamp, $PageIndex, $PageSize);
//        print_r($res);
    }
}