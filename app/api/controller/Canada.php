<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/11/6
 * Time: 10:33
 */

namespace app\api\controller;


use app\admin\model\Members;
use think\Controller;
use think\Db;
use think\Request;

class Canada extends Controller
{
    /**
     * 加拿大28获取开奖接口
     */
    public function index(){
        $number = getNumberCache('canada');
        $stage= key($number); //获取最新一期的key（即期数）
        $numbers =$number[$stage]; //获取最新开奖号
        $number_arr_s = explode(',',$numbers['number']);
        $number_arr = getEightNum($number_arr_s);
        //计算下次期数 和 开间时间
        $ssc = setCanadaStageTime($stage,$numbers['dateline']);

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
           // 'wei'=>config('lottery_wei.canada'),
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


        $number = Db::name('at_canada')
            ->limit($start,$limit)
            ->order('id desc')
            ->select();
        $total = Db::name('at_canada')->count();
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
     * 手动开奖
     */
    public function doCron(){
        $number = getNumberCache('canada'); //获取最新开奖号
        if($number) {
            $stage_num = key($number);//获取最新一期号
            $value = $number[$stage_num];
            $numbers = $value['number'];//获取最新开奖号
            $number_arr_s = explode(',',$numbers);
            $number_arr = getEightNum($number_arr_s);
            $he = array_sum($number_arr);
            $w['stage'] = $stage_num;
            $w['cate']  = 2;
            $w['state'] = 0;
            $w['code']  = 0;
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
                    }
                    $odd = getOdds($v['cate'],$v['type'],$v['hall'],$v['number']);

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

  
}
