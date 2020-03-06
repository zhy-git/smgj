<?php
namespace app\admin\controller;



use think\Db;
use think\Request;
use app\admin\model\Detail;
use app\admin\model\Members;
use app\admin\model\Recharge;

class Index extends Admin
{
    public function index(Request $request){
        $from    = $request->param('from');
        $to      = $request->param('to');
        $w =[];
        if($from && $to){
            $from = strtotime($from);
            $to   = strtotime($to);
            $w['create_at'] = [['>=',$from],['<=',$to]];
        }
        $today = strtotime(date('Y-m-d'));
//        if(!$w){
//            $w['create_at'] = array('>',$today);
//        }

        //昨日留盘
        $yesterday = date("Y-m-d",strtotime("-1 day"));
        $yesterday_money = Db::name('balance')
            ->where(array('time'=>$yesterday))
            ->value('money');
        $back['yesterday_money'] = $yesterday_money;
        //今日留盘
        $today_money = Db::name('member')
            ->where($w)
            ->sum('money');
        $back['today_money'] = $today_money;
        //今日充值
        $today_recharge = Detail::where($w)
            ->where(array('exp'=>1))
            ->sum('money');
        $back['today_recharge'] = $today_recharge;
        //今日提现
        $today_tx = Db::name('withdrawals')
            ->where($w)
            ->sum('money');
        $back['today_tx'] = $today_tx;
        //今日佣金
        $today_yj = Detail::where($w)
            ->where(array('exp'=>4))
            ->sum('money');
        $back['today_yj '] = $today_yj ;
        //今日退水
        $today_ts = Detail::where($w)
            ->where('exp','in','3,6')
            ->sum('money');
        $back['today_ts'] = $today_ts;
        //今日微信
        $today_wx_charge = Db::name('recharge')
            ->where($w)
            ->where(array('way'=>1))
            ->sum('money');
        $today_wx_tx = Db::name('withdrawals')
            ->where($w)
            ->where(array('way'=>1))
            ->sum('money');
        $today_wx = $today_wx_charge-$today_wx_tx;
        $back['today_wx'] = $today_wx;
        //今日支付宝
        $today_pay_charge = Db::name('recharge')
            ->where($w)
            ->where(array('way'=>2))
            ->sum('money');
        $today_pay_tx = Db::name('withdrawals')
            ->where($w)
            ->where(array('way'=>2))
            ->sum('money');
        $today_pay = $today_pay_charge-$today_pay_tx;
        $back['today_pay'] = $today_pay;
        //今日银行
        $today_bank_charge = Db::name('recharge')
            ->where($w)
            ->where(array('way'=>3))
            ->sum('money');
        $today_bank_tx = Db::name('withdrawals')
            ->where($w)
            ->where(array('way'=>3))
            ->sum('money');
        $today_bank = $today_bank_charge-$today_bank_tx;
        $back['today_bank'] = $today_bank;
       //今日上分
        $today_up = Db::name('detail')
            ->where($w)
            ->where(array('exp'=>7,'type'=>2))
            ->sum('money');
        $back['today_up'] = $today_up;
        //今日下分
        $today_down = Db::name('detail')
            ->where($w)
            ->where(array('exp'=>7,'type'=>1))
            ->sum('money');
        $back['today_down'] = $today_down;

        //今日盈利
        $win_lose = $today_recharge-$today_tx-($today_money-$yesterday_money);
        $back['win_lose'] = $win_lose;
        //PC蛋蛋
        $pc = Db::name('single')
            ->field('cate,sum(money-z_money) as total')
            ->where($w)
            ->group('cate')
            ->select();
        $back['pc_money'] = 0.00;
        $back['canada_money'] = 0.00;
        $back['car_money'] = 0.00;
        $back['ship_money'] = 0.00;
        $back['ssc_money'] = 0.00;
        $back['tjssc_money'] = 0.00;
        $back['gd10_money'] = 0.00;
        $back['cq10_money'] = 0.00;
        $back['fast_money'] = 0.00;
        $back['gd11_money'] = 0.00;
        $back['hk_money'] = 0.00;

        foreach($pc as $k=>$v){
            switch($v['cate']){
                case 1:
                    $back['pc_money']   = $v['total'];
                    break;
                case 2:
                    $back['canada_money'] = $v['total'];
                    break;
                case 3:
                    $back['car_money'] = $v['total'];
                    break;
                case 4:
                    $back['ship_money'] = $v['total'];
                    break;
                case 5:
                    $back['ssc_money'] = $v['total'];
                    break;
                case 6:
                    $back['tjssc_money'] = $v['total'];
                    break;
                case 7:
                    $back['gd10_money'] = $v['total'];
                    break;
                case 8:
                    $back['cq10_money'] = $v['total'];
                    break;
                case 9:
                    $back['fast_money'] = $v['total'];
                    break;
                case 10:
                    $back['gd11_money'] = $v['total'];
                    break;
                case 11:
                    $back['hk_money'] = $v['total'];
                    break;
            }
        }
        $back['ag_money'] = 0.00;
        $back['bb_money'] = 0.00;
        $back['all_money'] = 0.00;




        return view('',[
          'back'=>$back
        ]);
//        $from    = $request->param('from');
//        $to      = $request->param('to');
//        $id      = $request->param('uid');
//        $mobile  = $request->param('mobile');
//        $w =[];
//        $uid = "";
//        if($from && $to){
//            $from = strtotime($from);
//            $to   = strtotime($to);
//            $w['create_at'] = [['>=',$from],['<=',$to]];
//        }
//        if($id){
//            $w['uid']  = $id;
//            $uid  = $id;
//        }
//        if($mobile){
//            $Members = new Members();
//            $uid = $Members->get_mobile_id($mobile);
//            if(!$uid){
//                $this->error_new('用户不存在');
//            }else{
//                $w['uid']  = $uid;
//            }
//        }
//        //总投注
//        $betting_total = Detail::where($w)
//            ->where(array('exp'=>5))
//            ->sum('money');
//
//
//        //总中奖
//        $winning_total = Detail::where($w)
//            ->where(array('exp'=>2))
//            ->sum('money');
//        //总回水
//        $back_total = Detail::where($w)
//            ->where(array('exp'=>3))
//            ->sum('money');
//        //总流水
//        $flow_total = Detail::where($w)
//            ->where(array('exp'=>6))
//            ->sum('money');
//        //总代理回水
//        $d_back_total = Detail::where($w)
//            ->where(array('exp'=>4))
//            ->sum('money');
//        $up_total = Detail::where($w)
//            ->where(array('type'=>2,'exp'=>7))
//            ->sum('money');
//        $down_total = Detail::where($w)
//            ->where(array('type'=>1,'exp'=>7))
//            ->sum('money');
//
//        //总充值
//        $recharge_total = Recharge::where($w)
//            ->where('status','in','1,2')
//            ->sum('money');
//
//        //总提现
//        $withdrawals_total = Db::name('withdrawals')->where($w)
//            ->where('status','in','1,2')
//            ->sum('money');
//        if($uid) {
//            $profit = $winning_total + $back_total + $flow_total + $d_back_total - $betting_total;
//        }else{
//            $profit = $betting_total - $winning_total - $back_total - $flow_total - $d_back_total;
//        }
//
//        $profit            = number_format($profit,2);
//        $betting_total     = number_format($betting_total,2);
//        $winning_total     = number_format($winning_total,2);
//        $flow_total        = number_format($flow_total,2);
//        $d_back_total      = number_format($d_back_total,2);
//        $back_total        = number_format($back_total,2);
//        $recharge_total    = number_format($recharge_total,2);
//        $withdrawals_total = number_format($withdrawals_total,2);
//        $up_total          = number_format($up_total,2);
//        $down_total        = number_format($down_total,2);
//        if($profit>0){
//            $now_profit = "+".$profit;
//        }elseif ($profit<0){
//            $now_profit = $profit;
//        }else{
//            $now_profit=0.00;
//            $now_profit            = number_format($now_profit,2);
//        }
//        return view('',[
//            'profit'=> $now_profit,
//            'betting_total' =>$betting_total,
//            'winning_total'=>$winning_total,
//            'back_total' =>$back_total,
//            'flow_total'=>$flow_total,
//            'd_back_total' =>$d_back_total,
//            'recharge_total'=>$recharge_total,
//            'withdrawals_total'=> $withdrawals_total,
//            'up_total'=>$up_total,
//            'down_total'=> $down_total,
//        ]);
    }
    public function index_bak()
    {
        $sys_info = $this->get_sys_info();
        $this->assign('sys_info',$sys_info);
        return view();
    }

