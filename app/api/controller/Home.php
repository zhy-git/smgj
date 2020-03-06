<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/10/30
 * Time: 11:08
 */

namespace app\api\controller;



use think\Cache;
use think\Config;
use think\Controller;
use think\Db;
use think\Request;

class Home extends Controller
{
  
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        parent::__construct();
    }

    /**
     * 记录在线人数
     */
    public function set_online_number($uid=0,$cate=0,$hall=0){
        if($uid) {
            $online_all = Cache::get('online_'.'all');
            if ($online_all) {
                $online_all[$uid] = time();
            } else {
                $online_all = [];
                $online_all[$uid] = time();
            }
            Cache::set('online_' . 'all', $online_all);
            if ($cate) {//把进入该游戏的人计入缓存
                $online_cate = Cache::get('online_'.$cate);
                if ($online_cate) {
                    $online_cate[$uid] = time();
                } else {
                    $online_cate = [];
                    $online_cate[$uid] = time();
                }
                Cache::set('online_' . $cate, $online_cate);
            }
            if ($cate && $hall) {//把进入该游戏的人计入缓存
                $online_hall = Cache::get('online_'.$cate.$hall);
                if ($online_hall) {
                    $online_hall[$uid] = time();
                } else {
                    $online_hall = [];
                    $online_hall[$uid] = time();
                }
                Cache::set('online_' .$cate.$hall, $online_hall);
            }
        }
    }

    /**
     * 首页广告
     */
    public function get_ads(){

        $data = Db::name('advertise')->select();
        foreach ($data as $k=>$v){
            $data[$k]['ad_url']= Config::get('img_url').$v['ad_url'];
        }
        if($data){
            json_return(200,'成功',$data);
        }else{
            json_return(205,'暂无数据');
        }

    }

    /**
     * 获取高频彩项目
     */
    public function get_cates(){

        $data = Db::name('cate')->where(array('status'=>1))->select();

        foreach ($data as $k=>$v){
            $data[$k]['cate_img']= Config::get('img_url').$v['cate_img'];
        }
        if($data){
            json_return(200,'成功',$data);
        }else{
            json_return(205,'暂无数据');
        }

    }

    /**
     * 获取一个高平彩票下面的厅
     */
    public function get_halls(Request $request){
        $uid     =  $request->post('uid');
        $cate_id = $request->post('cate_id');
        if(!$cate_id){
            json_return(204,'缺少参数');
        }
        $this->set_online_number($uid,$cate_id);
        $data = Db::name('hall')
            ->where(array('status'=>1,'cate'=>$cate_id))
            ->select();
        //计算在线人数总人数
        $online_all = Cache::get('online_'.'all');
        if($online_all) {
            foreach ($online_all as $kk => $vv) {
                if (time() - $vv > 3600) {
                    unset($online_all[$kk]);
                }
            }
            $online_all_number = count($online_all);
        }else{
            $online_all_number=0;
        }
        //计算在线人数本种游戏类型的人数
        $online_cate = Cache::get('online_'.$cate_id);
        if($online_cate) {
            foreach ($online_cate as $kk => $vv) {
                if (time() - $vv > 3600) {
                    unset($online_cate[$kk]);
                }
            }
            $online_cate_number = count( $online_cate);
        }else{
            $online_cate_number=0;
        }
        foreach ($data as $k=>$v){
        $data[$k]['hall_img'] = Config::get('img_url').$v['hall_img'];
            //计算在线人数本种游戏本种大厅的人数
            $online_hall = Cache::get('online_'.$cate_id.$v['hall']);
            if($online_hall) {
                foreach ($online_hall as $kk => $vv) {
                    if (time() - $vv > 3600) {
                        unset($online_hall[$kk]);
                    }
                }
                $online_hall_number = count( $online_hall);
            }else{
                $online_hall_number=0;
            }
         $data[$k]['online'] = $online_hall_number;
        unset($data[$k]['status']);
        }
        $return_data['online_all']  = $online_all_number;
        $return_data['online_cate'] = $online_cate_number;
        $return_data['data']        = $data;

        if($data){
            json_return(200,'成功',$return_data);
        }else{
            json_return(205,'暂无数据');
        }

    }

    /**
     * 获取一个高平彩票下面的pan
     */
    public function get_pan(Request $request){

        $cate_id = $request->post('cate_id');

        if(!$cate_id){
            json_return(204,'缺少参数');
        }

        $data = Db::name('pan')->where(array('status'=>1,'cate'=>$cate_id))->select();
        if($data){
            json_return(200,'成功',$data);
        }else{
            json_return(205,'暂无数据');
        }
    }

    /**
     * 获取一个高平彩票下面的某一种盘的赔率
     */
    public function get_odd(Request $request){

        $cate_id = $request->post('cate_id');
        $hall    = $request->post('hall');
        $pan     = $request->post('pan');
        $uid     = $request->post('uid');
        if(!$cate_id || !$hall || !$pan){
            json_return(204,'缺少参数');
        }

        $this->set_online_number($uid,$cate_id,$hall);

        $data = Db::name('bet')
            ->field('title,type')
            ->where(array('cate'=>$cate_id))
            ->select();
       // $bei = Db::name('hall')->where(array('cate'=>$cate_id,'hall'=>$hall))->value('	relatively_odd');
        foreach ($data as $k=>$v){
            $name= Db::name('odds')
                ->where(array('type'=>$v['type'],'pan'=>$pan,'cate'=>$cate_id,'hall'=>$hall))
                ->select();
            foreach ($name as $kk=>$vv){
                $name[$kk]['rate'] =number_format($vv['rate'],3);
            }
            if($name){
                $data[$k]['name'] = $name;
            }else{
                unset($data[$k]);
            }

        }
        $data = array_values($data);
        if($data){
            json_return(200,'成功',$data);
        }else{
            json_return(205,'暂无数据');
        }
    }

    /**
     * 获取开奖公告
     */
    public function get_open_notice(){

        $data = Db::name('cate')->field('id,name')->select();
        foreach ($data as $k=>$v){
            switch ($v['id']){
                case 1:
                    $number = getNumberCache('eight');
                    $stage= key($number); //获取最新一期的key（即期数）
                    $numbers =$number[$stage]; //获取最新开奖号
                    $number_arr_s = explode(',',$numbers['number']);
                    $number_arr = getEightNum($number_arr_s);

                    $total_number = array_sum($number_arr);
                    $dx = eightDx($total_number); //判断大小
                    $ds = eightDs($total_number);//判断单双
                    $bo = eightBo($total_number)."波";//判断波色
                    $detail = $total_number.",".$dx.",".$ds.","."--".",".$bo;
                    $data[$k]['stage']  = $stage;
                    $data[$k]['detail'] = $detail;
                 break;
                case 2:
                    $number = getNumberCache('canada');
                    $stage= key($number); //获取最新一期的key（即期数）
                    $numbers =$number[$stage]; //获取最新开奖号
                    $number_arr_s = explode(',',$numbers['number']);
                    $number_arr = getEightNum($number_arr_s);
                    $total_number = array_sum($number_arr);
                    $dx = eightDx($total_number); //判断大小
                    $ds = eightDs($total_number);//判断单双
                    $bo = eightBo($total_number)."波";//判断波色
                    $detail = $total_number.",".$dx.",".$ds.","."--".",".$bo;
                    $data[$k]['stage']  = $stage;
                    $data[$k]['detail'] = $detail;
                    break;
                case 3:
                    $number = getNumberCache('car');
                    $stage= key($number); //获取最新一期的key（即期数）
                    $numbers =$number[$stage]; //获取最新开奖号
                    $number_arr = explode(',',$numbers['number']);

                    $ling = $number_arr[0]+$number_arr[1];//冠亚军和值
                    $yi  = carDxWei($number_arr[1]); //判断大小
                    $er  = carDs($number_arr[2]);//判断单双
                    $san = longfu($number_arr[3],$number_arr[6]);//判断龙虎
                    $si  = longfu($number_arr[4],$number_arr[5]);//判断龙虎
                    $wu  = longfu($number_arr[5],$number_arr[4]);//判断龙虎
                    $liu = longfu($number_arr[6],$number_arr[3]);//判断龙虎
                    $qi  = longfu($number_arr[7],$number_arr[2]);//判断龙虎
                    $detail = $ling.",".$yi.",".$er.",".$san.",". $si.",".$wu.",".$liu.",". $qi;
                    break;
                case 4:
                    $number = getNumberCache('airship');
                    $stage= key($number); //获取最新一期的key（即期数）
                    $numbers =$number[$stage]; //获取最新开奖号
                    $number_arr = explode(',',$numbers['number']);
               
                    $ling = $number_arr[0]+$number_arr[1];//冠亚军和值
                    $yi  = carDxWei($number_arr[1]); //判断大小
                    $er  = carDs($number_arr[2]);//判断单双
                    $san = longfu($number_arr[3],$number_arr[6]);//判断龙虎
                    $si  = longfu($number_arr[4],$number_arr[5]);//判断龙虎
                    $wu  = longfu($number_arr[5],$number_arr[4]);//判断龙虎
                    $liu = longfu($number_arr[6],$number_arr[3]);//判断龙虎
                    $qi  = longfu($number_arr[7],$number_arr[2]);//判断龙虎
                    $detail = $ling.",".$yi.",".$er.",".$san.",". $si.",".$wu.",".$liu.",". $qi;
                    break;
                case 5:
                    $number = getNumberCache('ssc');
                    $stage= key($number); //获取最新一期的key（即期数）
                    $numbers =$number[$stage]; //获取最新开奖号
                    $number_arr = explode(',',$numbers['number']);
                  
                    $he = array_sum($number_arr);
                    $dx = sscDx($he); //判断大小
                    $ds = sscDs($he);//判断单双
                    $longfu = sscLh($number_arr);
                    $first_three = take_three($number_arr,0);
                    $r_first_three = judge_three($first_three);
                    
                    $second_three = take_three($number_arr,1);
                    $r_second_three = judge_three($second_three);

                    $third_three = take_three($number_arr,2);
                    $r_third_three = judge_three($third_three);
                    $niuniu = niuNiu($number_arr);
                    $detail = $he.",".$dx.",".$ds.",".$longfu.",". $r_first_three.",".$r_second_three.",".$r_third_three.",".$niuniu;
                    break;
                case 6:
                    $number = getNumberCache('tjssc');
                    $stage= key($number); //获取最新一期的key（即期数）
                    $numbers =$number[$stage]; //获取最新开奖号
                    $number_arr = explode(',',$numbers['number']);

                    $he = array_sum($number_arr);
                    $dx = sscDx($he); //判断大小
                    $ds = sscDs($he);//判断单双
                    $longfu = sscLh($number_arr);
                    $first_three = take_three($number_arr,0);
                    $r_first_three = judge_three($first_three);

                    $second_three = take_three($number_arr,1);
                    $r_second_three = judge_three($second_three);

                    $third_three = take_three($number_arr,2);
                    $r_third_three = judge_three($third_three);

                    $niuniu = niuNiu($number_arr);
                    $detail = $he.",".$dx.",".$ds.",".$longfu.",". $r_first_three.",".$r_second_three.",".$r_third_three.",".$niuniu;
                    break;
                case 7:
                    $number = getNumberCache('gd10');
                    $stage= key($number); //获取最新一期的key（即期数）
                    $numbers =$number[$stage]; //获取最新开奖号
                    $number_arr = explode(',',$numbers['number']);
                    $ling = array_sum($number_arr);//冠亚军和值
                    $yi  = Zgd10dx($ling); //判断大小
                    $er  = Zgd10ds($ling);//判断单双
                    $san = Zgd10weidx($ling);//判断龙虎
                    $si  = Zgd10weids($ling);//判断龙虎
                    $detail = $ling.",".$yi.",".$er.",".$san.",". $si;
                    break;
                case 8:
                    $number = getNumberCache('cq10');
                    $stage= key($number); //获取最新一期的key（即期数）
                    $numbers =$number[$stage]; //获取最新开奖号
                    $number_arr = explode(',',$numbers['number']);
                    //计算下次期数 和 开间时间
                    $ssc = setcq10StageTime($stage,$numbers['dateline']);
                    $ling = array_sum($number_arr);//冠亚军和值
                    $yi  = Zgd10dx($ling); //判断大小
                    $er  = Zgd10ds($ling);//判断单双
                    $san = Zgd10weidx($ling);//判断龙虎
                    $si  = Zgd10weids($ling);//判断龙虎
                    $detail = $ling.",".$yi.",".$er.",".$san.",". $si;
                    break;
                case 9:
                    $number = getNumberCache('fast');
                    $stage= key($number); //获取最新一期的key（即期数）
                    $numbers =$number[$stage]; //获取最新开奖号
                    $number_arr = explode(',',$numbers['number']);
                    $he = array_sum($number_arr); //和
                    $dx = FastDx($he);//判断大小
                    $detail = $he.",".$dx;
                    break;
                case 10:
                    $number = getNumberCache('gd11');
                    $stage= key($number); //获取最新一期的key（即期数）
                    $numbers =$number[$stage]; //获取最新开奖号
                    $number_arr = explode(',',$numbers['number']);
                    $ling = array_sum($number_arr);//冠亚军和值
                    $yi  = gd11zdx($ling); //判断大小
                    $er  = gd11ds($ling);//判断单双
                    $san = gd11lf($number_arr);//判断龙虎
                    $detail = $ling.",".$yi.",".$er.",".$san;
                    break;
                case 11:
                    $number = getNumberCache('hk');
                    $stage= key($number); //获取最新一期的key（即期数）
                    $numbers =$number[$stage]; //获取最新开奖号
                    $number_arr = explode(',',$numbers['number']);
                    $dx    = hkdx($number_arr[6]); //判断大小
                    $ds    = hkds($number_arr[6]);//判断单双
                    $sebo  = hkhll($number_arr[6]);
                    $hkwei = hkwei($number_arr[6]);


                    $detail = $ds.",".$dx.",".$sebo.",".$hkwei;
                    break;
            }
            $data[$k]['number'] = $number_arr;
            $data[$k]['stage']  = $stage;
            $data[$k]['detail'] = $detail;
        }
        json_return(200,'成功',$data);
    }

    /**
     * 获取系统公告
     */
    public function system_notice(Request $request){
        $page    = $request->post('page')?$request->post('page'):1;

        $limit = 20;

        $start = ($page-1)*$limit;

        $data = Db::name('notice')
            ->order('id desc')
            ->limit($start,$limit)
            ->select();
        $total = Db::name('notice')->count();
        $return_data['data']       = $data;
        $return_data['now_page']   = $page;
        $return_data['per_page']   = $limit;
        $return_data['total_page'] = ceil($total/$limit);
        if($data) {
            json_return(200, '成功', $return_data);
        }else{
            json_return(205, '暂无数据');
        }

    }

    /**
     * 获取我的消息
     */
    public function my_notice(Request $request){
        $uid   = $request->post('uid');
        $page  = $request->post('page')?$request->post('page'):1;

        if(!$uid){
            json_return(204,'缺少参数');
        }
       $limit = 20;

        $start = ($page-1)*$limit;
        $data = Db::name('member_msg')
            ->where(array('uid'=>$uid))
            ->order('id desc')
            ->limit($start,$limit)
            ->select();
        $total = Db::name('member_msg')->where(array('uid'=>$uid))->count();
        $return_data['data']       = $data;
        $return_data['now_page']   = $page;
        $return_data['per_page']   = $limit;
        $return_data['total_page'] = ceil($total/$limit);
        if($data) {
            json_return(200, '成功', $return_data);
        }else{
            json_return(205, '暂无数据');
        }
    }

    /**
     * 获取某一个彩种的游戏规则
     */
    public function get_play_rules(Request $request){
        $cate =  $request->post('cate_id');
        if(!$cate){
            json_return(204,'缺少参数');
        }
        $data = Db::name('play_rule')->where(array('cate'=>$cate))->value('play_rule');

        json_return(200, '成功', $data);
    }

    /**
     * 获取某一彩种某一大厅的赔率
     */
    public function get_hall_odds(Request $request){
        $uid     =  $request->post('uid');
        $cate_id =  $request->post('cate_id');
        $hall    =  $request->post('hall');
        if(!$cate_id || !$hall ){
            json_return(204,'缺少参数');
        }
        $this->set_online_number($uid,$cate_id,$hall);
        $data = Db::name('bet')
            ->field('title,type')
            ->where(array('cate'=>$cate_id))
            ->select();

        foreach ($data as $k=>$v){
            $name= Db::name('odds')
                ->field('id,rule,rate')
                ->where(array('type'=>$v['type'],'cate'=>$cate_id,'hall'=>$hall))
                ->select();
            foreach ($name as $kk=>$vv){
                $name[$kk]['rate'] =number_format($vv['rate'],3);
            }
            if($name){
                $data[$k]['name'] = $name;
            }else{
                unset($data[$k]);
            }

        }
        $data = array_values($data);
        if($data){
            json_return(200,'成功',$data);
        }else{
            json_return(205,'暂无数据');
        }

    }






   


}