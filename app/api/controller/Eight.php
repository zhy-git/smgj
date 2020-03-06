<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/11/6
 * Time: 10:33
 */

namespace app\api\controller;


use app\admin\model\Members;
use think\Db;
use think\Request;

class Eight extends Base
{
    /**
     * PC蛋蛋获取开奖接口
     */
    public function index(){
        $number = getNumberCache('eight');
        $stage= key($number); //获取最新一期的key（即期数）
        $numbers =$number[$stage]; //获取最新开奖号
        $number_arr_s = explode(',',$numbers['number']);
        $number_arr = getEightNum($number_arr_s);
        //计算下次期数 和 开间时间
        $ssc = setEightStageTime($stage,$numbers['dateline']);

        $total_number = array_sum($number_arr);
        $dx = eightDx($total_number); //判断大小
        $ds = eightDs($total_number);//判断单双
        $bo = eightBo($total_number)."波";//判断波色
        $detail = $total_number.",".$dx.",".$ds.","."--".",".$bo;

        $data = [
            'stage'=>$stage,
            'stage_next'=>$ssc['stage_next'],
            'number'=>$number_arr,
            'number_sum'=>array_sum($number_arr),
            'dateline'=>$ssc['dateline'],
            'lottery_time'=>$ssc['dateline']+30,
           // 'wei'=>config('lottery_wei.eight'),
            'detail'=>$detail
        ];
        json_return(200,'成功',$data);

    }

    /**
     * 获取开奖历史记录
     */
    public function trend(Request $request){

        $page    = $request->post('page')?$request->post('page'):1;

        $limit = 10;

        $start = ($page-1)*$limit;


        $number = Db::name('at_eight')
            ->limit($start,$limit)
            ->order('id desc')
            ->select();
        $total = Db::name('at_fast')->count();

        foreach ($number as $k=>$v){
            $number_arr_s = explode(',',$v['number']);

            $total_number = array_sum(getEightNum($number_arr_s));
            $dx = eightDx($total_number); //判断大小
            $ds = eightDs($total_number);//判断单双
            $bo = eightBo($total_number);//判断波色
            $detail = $total_number.",".$dx.",".$ds.","."--".",".$bo;

            $number[$k]['number']  = implode(',',getEightNum($number_arr_s));
            $number[$k]['detail']  = $detail;
        }
        $return_data['trend']    = $number;
        $return_data['now_page'] = $page;
        $return_data['per_page'] = $limit;
        $return_data['total_page'] = ceil($total/$limit);

        json_return(200,'成功',$return_data);

    }

    /**
     * 投注
     */
    public function betting(Request $request){
        $cate   = $request->post('cate_id');
        $uid    = $request->post('uid');
        $stage  = $request->post('stage');
        $zhu    = $request->post('zhu');
        $hall   = $request->post('hall');
        $list   = $request->post('list');
        $ip     = get_client_ip();

        if(!$uid || !$stage || !$zhu || !$hall ||!$list ||!$cate ){
            json_return(204,'缺少参数');
        }
        //获取会员信息
        $user = Members::get($uid);

        if($user['m_status']==1){
            json_return(201,'您的账号已被冻结!');
        }
        switch ($cate){
            case 1:
                $table_name = "at_eight";
                break;
            case 2:
                $table_name = "at_canada";
                break;
            case 3:
                $table_name = "at_car";
                break;
            case 4:
                $table_name = "at_airship";
                break;
            case 5:
                $table_name = "at_ssc";
                break;
            case 6:
                $table_name = "at_tjssc";
                break;
            case 7:
                $table_name = "at_gd10";
                break;
            case 8:
                $table_name = "at_cq10";
                break;
            case 9:
                $table_name = "at_fast";
                break;
            case 10:
                $table_name = "at_gd11";
                break;
            case 11:
                $table_name = "at_hk";
                break;

        }

        $is_stage = Db::name($table_name)->order('id desc')->find()['stage'];
        
        if($stage<=$is_stage){
            json_return(201,'已经开奖');
        }
        try {

            $list_d = json_decode($list, true);
        }catch (\Exception $e){
            json_return(201,'list格式不对');
        }

        if(!is_array($list_d)){

            json_return(201,'list格式不对');
        }

        $time = time();
        foreach ($list_d as $k=>$v){
            $money[] = $v['money'];
            $data[]=[
                'uid'   =>$uid,
                'stage' =>$stage,
                'cate'  =>$cate,
                'type'  =>$v['type'],
                'hall'  =>$hall,
                'number'=>$v['number'],
                'money' =>$v['money'],
                'ip'    =>$ip,
                'create_at'=>$time
            ];
    }
        $total_money = array_sum($money);
        if($total_money>$user->money){
            json_return(207,'余额不足');
        }

        Db::startTrans();
        try{
            Db('single')->insertAll($data);
            $moneys =  $user->money-($total_money);
            Db('member')->where('id',$uid)->update(['money'=>$moneys]);
            addDetail($uid,2,$total_money,$moneys,5,$cate,'期数'.$stage,$hall);
            Db::commit();
            json_return(200,'成功');
        } catch (\Exception $e) {
            Db::rollback();
            json_return(500,'失败');
        }


    }

