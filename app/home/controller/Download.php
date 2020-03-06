<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/9/13
 * Time: 16:48
 */

namespace app\home\controller;
use think\Db;
class Download extends Home
{
    public function index(){
        $memMoney = Db::name('member')->where('id',$this->uid)->field('money,ag_money,unpaid_money,bb_money')->find();
        $memInfo = session('member_info');
        $noticeList = Db::name('notice')->order('id desc')->limit(10)->select();
        foreach ($noticeList as $k=>$v){
            $noticeList[$k]['time'] = date('m/d',strtotime($v['create_time']));
        }
        $setting = Db::name('setting')->where('id',1)->find();
        return view('',[
            'noticeList'=>$noticeList,
            'memMoney'=>$memMoney,
            'memInfo'=>$memInfo,
            'setting'=>$setting,
        ]);
    }
    public function isWap()
    {
        if (isset($_SERVER['HTTP_VIA']) && stristr($_SERVER['HTTP_VIA'], "wap")) {
            return true;
        } elseif (isset($_SERVER['HTTP_ACCEPT']) && strpos(strtoupper($_SERVER['HTTP_ACCEPT']), "VND.WAP.WML")) {
            return true;
        } elseif (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE'])) {
            return true;
        } elseif (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/(blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera |Googlebot-Mobile|YahooSeeker\/M1A1-R2D2|android|iphone|ipod|mobi|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|windows ce|xda |xda_)/i', $_SERVER['HTTP_USER_AGENT'])) {
            return true;
        } else {
            return false;
        }
    }
    public function wap(){


        exit;
        if ($this->isWap()){
            echo 'in';
        }else{
            echo 'xxx';
        }
        exit;
        if (isset($_SERVER['HTTP_VIA']) && stristr($_SERVER['HTTP_VIA'], "wap")) {
            echo 'in';
        }else{
            echo 'xxx';
        }
        exit;

        $type = input('param.type');
        if ($type == 'a' ){
            $arr['img'] = 'code_a.png';
            $arr['title'] = '安卓下载';
        }else{
            $arr['img'] = 'code_xe.png';
            $arr['title'] = 'IOS下载';
        }
//        $file=fopen('./uploads/bao/xinhui.apk',"r");
//        header("Content-Type: application/octet-stream");
//        header("Accept-Ranges: bytes");
//        header("Accept-Length: ".filesize('./uploads/bao/xinhui.apk'));
//        header("Content-Disposition: attachment; filename=鑫辉");
//        echo fread($file,filesize('./uploads/bao/xinhui.apk'));
//        fclose($file);

        $filename=realpath("./uploads/bao/xinhui.apk"); //文件名
        Header( "Content-type:  application/octet-stream ");
        Header( "Accept-Ranges:  bytes ");
        Header( "Accept-Length: " .filesize($filename));
        header( "Content-Disposition:  attachment;  filename= xinhui.apk");
        echo file_get_contents($filename);
        readfile($filename);
//        $this->assign('type',$arr);
//        return view();
    }





}