<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/9/25
 * Time: 14:03
 */

namespace app\home\controller;
use app\api\command\Numbers;
use think\Request;
use think\Cache;
use think\Db;

class Api
{
    //检查是否开奖
    public function checkOpenCqSsc(Request $request){
        $stage= $request->post('stage');
        set_time_limit(0);//无限请求超时时间
        //while (true) {
            $number = getNumberCache('cqssc'); //获取最新开奖号
            if($number){
                $stage_new = key($number); //获取最新一期的key（即期数）
                if($stage_new == $stage){
                    $pick = setCqSscStageTime();
                    $numbers =$number[$stage]; //获取最新开奖号
                    //$number_arr = explode(',',$numbers['number']);
                    $arr = [
                        'status'=>1,
                        'stage'=>$stage,
                        'number'=>$numbers['number'],
                        'stage_next' => $pick['stage_next'],
                        'time_next' => date('H:i',$pick['dateline']),
                        'dateline' => $pick['dateline'],
                        //'lh' => sscLh($number_arr),
                        //'dx' => sscDx(array_sum($number_arr)),
                        //'ds' => sscDs(array_sum($number_arr)),
                    ];
                    exit(json_encode($arr));
                }
            }
            $arr = [
                'status'=>0,
            ];
            exit(json_encode($arr));
        //}
    }
    public function checkOpenCar(Request $request){
        $stage= $request->post('stage');
        set_time_limit(0);//无限请求超时时间
        //while (true) {
            $number = getNumberCache('car'); //获取最新开奖号
            if($number){
                $stage_new = key($number); //获取最新一期的key（即期数）
                if($stage_new == $stage){
                    $numbers =$number[$stage]; //获取最新开奖号
                    $pick = setCarStageTime();
                    //$number_arr = explode(',',$numbers['number']);
                    $arr = [
                        'status'=>1,
                        'stage'=>$stage,
                        'number'=>$numbers['number'],
                        'stage_next' => $pick['stage_next'],
                        'time_next' => date('H:i',$pick['dateline']),
                        'dateline' => $pick['dateline'],
                        //'dx' => carDx($number_arr[0] + $number_arr[1]),
                        //'ds' => sscDs($number_arr[0] + $number_arr[1]),
                    ];
                    echo json_encode($arr);
                    exit();
                }
            }
            $arr = [
                'status'=>0,
            ];
            exit(json_encode($arr));
        //}
    }
    public function checkOpenXyft(Request $request){
        $stage= $request->post('stage');
        set_time_limit(0);//无限请求超时时间
        $number = getNumberCache('xyft'); //获取最新开奖号
        if($number){
            $stage_new = key($number); //获取最新一期的key（即期数）
            if($stage_new == $stage){
                $numbers =$number[$stage]; //获取最新开奖号
                $pick = setXyftStageTime();
                $arr = [
                    'status'=>1,
                    'stage'=>$stage,
                    'number'=>$numbers['number'],
                    'stage_next' => $pick['stage_next'],
                    'time_next' => date('H:i',$pick['dateline']),
                    'dateline' => $pick['dateline'],
                ];
                echo json_encode($arr);
                exit();
            }
        }
        $arr = [
            'status'=>0,
        ];
        exit(json_encode($arr));
    }
    public function checkOpenMssc(Request $request){
        $stage= $request->post('stage');
        set_time_limit(0);//无限请求超时时间
        $number = getNumberCache('mssc'); //获取最新开奖号
        if($number){
            $stage_new = key($number); //获取最新一期的key（即期数）
            if($stage_new == $stage){
                $numbers =$number[$stage]; //获取最新开奖号
                $pick = setMsscStageTime();
                $arr = [
                    'status'=>1,
                    'stage'=>$stage,
                    'number'=>$numbers['number'],
                    'stage_next' => $pick['stage_next'],
                    'time_next' => date('H:i',$pick['dateline']),
                    'dateline' => $pick['dateline'],
                ];
                echo json_encode($arr);
                exit();
            }
        }
        $arr = [
            'status'=>0,
        ];
        exit(json_encode($arr));
    }
    public function checkOpenMsssc(Request $request){
        $stage= $request->post('stage');
        set_time_limit(0);//无限请求超时时间
        $number = getNumberCache('msssc'); //获取最新开奖号
        if($number){
            $stage_new = key($number); //获取最新一期的key（即期数）
            if($stage_new == $stage){
                $numbers =$number[$stage]; //获取最新开奖号
                $pick = setMssscStageTime();
                $arr = [
                    'status'=>1,
                    'stage'=>$stage,
                    'number'=>$numbers['number'],
                    'stage_next' => $pick['stage_next'],
                    'time_next' => date('H:i',$pick['dateline']),
                    'dateline' => $pick['dateline'],
                ];
                echo json_encode($arr);
                exit();
            }
        }
        $arr = [
            'status'=>0,
        ];
        exit(json_encode($arr));
    }
    public function checkOpenJsks(Request $request){
        $stage= $request->post('stage');
        set_time_limit(0);//无限请求超时时间
        $number = getNumberCache('jsks'); //获取最新开奖号
        if($number){
            $stage_new = key($number); //获取最新一期的key（即期数）
            if($stage_new == $stage){
                $numbers =$number[$stage]; //获取最新开奖号
                $pick = setMssscStageTime();
                $arr = [
                    'status'=>1,
                    'stage'=>$stage,
                    'number'=>$numbers['number'],
                    'stage_next' => $pick['stage_next'],
                    'time_next' => date('H:i',$pick['dateline']),
                    'dateline' => $pick['dateline'],
                ];
                echo json_encode($arr);
                exit();
            }
        }
        $arr = [
            'status'=>0,
        ];
        exit(json_encode($arr));
    }
    public function checkOpenPcdd(Request $request){
        $stage= $request->post('stage');
        set_time_limit(0);//无限请求超时时间
        $number = getNumberCache('pcdd'); //获取最新开奖号
        if($number){
            $stage_new = key($number); //获取最新一期的key（即期数）
            if($stage_new == $stage){
                $numbers =$number[$stage]; //获取最新开奖号
                $pick = setPcddStageTime();
                $arr = [
                    'status'=>1,
                    'stage'=>$stage,
                    'number'=>$numbers['number'],
                    'stage_next' => $pick['stage_next'],
                    'time_next' => date('H:i',$pick['dateline']),
                    'dateline' => $pick['dateline'],
                ];
                echo json_encode($arr);
                exit();
            }
        }
        $arr = [
            'status'=>0,
        ];
        exit(json_encode($arr));
    }
    public function checkOpenJndeb(Request $request){
        $stage= $request->post('stage');
        set_time_limit(0);//无限请求超时时间
        $number = getNumberCache('jndeb'); //获取最新开奖号
        if($number){
            $stage_new = key($number); //获取最新一期的key（即期数）
            if($stage_new == $stage){
                $numbers =$number[$stage]; //获取最新开奖号
                $pick = setJndebStageTime();
                $arr = [
                    'status'=>1,
                    'stage'=>$stage,
                    'number'=>$numbers['number'],
                    'stage_next' => $pick['stage_next'],
                    'time_next' => date('H:i',$pick['dateline']),
                    'dateline' => $pick['dateline'],
                ];
                echo json_encode($arr);
                exit();
            }
        }
        $arr = [
            'status'=>0,
        ];
        exit(json_encode($arr));
    }
    public function checkOpenGdsyxw(Request $request){
        $stage= $request->post('stage');
        set_time_limit(0);//无限请求超时时间
        $number = getNumberCache('gdsyxw'); //获取最新开奖号
        if($number){
            $stage_new = key($number); //获取最新一期的key（即期数）
            if($stage_new == $stage){
                $numbers =$number[$stage]; //获取最新开奖号
                $pick = setMssscStageTime();
                $arr = [
                    'status'=>1,
                    'stage'=>$stage,
                    'number'=>$numbers['number'],
                    'stage_next' => $pick['stage_next'],
                    'time_next' => date('H:i',$pick['dateline']),
                    'dateline' => $pick['dateline'],
                ];
                echo json_encode($arr);
                exit();
            }
        }
        $arr = [
            'status'=>0,
        ];
        exit(json_encode($arr));
    }
    public function checkOpenXync(Request $request){
        $stage= $request->post('stage');
        set_time_limit(0);//无限请求超时时间
        $number = getNumberCache('xync'); //获取最新开奖号
        if($number){
            $stage_new = key($number); //获取最新一期的key（即期数）
            if($stage_new == $stage){
                $numbers =$number[$stage]; //获取最新开奖号
                $pick = setMssscStageTime();
                $arr = [
                    'status'=>1,
                    'stage'=>$stage,
                    'number'=>$numbers['number'],
                    'stage_next' => $pick['stage_next'],
                    'time_next' => date('H:i',$pick['dateline']),
                    'dateline' => $pick['dateline'],
                ];
                echo json_encode($arr);
                exit();
            }
        }
        $arr = [
            'status'=>0,
        ];
        exit(json_encode($arr));
    }
    public function checkOpenXglhc(Request $request){
        $stage= $request->post('stage');
        set_time_limit(0);//无限请求超时时间
        $number = getNumberCache('xglhc'); //获取最新开奖号
        if($number){
            $stage_new = key($number); //获取最新一期的key（即期数）
            if($stage_new == $stage){
                $numbers =$number[$stage]; //获取最新开奖号
                $pick = setXglhcStageTime();
                $arr = [
                    'status'=>1,
                    'stage'=>$stage,
                    'number'=>$numbers['number'],
                    'stage_next' => $pick['stage_next'],
                    'time_next' => date('H:i',$pick['dateline']),
                    'dateline' => $pick['dateline'],
                ];
                echo json_encode($arr);
                exit();
            }
        }
        $arr = [
            'status'=>0,
        ];
        exit(json_encode($arr));
    }
    public function checkWinMessage(Request $request){
        $message = Cache::pull('win_push_'.session('member_info.uid'));
        if($message){
            $whereData['id'] = array('in',$message);
            $pushData = Db::name('push')->where($whereData)->select();
            $arr = [
                'status'=>1,
                'data'=>$pushData
            ];
        }else{
            $arr = ['status'=>0];
        }
        exit(json_encode($arr));
    }
    public function numbers(){
        $obj = new Numbers;
        $obj->doCron();
    }
}
