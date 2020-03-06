<?php
namespace app\api\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;
use think\Cache;

class Openmssc extends Command
{
    protected function configure()
    {
        $this->setName('openmssc')->setDescription('极速赛车开奖');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    /**
     *极速赛车生成开奖号
     */
    public function doCron(){
        $fileName = __DIR__.'/openmssc_lock.txt';
        $fp = fopen($fileName, "r");
        if(flock($fp,LOCK_EX | LOCK_NB)) {
            $now = time();
            $find = Db::name('mssc_stage')->where('end_time','<=',$now)->order('end_time desc')->find();
            $setting = Db::name('setting')->cache(60)->find();
            if($find && empty($find['number'])){
                $find2 = Db::name('at_mssc')->where('stage',$find['stage'])->find();
                if(empty($find2)){
                    if(empty($find['number'])){
                        if(!empty($find['number1'])){
                            $number = $find['number1'];
                        }else{
                            if($setting['mssc_is_win']){
                                while (1) {
                                    $number = $this->rand_number();
                                    $win_loss = $this->win_loss($find['stage'],$number);
                                    dump($win_loss);
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
                        Cache::set('number_mssc', $newNum);
                        Db::name('mssc_stage')->where('stage',$find['stage'])->update(['number'=>$number]);
                        Db::name('at_mssc')->insert(['stage'=>$find['stage'],'number'=>$number,'dateline'=>date("Y-m-d H:i:s"),'create_time'=>date("Y-m-d H:i:s")]);
                    }
                }
            }
            flock($fp,LOCK_UN);
        }
        fclose($fp);
    }
    public function rand_number(){
        $arr = [];
        while(count($arr)<10)
        {
            $arr[]=rand(1,10);
            $arr=array_unique($arr);
        }
        return implode(',', $arr);
    }
    public function win_loss($stage,$number){
        $w['s.cate'] = 6;
        $w['s.stage'] = $stage;
        $w['s.state'] = 0;
        $w['s.is_del'] = 0;
        $list = Db::name('single')
            ->alias('s')
            ->where($w)
            ->join('dl_bet b', 's.type=b.type and s.cate=b.cate')
            ->join('dl_member m', 's.uid=m.id')
            ->join('dl_mssc_stage j','s.stage=j.stage')
            ->field('s.id,s.stage,s.cate,s.hall,s.type,s.uid,s.number,s.money,s.z_money,s.multiple,s.notes,s.wei,s.denomination,s.odds,b.title,m.gm_name,m.is_proxy,m.proxy_id,m.proxy_ids,m.rebate,m.bonus,m.proxy_rebate,m.proxy_bonus')
            ->select();
        if ($list) {
            $bet_total = 0;
            $win_total = 0;
            $number = explode(',', $number);
            foreach ($list as $v) {
                $returnData = array();//返回信息
                //计算赔率
                switch ($v['type']) {
                    case 1://冠亚军和
                        $returnData = carZhgyj($v['number'], $number);
                        break;
                    case 2://冠军
                        $returnData = carBall($v['number'], $number, $v['type']);
                        break;
                    case 3://亚军
                        $returnData = carBall($v['number'], $number, $v['type']);
                        break;
                    case 4://第三名
                        $returnData = carBall($v['number'], $number, $v['type']);
                        break;
                    case 5://第四名
                        $returnData = carBall($v['number'], $number, $v['type']);
                        break;
                    case 6://第五名
                        $returnData = carBall($v['number'], $number, $v['type']);
                        break;
                    case 7://第六名
                        $returnData = carBall($v['number'], $number, $v['type']);
                        break;
                    case 8://第七名
                        $returnData = carBall($v['number'], $number, $v['type']);
                        break;
                    case 9://第八名
                        $returnData = carBall($v['number'], $number, $v['type']);
                        break;
                    case 10://第九名
                        $returnData = carBall($v['number'], $number, $v['type']);
                        break;
                    case 11://第十名
                        $returnData = carBall($v['number'], $number, $v['type']);
                        break;
                }
                $bet_total =bcadd($bet_total,$v['money'],2);
                if($returnData['win']){
                    $reMoney = $v['odds'] * $v['money'];
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