    /**
     * 投注记录
     * @param Request $request
     */
    public function betting_records(Request $request){

        $uid     = $request ->post('uid');
        $cate    = $request ->post('cate_id');
        $start_p = $request ->post('start');
        $end_P   = $request ->post('end');
        $type    = $request ->post('type')?$request ->post('type'):1;
        $page    = $request ->post('page')?$request->post('page'):1;

        if(!$uid || !$cate || !$start_p || !$end_P  ){
            json_return(204,'缺少参数');
        }
        $limit = 20;
        $start = ($page-1)*$limit;

        $start_p = strtotime($start_p.' 00:00:00');
        $end_P   = strtotime($end_P.' 23:59:59');


        $condition['dl_single.uid']  = $uid;
        $condition['dl_single.cate'] = $cate;
        $condition['dl_single.create_at'] = array('between',[$start_p,$end_P]);

        if($type==1){//全部
           $data = Db::name('single')
               ->alias('s')
               ->field('s.id as id,c.name as name,b.title as title,number,code,open_number')
               ->join('dl_cate c','s.cate = c.id')
               ->join('dl_bet b','s.type = b.type and s.cate =b.cate')
               ->where($condition)
               ->limit($start,$limit)
               ->order('s.id desc')
               ->select();

        }
        if($type==2){//未开奖
            $condition['dl_single.state'] = 0;

            $data = Db::name('single')
                ->alias('s')
                ->field('s.id as id,c.name as name,b.title as title,number,code,open_number')
                ->join('dl_cate c','s.cate = c.id')
                ->join('dl_bet b','s.type = b.type and s.cate =b.cate')
                ->where($condition)
                ->limit($start,$limit)
                ->order('s.id desc')
                ->select();

        }
        if($type==3){//未中奖
            $condition['dl_single.state'] = 1;
            $condition['dl_single.code']  = 0;

            $data = Db::name('single')
                ->alias('s')
                ->field('s.id as id,c.name as name,b.title as title,number,code,open_number')
                ->join('dl_cate c','s.cate = c.id')
                ->join('dl_bet b','s.type = b.type and s.cate =b.cate')
                ->where($condition)
                ->limit($start,$limit)
                ->order('s.id desc')
                ->select();
        }
        if($type==4){//中奖
            $condition['dl_single.state'] = 1;
            $condition['dl_single.code']  = 1;

            $data = Db::name('single')
                ->alias('s')
                ->field('s.id as id,c.name as name,b.title as title,number,code,open_number')
                ->join('dl_cate c','s.cate = c.id')
                ->join('dl_bet b','s.type = b.type and s.cate =b.cate')
                ->where($condition)
                ->limit($start,$limit)
                ->order('s.id desc')
                ->select();
        }
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
     * 手动开奖
     */

    public function doCron(){
        $number = getNumberCache('eight'); //获取最新开奖号

        if($number) {
            $stage_num = key($number);//获取最新一期号
            $value = $number[$stage_num];
            $numbers = $value['number'];//获取最新开奖号
            $number_arr_s = explode(',',$numbers);
            $number_arr = getEightNum($number_arr_s);
            $he = array_sum($number_arr);
            $w['stage'] = $stage_num;
            $w['cate'] = 1;
            $w['state'] = 0;
            $w['code'] = 0;
            $list = Db::name('single')->where($w)->select();
            $explain ='';
            if($list) {
                $time = time();
                foreach ($list as $v){
                    $pl =0;
                    //计算赔率
                    switch ($v['type']){
                        case 1://大小单双
                            $dx = eightDx($he); //判断大小
                            $ds = eightDs($he);//判断单双
                            if($v['number'] == $dx){
                                if($v['number'] == '大'){
                                    $pl = 1;
                                }elseif ($v['number'] == '小'){
                                    $pl = 1;
                                }
                            }elseif($v['number'] == $ds){
                                if($v['number'] == '单'){
                                    $pl = 1;
                                }elseif ($v['number'] == '双'){
                                    $pl = 1;
                                }
                            }
                            $explain = $stage_num.'期大小单双中'.$v['number'];
                            break;
                        case 2://猜极大极小
                            if($he >=22 && $he<=27 && $v['number']=='极大'){
                                $pl = 1;
                            }elseif ($he >=0 && $he<=5 && $v['number']=='极小'){
                                $pl = 1;
                            }
                            $explain = $stage_num.'期极大极小中'.$v['number'];
                            break;
                        case 3://大单小单大双小双
                            $dx = eightDx($he); //判断大小
                            $ds = eightDs($he);//判断单双
                            if($v['number'] == $dx.$ds){
                                if($v['number'] == '大单'){
                                    $pl = 1;
                                }elseif($v['number'] == '小单'){
                                    $pl = 1;
                                }elseif($v['number'] == '大双'){
                                    $pl = 1;
                                }elseif($v['number'] == '小双'){
                                    $pl = 1;
                                }
                                $explain = $stage_num.'期猜大单小单大双小双中'.$v['number'];
                            }
                            break;

                        case 4://特码
                            if($he == $v['number']){
                                $pl = 1;
                                $explain = $stage_num.'期猜特码中'.$v['number'];
                            }
                            break;
                        case 5://豹子
                            if($number_arr[0]==$number_arr[1] && $number_arr[1]==$number_arr[2] && $number_arr[0]==$number_arr[2]){
                                $pl = 1;
                            }
                            $explain = $stage_num.'期猜豹子中'.$v['number'];
                            break;
                        case 6://对子
                            $arr_num = array_count_values($number_arr);
                            if(in_array(2,$arr_num)) {
                                $pl = 1;
                            }
                            $explain = $stage_num.'期猜对子中'.$v['number'];
                            break;
                        case 7://颜色
                            $color = eightBo($he);
                            if($color==$v['number']) {
                                $pl = 1;
                            }
                            $explain = $stage_num.'期猜颜色中'.$v['number'];
                            break;

                    }
                    $odd = getOdds($v['cate'],$v['hall'],$v['type'],$v['number']);
                    if(!$odd){
                        $content = $v['cate'].'---'.$v['type'].'---'.$v['hall'].'---'.$v['number'].'没有赔率';
                        file_put_contents('my_log.txt',$content.'\r\n"',8);
                    }
                    $open_number = implode(',',$number_arr);
                    if($pl){
                        Db::startTrans();
                        try{
                            $z_money = $v['money'] * $odd;
                            Db::name('single')->where('id',$v['id'])->update(['state'=>1,'code'=>1,'update_at'=>$time,'open_number'=>$open_number,'z_money'=>$z_money]);
                            Db::name('member')->where('id', $v['uid'])->setInc('money', $v['money'] * $odd);
                            $balance = Db::name('member')->where('id', $v['uid'])->value('money');
                            addDetail($v['uid'], 1, $v['money'] * $odd, $balance, 2, $v['cate'], $explain,$v['hall']);
                            Db::commit();
                        }catch (\Exception $e) {
                            Db::rollback();
                        }
                    }else{
                        Db::name('single')->where('id',$v['id'])->update(['state'=>1,'update_at'=>$time,'open_number'=>$open_number]);
                    }
                }
            }
        }
    }

    /**
     * 获取余额
     */

    public function get_balance(Request $request){
        $uid = $request->post('uid');
        $money = Db::name('member')->where(array('id'=>$uid))->value('money');
        $data['money'] = $money;
         json_return(200,'成功',$data);
        }
    }
