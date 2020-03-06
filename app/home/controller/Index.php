<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/10/30
 * Time: 11:08
 */
namespace app\home\controller;
use think\Controller;
use think\Db;
use app\home\controller\Biapi;
use app\api\command\Numbers;
use app\home\command\Numbers as num;
class Index extends Home
{
	public function test(){
	    die;
	    //$arr = array('大','小','单','双','红波','绿波','蓝波','尾大','尾小','合大','合小','合双','合单','家禽','野兽','区段A','区段B','区段C','区段D','区段E');
        //$arr11 = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49);
          //$arr12 = array('特大','特小','特单','特双','和大','和小','和单','和双','大单','大双','小单','小双','尾大','尾小','尾单','尾双');
          //$arr31 = array('大','小','单','双','和大','和小','和单','和双','大单','大双','小单','小双','尾大','尾小','尾单','尾双','红波','绿波','蓝波');
        $arr3 = array('鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗','猪');
        $arr32 = ['11,23,35,47','10,22,34,46','09,21,33,45','08,20,32,44','07,19,31,43','06,18,30,42','05,17,29,41','04,16,28,40','03,15,27,39','02,14,26,38','01,13,25,37,49','12,24,36,48'];
//        $arr4 = array('总和大','总和小','总和单','总和双','总和尾大','总和尾小','龙','虎');
//        $arr5 = array('尾大','尾小','大','小','单','双','合双','合单','红波','绿波','蓝波');
//        $arr6 = array('红单','蓝单','绿单','红双','蓝双','绿双','红大','蓝大','绿大','红小','蓝小','绿小','红合双','蓝合单','绿合单','红合双','蓝合双','绿合双');
        //$arr7 = array(0,1,2,3,4,5,6,7,8,9);
        //$arr71 = ['10,20,30,40,','01,11,21,31,41','02,12,22,32,42','03,13,23,33,43','04,14,24,34,44','05,15,25,35,45','06,16,26,36,46','07,17,27,37,47','08,18,28,38,48','09,19,29,39,49'];
//        $arr8 = array('大','小','单','双','尾大','尾小','合大','合小','合双','合单','红波','绿波','蓝波');
//        $arr11 = ['大','小','单','双',1,2,3,4,5,6,7,8,9,10,11];
//        $arr12 = ['二中二','三中三','四中四','五中五','六中五','七中五','八中五','前二组选','前三组选'];
//        for ($i=3;$i<=18;$i++){
//            $data=array();
//            $data['cate']=20;
//            $data['type']=1;
//            $data['rule']=$i;
//            $data['sort']=$i-2;
//            $data['rate']=1;
//            $re = Db::name('odds')->insert($data);
//        }
//        foreach ($arr3 as $k => $v) {
//            $data=array();
//            $data['cate']=8;
//            $data['type']=1;
//            $data['rule']=$v;
//            $data['win_rule']=$arr32[$k];
//            $data['sort']=$k+68;
//            $data['rate']=1;
//            $re = Db::name('odds')->insert($data);
//        }



//	    Db::startTrans();
//	    try{
//            $bet = Db::name('bet')->where('cate',5)->order('type')->select();
//            foreach ($bet as $k => $v) {
//                $insertData=[];
//                $insertData=$v;
//                $insertData['cate']=7;
//                $insertData = array_diff_key($insertData,['id'=>0]);
//                Db::name('bet')->insert($insertData);
//            }
//            $type = Db::name('bet')->where('cate',5)->column('type');
//            foreach ($type as $k => $v) {
//                $odds_data[$v] = Db::name('odds')->where('cate',5)->where('type',$v)->order('sort')->select();
//            }
//            for ($i=1; $i <=count($odds_data) ; $i++) {
//                foreach ($odds_data[$i] as $k => $v) {
//                    $insertData=[];
//                    $insertData = $v;
//                    $insertData['cate']=7;
//                    $insertData = array_diff_key($insertData,['id'=>0]);
//                    Db::name('odds')->insert($insertData);
//                }
//            }
//            Db::commit();
//        }catch (\Exception $e) {
//	        Db::rollback();
//	        dump($e->getMessage());
//        }
	}
    public function index(){
        error_reporting(0);
        $username = session('member_info.name');
        $api = new Biapi();
        $url[0]=$api->loginbi('SS',$username,'ball');
        $url[1]=$api->loginbi('AG',$username);
        if (request()->isMobile()){
            if(isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'],'WEBVIEW_APP') !== false){//app访问
                $download[0] = 'jumpbrowser://callName_?http://'.$_SERVER['SERVER_NAME'].'/uploads/bao/xinhui.apk';
                $download[1] = 'jumpbrowser://callName_?http://www.pgyer.com/K1ag';
                $real[0] = 'jumpbrowser://callName_?'.$url[0];
                $real[1] = 'jumpbrowser://callName_?'.$url[1];
            }else{
                $download[0] = '/uploads/bao/xinhui.apk';
                $download[1] = 'http://www.pgyer.com/K1ag';
                $real[0] = $url[0];
                $real[1] = $url[1];
            }
            $this->assign('download',$download);
            $this->assign('real',$real);
        }
        $mem = session('member_info');
        if(!empty($mem)){
            $memMoney = Db::name('member')->where('id',$mem['uid'])->field('id,money,ag_money,unpaid_money,bb_money,gm_name as name')->find();
            $memInfo = Db::name('member')->where('id',$mem['uid'])->find();
            $status = 1;
        }else{
            $memMoney = 0;
            $memInfo = '';
            $status = 0;
        }
        $noticeList = Db::name('notice')->order('id desc')->limit(10)->select();
        foreach ($noticeList as $k=>$v){
            $noticeList[$k]['time'] = date('m/d',strtotime($v['create_time']));
        }
        return view('',[
            'url'=>$url,
            'noticeList'=>$noticeList,
            'memMoney'=>$memMoney,
            'memInfo'=>$memInfo,
            'status'=>$status,
        ]);
    }
    public function game(){
        $noticeList = Db::name('notice')->order('id desc')->limit(10)->select();
        return view('',[
            'noticeList'=>$noticeList
        ]);
    }
    public function hall(){
	    return view();
    }
}