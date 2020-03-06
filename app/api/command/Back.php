<?php
namespace app\api\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Back extends Command
{
    protected function configure()
    {
        $this->setName('back')->setDescription('回水');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    /**
     * 回水、流水代理回水记录
     */

    public function doCron(){
        $setting_info = Db::name('setting')->select()[0];
        $today = strtotime(date('Y-m-d').'00:00:00');
        $w = [];
        $w['d.create_at'] = ['>',$today];
        $w['d.exp'] =5;
        //投注回水
        if($setting_info['is_watter_back']){
            $data = Db::name('detail')
                ->alias('d')
                ->field('uid,cate,hall,sum(money) as total')
                ->where($w)
                ->group('uid,cate,hall')
                ->order('uid asc')
                ->select();
            foreach ($data as $k=>$v){
                $winning_w['uid']    =$v['uid'];
                $winning_w['cate']   =$v['cate'];
                $winning_w['hall']   =$v['hall'];
                $winning_w['exp']    =2;
                $winning_w['create_at']   = ['>',$today];
                $win_money  = Db::name('detail')->where($winning_w)->sum('money');
                $lose = $v['total']-$win_money;
                if($lose>0) {
                    $ww['cate'] = $v['cate'];
                    $ww['hall'] = $v['hall'];
                    $ww['from'] = ['<=', $lose];
                    $ww['to'] = ['>=', $lose];
                    $user_data = Db::name('member')->where(array('id' => $v['uid']))->find();
                    $back_data = Db::name('water')->where($ww)->find();
                    if ($back_data) {
                        $percent    = $back_data['back_water'];
                        $back_money = $lose * $percent;
                        $my_money   = $user_data['money'] + round($back_money, 3);
                        $this->add_back_detail($v['uid'], $back_money, $my_money, $v['cate'], $v['hall'],3,0,$setting_info['is_examine']);
                    }
                }
            }
        }
        //投注流水
        if($setting_info['is_watter_flow']){//投注流水
            $data = Db::name('detail')
                ->alias('d')
                ->field('uid,cate,hall,sum(money) as total')
                ->where($w)
                ->group('uid,cate,hall')
                ->order('uid asc')
                ->select();
            foreach ($data as $k=>$v){
                $ww['cate'] = $v['cate'];
                $ww['hall'] = $v['hall'];
                $ww['from'] = ['<=', $v['total']];
                $ww['to']   = ['>=', $v['total']];
                $user_data = Db::name('member')->where(array('id' => $v['uid']))->find();
                $back_data = Db::name('water')->where($ww)->order('id asc')->find();
                if ($back_data) {
                    $percent    = $back_data['flow_water'];
                    $back_money = $v['total'] * $percent;
                    $my_money   = $user_data['money'] + round($back_money, 3);
                    $this->add_back_detail($v['uid'], $back_money, $my_money, $v['cate'], $v['hall'],6,0,$setting_info['is_examine']);
                }
            }
        }
        //代理回水
        $w['m.tid']=['gt',0];
        $data = Db::name('detail')
            ->alias('d')
            ->field('uid,sum(d.money) as total,tid')
            ->join('dl_member m','d.uid = m.id')
            ->where($w)
            ->group('uid')
            ->select();

        foreach ($data as $k=>$v){
            $user_data = Db::name('member')->where(array('id' => $v['uid']))->find();
            $back_data = Db::name('setting')->select()[0];
            if ($back_data['re_back']) {
                $percent    = $back_data['re_back'];
                $back_money = $v['total'] * $percent;
                $my_money   = $user_data['money'] + round($back_money, 3);
                $this->add_back_detail($v['tid'], $back_money, $my_money, 1, 1,4,$v['uid'],0);
            }
        }
    }

    /**
     * 添加记录
     */

    public function add_back_detail($uid,$money,$my_money,$cate,$hall,$exp,$tid="",$is_check=""){
        $date = date("Ymd");
        if($exp==3){
            $explain = $date.'投注回水';
        }elseif ($exp==6){
            $explain = $date.'投注流水';
        }elseif ($exp==4) {
            $explain = $date.'代理回水';
        }
        $up_data["money"] = $my_money;
        if(!$is_check) {
            Db::name('member')->where(array('id' => $uid))->update($up_data);
        }
        if($tid){
            $save['proxy_uid'] = $tid;
        }
        if($is_check){
            $save['status'] = 1;
        }
        $save['uid']     =  $uid;
        $save['type']    = 1;
        $save['money']   = $money;
        $save['balance'] = $my_money;
        $save['exp']     = $exp;
        $save['explain'] =  $explain;
        $save['cate']    =  $cate;
        $save['hall']    =  $hall;
        $save['create_at'] = time();
        $result = Db::name('detail')->insert($save);
    }
}