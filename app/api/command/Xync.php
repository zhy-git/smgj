<?php
namespace app\api\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;
use think\Cache;

class Xync extends Command
{
    protected function configure()
    {
        $this->setName('xync')->setDescription('幸运农场');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    /**
     *幸运农场
     */
    public function doCron(){
        $fileName = __DIR__.'/xync_lock.txt';
        $fp = fopen($fileName, "r");
        if(flock($fp,LOCK_EX | LOCK_NB)){
            //$w['s.stage'] = 20180208061;
            $w['s.cate'] = 10;
            $w['s.state'] = 0;
            $w['s.code'] = 0;
            $w['s.is_del'] = 0;

            $list = Db::name('single')
                ->alias('s')
                ->where($w)
                ->join('dl_bet b','s.type=b.type and s.cate=b.cate')
                ->join('dl_member m','s.uid=m.id')
                ->join('dl_at_xync a','s.stage=a.stage')
                ->field('s.id,s.stage,s.cate,s.type,s.uid,s.number,s.money,s.z_money,s.multiple,s.notes,s.wei,s.denomination,s.odds,b.title,m.gm_name,m.is_proxy,m.proxy_ids,m.rebate,m.bonus,m.proxy_rebate,m.proxy_bonus,a.number open_number')
                ->limit(1000)
                ->select();
            if($list) {
                $time = time();
                foreach ($list as $v){
                    try {
                        $returnData = array();//返回信息
                        $number_arr = explode(',', $v['open_number']);
                        //计算赔率
                        switch ($v['type']){
                            case 1://总和
                                $returnData = xyncZh($v['number'],$number_arr);
                                break;
                            case 2://第一球
                                $returnData = xyncBall($v['number'],$number_arr,$v['type']);
                                break;
                            case 3://第二球
                                $returnData = xyncBall($v['number'],$number_arr,$v['type']);
                                break;
                            case 4://第三球
                                $returnData = xyncBall($v['number'],$number_arr,$v['type']);
                                break;
                            case 5://第四球
                                $returnData = xyncBall($v['number'],$number_arr,$v['type']);
                                break;
                            case 6://第五球
                                $returnData = xyncBall($v['number'],$number_arr,$v['type']);
                                break;
                            case 7://第六球
                                $returnData = xyncBall($v['number'],$number_arr,$v['type']);
                                break;
                            case 8://第七球
                                $returnData = xyncBall($v['number'],$number_arr,$v['type']);
                                break;
                            case 9://第八球
                                $returnData = xyncBall($v['number'],$number_arr,$v['type']);
                                break;
                        }
                        if ($returnData['win']) {
                            $explain = '幸运农场' . $v['title'] . $v['stage'] . '期，中奖' . $returnData['win'] . '注';
                            //当前玩家每注奖金
                            $perMoney = $v['odds'];
                            $reMoney = $perMoney * $v['money'];
                            Db::startTrans();
                            try {
                                $singleUpdate = Db::name('single')->where('id', $v['id'])->update(['state' => 1, 'code' => 1, 'update_at' => $time, 'open_number' => $v['open_number'], 'z_money' => $reMoney]);
                                $updateData = array();
                                $updateData['money'] = array('exp','money+'.$reMoney);
                                $updateData['unpaid_money'] = array('exp','unpaid_money-'.$v['money']);
                                $memberUpdate = Db::name('member')->where('id', $v['uid'])->update($updateData);
                                $balance = Db::name('member')->where('id', $v['uid'])->value('money');
                                addDetail($v['uid'], 1, $reMoney, $balance, 2, $v['cate'], $explain,1,$v['id']);
                                //返点给上级
                                if($singleUpdate && $v['proxy_ids']){
                                    //计算当前玩法当前玩家每注奖金
                                    $whereData['id'] = array('in',$v['proxy_ids']);
                                    $memData = Db::name('member')->where($whereData)->field('id,gm_name,rebate,bonus,is_proxy')->order('rebate asc')->select();
                                    $nowRebate = $v['rebate'];
                                    foreach ($memData as $mk=>$mv){
                                        $checkData = array();
                                        if($mv['is_proxy']){
                                            $checkData['rebate'] = $nowRebate;
                                            $checkData['proxy_rebate'] = $mv['rebate'];
                                            $fanli = getFanli($checkData ,$v['money']);
                                            $nowRebate = $mv['rebate'];
                                            Db::name('member')->where('id', $mv['id'])->setInc('money', $fanli);
                                            $memd = Db::name('member')->where('id', $mv['id'])->field('money,gm_name')->find();
                                            addDetail($mv['id'], 1, $fanli, $memd['money'], 6, $v['cate'], $v['gm_name'].'用户投注返点',1,$v['id']);
                                        }
                                    }
                                }
                                if($singleUpdate && $memberUpdate){
                                    $isSuccess = 1;
                                    Db::commit();
                                }
                            } catch (\Exception $e) {
                                // 回滚事务
                                Db::rollback();
                                throw $e;
                                $isSuccess = 0;
                            }
                            if($isSuccess){
                                $pushInsertData['title'] = '中奖通知';
                                $pushInsertData['content'] = '幸运农场 第'.$v['stage'].'期 '.$v['title'].' '.$v['number'].' 已中奖,中奖金额<span>'.$reMoney.'</span>';
                                $pushId = Db::name('push')->insertGetId($pushInsertData);
                                if($pushId) {
                                    $winPush = Cache::get('win_push_'.$v['uid']);
                                    if ($winPush) {
                                        Cache::tag('win_push')->set('win_push_'.$v['uid'],$winPush.','.$pushId);
                                    }else{
                                        Cache::tag('win_push')->set('win_push_'.$v['uid'],$pushId);
                                    }
                                }
                            }
                        } else {
                            try {
                                if (isset($returnData['error_code'])) {
                                    $singleErrorAddData['single_id'] = $v['id'];
                                    $singleErrorAddData['error_code'] = $returnData['error_code'];
                                    $singleErrorAddData['create_time'] = time();
                                    $singleErrorAddData['cate'] = $v['cate'];
                                    Db::name('single_error')->insert($singleErrorAddData);
                                }
                                $updateData = array();
                                $updateData['unpaid_money'] = array('exp','unpaid_money-'.$v['money']);
                                $memberUpdate = Db::name('member')->where('id', $v['uid'])->update($updateData);
                                $singleUpdate = Db::name('single')->where('id', $v['id'])->update(['state' => 1, 'update_at' => $time, 'open_number' => $v['open_number']]);
                                //返点给上级
                                if($singleUpdate && $v['proxy_ids']){
                                    //计算当前玩法当前玩家每注奖金
                                    $whereData['id'] = array('in',$v['proxy_ids']);
                                    $memData = Db::name('member')->where($whereData)->field('id,gm_name,rebate,bonus,is_proxy')->order('rebate asc')->select();
                                    $nowRebate = $v['rebate'];
                                    foreach ($memData as $mk=>$mv){
                                        $checkData = array();
                                        if($mv['is_proxy']){
                                            $checkData['rebate'] = $nowRebate;
                                            $checkData['proxy_rebate'] = $mv['rebate'];
                                            $fanli = getFanli($checkData ,$v['money']);
                                            $nowRebate = $mv['rebate'];
                                            Db::name('member')->where('id', $mv['id'])->setInc('money', $fanli);
                                            $memd = Db::name('member')->where('id', $mv['id'])->field('money,gm_name')->find();
                                            addDetail($mv['id'], 1, $fanli, $memd['money'], 6, $v['cate'], $v['gm_name'].'用户投注返点',1,$v['id']);
                                        }
                                    }
                                }
                                if($singleUpdate && $memberUpdate){
                                    Db::commit();
                                }else{
                                    Db::rollback();
                                }
                            } catch (\Exception $e) {
                                Db::rollback();
                                throw $e;
                            }
                        }
                    } catch (\Exception $e) {
                        file_put_contents(__DIR__.'/xync_open.txt', $e.$v['id'].PHP_EOL,FILE_APPEND);
                        Db::name('single')->where('id', $v['id'])->update(['state' => 3, 'update_at' => $time, 'open_number' => $v['open_number']]);
                    }
                }
            }
            flock($fp,LOCK_UN);
        }
        fclose($fp);
    }
}