    /**
     * 获取系统信息
     */
    public function get_sys_info(){
        $sys_info['os']             = PHP_OS;
        $sys_info['zlib']           = function_exists('gzclose') ? 'YES' : 'NO';//zlib
        $sys_info['safe_mode']      = (boolean) ini_get('safe_mode') ? 'YES' : 'NO';//safe_mode = Off
        $sys_info['timezone']       = function_exists("date_default_timezone_get") ? date_default_timezone_get() : "no_timezone";
        $sys_info['curl']           = function_exists('curl_init') ? 'YES' : 'NO';
        $sys_info['web_server']     = $_SERVER['SERVER_SOFTWARE'];
        $sys_info['phpv']           = phpversion();
        $sys_info['ip']             = GetHostByName($_SERVER['SERVER_NAME']);
        $sys_info['fileupload']     = @ini_get('file_uploads') ? ini_get('upload_max_filesize') :'unknown';
        $sys_info['max_ex_time']    = @ini_get("max_execution_time").'s'; //�ű����ִ��ʱ��
        $sys_info['set_time_limit'] = function_exists("set_time_limit") ? true : false;
        $sys_info['domain']         = $_SERVER['HTTP_HOST'];
        $sys_info['memory_limit']   = ini_get('memory_limit');
        $sys_info['version']        = '1.1.0';
        //$mysqlinfo = Db::query("SELECT VERSION() as version");
        $sys_info['mysql_version']  = 5.4;
        if(function_exists("gd_info")){
            $gd = gd_info();
            $sys_info['gdinfo']     = $gd['GD Version'];
        }else {
            $sys_info['gdinfo']     = "δ֪";
        }
        return $sys_info;
    }
}
