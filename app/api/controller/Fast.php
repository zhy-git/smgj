<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/11/4
 * Time: 16:20
 */

namespace app\api\controller;


use app\admin\model\Members;
use think\Db;
use think\Request;

class Fast extends Home
{
    public function index(){
        $number = getNumberCache('fast');

        $stage= key($number); //获取最新一期的key（即期数）
        $numbers =$number[$stage]; //获取最新开奖号
        $number_arr = explode(',',$numbers['number']);
        $he = array_sum($number_arr); //和
        $dx = FastDx($he);//判断大小
        $detail = $he.",".$dx;
        //计算下次期数 和 开间时间
        $ssc = setFastStageTime($stage);
        $data = [
            'stage'=>$stage,
            'stage_next'=>$ssc['stage_next'],
            'number'=>$number_arr,
            'number_sum'=>array_sum($number_arr),
            'dateline'=>$ssc['dateline'],
            'lottery_time'=>$ssc['dateline']+30,
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
        
        $number = Db::name('at_fast')
            ->limit($start,$limit)
            ->order('id desc')
            ->select();
        $total = Db::name('at_fast')->count();

        foreach ($number as $k=>$v){
            $number_arr_s = explode(',',$v['number']);

            $he = array_sum($number_arr_s); //和
            $dx = FastDx($he);//判断大小
            $detail = $he.",".$dx;
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
        $number = getNumberCache('fast'); //获取最新开奖号
        if($number) {
            $stage_num = key($number);//获取最新一期号
            $value = $number[$stage_num];
            $numbers = $value['number'];//获取最新开奖号
            $number_arr = explode(',', $numbers);
            $w['stage'] = $stage_num;
            $w['cate']  = 9;
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
                            $he = array_sum($number_arr);

                            $dx = FastDx($he);
                            if($v['number']==$dx) {
                                $pl=1;
                                $explain = $stage_num . '期大小单双中' . $v['number'];
                            }
                            break;
                        case 2://点数
                            $he = array_sum($number_arr);
                            if($v['number'] == $he){
                                $pl = 1;
                                $explain = $stage_num.'期点数选中'.$v['number'];
                            }
                            break;
                        case 3://围骰

                            $number_str = implode('', $number_arr);
                            if($v['number']==$number_str){
                                $pl = 1;
                                $explain = $stage_num.'期围骰中'.$v['number'];
                            }
                            break;
                        case 4://短牌
                            sort($number_arr);
                            $number_str = implode('', $number_arr);
                            if(stripos($number_str,$v['number']) != false){
                                $pl = 1;
                                $explain = $stage_num.'期短牌中'.$v['number'];
                            }
                            break;
                        case 5://长牌
                            sort($number_arr);
                            $number_str = implode('', $number_arr);
                            if(stripos($number_str,$v['number']) != false){
                                $pl = 1;
                                $explain = $stage_num.'期长牌中'.$v['number'];
                            }
                            break;
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