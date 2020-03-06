<?php
namespace app\api\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;
use think\Cache;

class Openmsssc extends Command
{
    protected function configure()
    {
        $this->setName('openmsssc')->setDescription('极速时时彩开奖');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    /**
     *极速时时彩生成开奖号
     */
    public function doCron(){
        $now = time();
        $find = Db::name('msssc_stage')->where('end_time','<=',$now)->order('end_time desc')->find();
        $setting = Db::name('setting')->cache(60)->find();
        if($find && empty($find['number'])){
            $find2 = Db::name('at_msssc')->where('stage',$find['stage'])->find();
            if(empty($find2)){
                if(empty($find['number'])){
                    if(!empty($find['number1'])){
                        $number = $find['number1'];
                    }else{
                        if($setting['msssc_is_win']){
                            while (1) {
                                $number = $this->rand_number();
                                $win_loss = $this->win_loss($find['stage'],$number);
                                if($win_loss==1 || $win_loss==2){
                                    break;
                                }else{
                                    continue;
                                }
                            }
                        }else{
                            $number = $this->rand_number();
                        }
                    }
                    $newNum[$find['stage']]['number'] = $number;
                    $newNum[$find['stage']]['dateline'] = $find['end_time'];
                    Cache::set('number_msssc', $newNum);
                    Db::name('msssc_stage')->where('stage',$find['stage'])->update(['number'=>$number]);
                    Db::name('at_msssc')->insert(['stage'=>$find['stage'],'number'=>$number,'dateline'=>date("Y-m-d H:i:s"),'create_time'=>date("Y-m-d H:i:s")]);
                }
            }
        }
    }
    public function rand_number(){
        $arr = [];
        for($i=0;$i<5;$i++){
            $one = rand(0,9);
            $arr[] = $one;
        }
        return implode(',', $arr);
    }
    public function win_loss($stage,$number){
        $w['s.cate'] = 7;
        $w['s.stage'] = $stage;
        $w['s.state'] = 0;
        $w['s.is_del'] = 0;
        $list = Db::name('single')
            ->alias('s')
            ->where($w)
            ->join('dl_bet b', 's.type=b.type')
            ->join('dl_member m', 's.uid=m.id')
            ->field('s.id,s.stage,s.cate,s.hall,s.type,s.uid,s.number,s.money,s.z_money,s.multiple,s.notes,s.wei,s.denomination,s.odds,s.is_zhui,s.group,s.is_check,b.title,m.gm_name,m.is_proxy,m.proxy_id,m.proxy_ids,m.rebate,m.bonus,m.proxy_rebate,m.proxy_bonus')
            ->select();
        if ($list) {
            $bet_total = 0;
            $win_total = 0;
            $number = explode(',', $number);
            foreach ($list as $v) {
                $returnData = array();//返回信息
                //计算赔率
                switch ($v['type']) {
                    case 1://总和-龙虎和
                        $returnData = cqsscZhlhh($v['number'], $number);
                        break;
                    case 2://第一球
                        $returnData = cqsscBall($v['number'], $number, $v['type']);
                        break;
                    case 3://第二球
                        $returnData = cqsscBall($v['number'], $number, $v['type']);
                        break;
                    case 4://第三球
                        $returnData = cqsscBall($v['number'], $number, $v['type']);
                        break;
                    case 5://第四球
                        $returnData = cqsscBall($v['number'], $number, $v['type']);
                        break;
                    case 6://第五球
                        $returnData = cqsscBall($v['number'], $number, $v['type']);
                        break;
                    case 7://前三
                        $returnData = cqsscQzhsan($v['number'], $number, $v['type']);
                        break;
                    case 8://中三
                        $returnData = cqsscQzhsan($v['number'], $number, $v['type']);
                        break;
                    case 9://后三
                        $returnData = cqsscQzhsan($v['number'], $number, $v['type']);
                        break;
                }
                $bet_total =bcadd($bet_total,$v['money'],2);
                if($returnData['win']){
                    $perMoney = $v['odds'];
                    $reMoney = $perMoney * $v['money'];
                    $win_total = bcadd($win_total,$reMoney,2);
                }
            }
            if($bet_total >= $win_total){
                return 1;
            }else{
                return 3;
            }
        }else{
            return 2;
        }
    }
}