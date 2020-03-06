<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/11/4
 * Time: 14:21
 */

namespace app\api\controller;


use app\admin\model\Members;
use think\Db;
use think\Request;

class Airship extends Base
{

    /**
     * 获取开奖结果
     */
    public function index(){
        $number = getNumberCache('airship');
        $stage= key($number); //获取最新一期的key（即期数）
        $numbers =$number[$stage]; //获取最新开奖号
        $number_arr = explode(',',$numbers['number']);
        //计算下次期数 和 开间时间
        $ssc = setAirshipStageTime($stage,$numbers['dateline']);
        $ling = $number_arr[0]+$number_arr[1];//冠亚军和值
        $yi  = carDxWei($number_arr[1]); //判断大小
        $er  = carDs($number_arr[2]);//判断单双
        $san = longfu($number_arr[3],$number_arr[6]);//判断龙虎
        $si  = longfu($number_arr[4],$number_arr[5]);//判断龙虎
        $wu  = longfu($number_arr[5],$number_arr[4]);//判断龙虎
        $liu = longfu($number_arr[6],$number_arr[3]);//判断龙虎
        $qi  = longfu($number_arr[7],$number_arr[2]);//判断龙虎
        $detail = $ling.",".$yi.",".$er.",".$san.",". $si.",".$wu.",".$liu.",". $qi;
        $data = ['stage'=>$stage,
            'stage_next'=>$ssc['stage_next'],
            'number'=>$number_arr,
            'number_sum'=>$number_arr[0] + $number_arr[1],
            'dateline'=>$ssc['dateline'],
            'lottery_time'=>$ssc['dateline']+30,
           // 'wei'=>config('lottery_wei.car'),
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
        $number = Db::name('at_airship')
            ->limit($start,$limit)
            ->order('id desc')
            ->select();
        $total = Db::name('at_airship')->count();

        foreach ($number as $k=>$v){
            $number_arr = explode(',',$v['number']);
            $ling = $number_arr[0]+$number_arr[1];//冠亚军和值
            $yi  = carDxWei($number_arr[1]); //判断大小
            $er  = carDs($number_arr[2]);//判断单双
            $san = longfu($number_arr[3],$number_arr[6]);//判断龙虎
            $si  = longfu($number_arr[4],$number_arr[5]);//判断龙虎
            $wu  = longfu($number_arr[5],$number_arr[4]);//判断龙虎
            $liu = longfu($number_arr[6],$number_arr[3]);//判断龙虎
            $qi  = longfu($number_arr[7],$number_arr[2]);//判断龙虎
            $detail = $ling.",".$yi.",".$er.",".$san.",". $si.",".$wu.",".$liu.",". $qi;
            $number[$k]['detail']  = $detail;
        }
        $return_data['trend']    = $number;
        $return_data['now_page'] = $page;
        $return_data['per_page'] = $limit;
        $return_data['total_page'] = ceil($total/$limit);

        json_return(200,'成功',$return_data);
    }

    /**
     * 手动开奖
     */
    public function doCron(){
        $number = getNumberCache('airship'); //获取最新开奖号
        if($number) {
            $stage_num = key($number);//获取最新一期号
            $value = $number[$stage_num];
            $numbers = $value['number'];//获取最新开奖号
            $number_arr = explode(',', $numbers);
            $w['stage'] = $stage_num;
            $w['cate']  = 4;
            $w['state'] = 0;
            $w['code']  = 0;
            $list = Db::name('single')->where($w)->select();
            $explain ='';
            if($list) {
                $time = time();
                foreach ($list as $v){
                    $pl =0;
                    if($v['type']>=1 && $v['type']<=5){
                        $wei_number = $number_arr[$v['type']-1];
                        $dx = carDxWei($wei_number); //判断大小
                        $ds = carDs($wei_number);//判断单双
                        $longfu = longfu($wei_number,9-$wei_number);//判断龙虎
                        if($v['number']==$dx || $v['number']==$ds ||$v['number']==$longfu){
                            $pl = 1;
                            $explain = $stage_num.'期大小单双龙虎中'.$v['number'];
                        }
                    }elseif ($v['type']>=6 && $v['type']<=10){
                        $wei_number = $number_arr[$v['type']-1];
                        $dx = carDxWei($wei_number); //判断大小
                        $ds = carDs($wei_number);//判断单双
                        if($v['number']==$dx || $v['number']==$ds){
                            $pl = 1;
                            $explain = $stage_num.'期大小单双中'.$v['number'];
                        }

                    } elseif ($v['type']==11){
                        $wei_number = $number_arr[0]+$number_arr[1];
                        $dx = carDxWei($wei_number); //判断大小
                        $ds = carDs($wei_number);//判断单双
                        if($v['number']==$dx || $v['number']==$ds){
                            $pl = 1;
                            $explain = $stage_num.'期大小单双中'.$v['number'];
                        }
                    } elseif ($v['type']==12){
                        $wei_number = $number_arr[0]+$number_arr[1];
                        if($v['number']==$wei_number){
                            $pl = 1;
                            $explain = $stage_num.'期冠亚和值中'.$v['number'];
                        }
                    }elseif ($v['type']>=12 && $v['type']<=22){
                        $wei_number = $number_arr[$v['type']-13];
                        if($v['number']==$wei_number){
                            $pl = 1;
                            $explain = $stage_num.'期冠特码中'.$v['number'];
                        }
                    }
                    $odd = getOdds($v['cate'],$v['hall'],$v['type'],$v['number']);
                    if(!$odd){
                        $content = $v['cate'].'---'.$v['type'].'---'.$v['hall'].'---'.$v['number'].'没有赔率';
                        file_put_contents('my_log.txt',$content.'\r\n"',8);
                    }
                    $open_number = $numbers;
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


}