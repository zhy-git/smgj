<?php
namespace app\api\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;
use think\Cache;

class Xglhc extends Command
{
    protected function configure()
    {
        $this->setName('xglhc')->setDescription('香港六合彩兑奖');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }
    /**
     *香港六合彩开奖
     */
    public function doCron(){
        $fileName = __DIR__.'/xglhc_lock.txt';
        $fp = fopen($fileName, "r");
        if(flock($fp,LOCK_EX | LOCK_NB)) {
            //$w['s.stage'] = 20180208061;
            $w['s.cate'] = 8;
            $w['s.state'] = 0;
            $w['s.code'] = 0;
            $w['s.is_del'] = 0;
            $list = Db::name('single')
                ->alias('s')
                ->where($w)
                ->join('dl_bet b', 's.type=b.type and s.cate=b.cate')
                ->join('dl_member m', 's.uid=m.id')
                ->join('dl_at_xglhc a', 's.stage=a.stage')
                ->field('s.id,s.stage,s.cate,s.hall,s.type,s.uid,s.number,s.money,s.z_money,s.multiple,s.notes,s.wei,s.denomination,s.odds,b.title,m.gm_name,m.is_proxy,m.proxy_ids,m.rebate,m.back_rebate,m.bonus,m.proxy_rebate,m.proxy_bonus,a.number open_number')
                ->limit(1000)
                ->select();
            if ($list) {
                $time = time();
                foreach ($list as $v) {
                    try {
                        $returnData = array();//返回信息
                        $number_arr = explode(',', $v['open_number']);
                        //计算赔率
                        switch ($v['type']){
                            case 1://特码
                                $returnData = xglhcTm($v['number'], $number_arr);
                                break;
                            case 2:
                                $returnData = xglhcZm($v['number'], $number_arr);
//                                $returnData = xglhcLm($v['number'], $number_arr);
                                break;
                            case 3://正一特
                            case 4://正二特
                            case 5://正三特
                            case 6://正四特
                            case 7://正五特
                            case 8://正六特
                                $returnData = xglhcZmt($v['number'], $number_arr,$v['type']);
                                break;
                            case 10://二连肖中
                                $returnData = xglhcElxz($v['number'], $number_arr,2);
                                break;
                            case 11://三连肖中
                                $returnData = xglhcElxz($v['number'], $number_arr,3);
                                break;
                            case 12://四连肖中
                                $returnData = xglhcElxz($v['number'], $number_arr,4);
                                break;
                            case 13://五连肖中
                                $returnData = xglhcElxz($v['number'], $number_arr,5);
                                break;
                            case 14://二尾连中
                                $returnData = xglhcWlz($v['number'], $number_arr,2);
                                break;
                            case 15://三尾连中
                                $returnData = xglhcWlz($v['number'], $number_arr,3);
                                break;
                            case 16://四尾连中
                                $returnData = xglhcWlz($v['number'], $number_arr,4);
                                break;
                            case 17://五尾连中
                                $returnData = xglhcWlz($v['number'], $number_arr,5);
                                break;
                            case 18://自选5不中
                                $returnData = xglhcZxbz($v['number'], $number_arr,5);
                                break;
                            case 19://自选6不中
                                $returnData = xglhcZxbz($v['number'], $number_arr,6);
                                print_r($returnData['win']);
                                break;
                            case 20://自选7不中
                                $returnData = xglhcZxbz($v['number'], $number_arr,7);
                                break;
                            case 21://自选8不中
                                $returnData = xglhcZxbz($v['number'], $number_arr,8);
                                break;
                            case 22://自选9不中
                                $returnData = xglhcZxbz($v['number'], $number_arr,9);
                                break;
                            case 23://自选10不中
                                $returnData = xglhcZxbz($v['number'], $number_arr,10);
                                break;
                            case 24://自选11不中
                                $returnData = xglhcZxbz($v['number'], $number_arr,11);
                                break;
                            case 25://自选12不中
                                $returnData = xglhcZxbz($v['number'], $number_arr,12);
                                break;
                            case 30://平特一肖
                            case 31://平特尾数
                                $returnData = xglhcPtyxws($v['number'], $number_arr);
                                break;
                            case 26://合肖中
                                $returnData = xglhcHxz($v['number'], $number_arr);
                                break;
                            case 32://正肖
                                $returnData = xglhcZx($v['number'], $number_arr,$v['odds']);
                                if(array_key_exists('odds',$returnData)){
                                    $v['odds'] = $returnData['odds'];
                                }
                                break;
                            case 34://三全中
                                $returnData = xglhcLmsqz($v['number'], $number_arr);
                                break;
                            case 35://三中二
                                $returnData = xglhcLmsze($v['number'], $number_arr,$v['odds']);
                                if(array_key_exists('odds', $returnData)){
                                    $v['odds'] = $returnData['odds'];
                                }
                                break;
                            case 36://二全中
                                $returnData = xglhcLmeqz($v['number'], $number_arr);
                                break;
                            case 37://二中特
                                $returnData = xglhcLmezt($v['number'], $number_arr,$v['odds']);
                                if(array_key_exists('odds', $returnData)){
                                    $v['odds'] = $returnData['odds'];
                                }
                                break;
                            case 38://特串
                                $returnData = xglhcLmtc($v['number'], $number_arr);
                                break;
                        }
                        if ($returnData['win']) {
                            if($returnData['win'] == 2){
                                $explain = '香港六合彩' . $v['title'] . $v['stage'] . '期，和局退款';
                                Db::startTrans();
                                try {
                                    $reMoney = $v['money'];
                                    Db::name('single')->where('id', $v['id'])->update(['state' => 1, 'code' => 1, 'update_at' => $time, 'open_number' => $v['open_number'], 'z_money' => $reMoney,'odds'=>$v['odds']]);
                                    $updateData = array();
                                    $updateData['money'] = array('exp', 'money+' . $reMoney);
                                    $updateData['unpaid_money'] = array('exp', 'unpaid_money-' . $v['money']);
                                    Db::name('member')->where('id', $v['uid'])->update($updateData);
                                    $balance = Db::name('member')->where('id', $v['uid'])->value('money');
                                    addDetail($v['uid'], 1, $reMoney, $balance,2,$v['cate'], $explain,$v['hall'], $v['id']);
                                } catch (\Exception $e) {
                                    // 回滚事务
                                    Db::rollback();
                                    throw $e;
                                    $isSuccess = 0;
                                    continue;
                                }
                            }else {
                                $explain = '香港六合彩' . $v['title'] . $v['stage'] . '期，中奖' . $returnData['win'] . '注';
                                //当前玩家每注奖金
                                $perMoney = $v['odds'];
                                $reMoney = $perMoney * $v['money'];
                                Db::startTrans();
                                try {
                                    Db::name('single')->where('id', $v['id'])->update(['state' => 1, 'code' => 1, 'update_at' => $time, 'open_number' => $v['open_number'], 'z_money' => $reMoney,'odds'=>$v['odds']]);
                                    $updateData = array();
                                    $updateData['money'] = array('exp', 'money+' . $reMoney);
                                    $updateData['unpaid_money'] = array('exp', 'unpaid_money-' . $v['money']);
                                    Db::name('member')->where('id', $v['uid'])->update($updateData);
                                    $balance = Db::name('member')->where('id', $v['uid'])->value('money');
                                    addDetail($v['uid'], 1, $reMoney, $balance, 2, $v['cate'], $explain, $v['hall'], $v['id']);
                                    //返点给上级
//                                    if ($v['proxy_ids']) {
//                                        //计算当前玩法当前玩家每注奖金
//                                        $whereData['id'] = array('in', $v['proxy_ids']);
//                                        $memData = Db::name('member')->where($whereData)->field('id,gm_name,rebate,back_rebate,bonus,is_proxy')->order('rebate asc')->select();
//                                        $nowRebate = $v['back_rebate'];
//                                        foreach ($memData as $mk => $mv) {
//                                            $checkData = array();
//                                            if ($mv['is_proxy']) {
//                                                $checkData['back_rebate'] = $nowRebate;
//                                                $checkData['proxy_rebate'] = $mv['back_rebate'];
//                                                $fanli = getFanli2($checkData, $v['money']);
//                                                $nowRebate = $mv['rebate'];
//                                                Db::name('member')->where('id', $mv['id'])->setInc('money', $fanli);
//                                                $memd = Db::name('member')->where('id', $mv['id'])->field('money,gm_name')->find();
//                                                addDetail($mv['id'], 1, $fanli, $memd['money'], 12, $v['cate'], $v['gm_name'] . '用户投注返点代理', $v['odds'], $v['id']);
//                                            }
//                                        }
//                                    }
                                    $isSuccess = 1;
                                    Db::commit();
                                } catch (\Exception $e) {
                                    // 回滚事务
                                    Db::rollback();
                                    throw $e;
                                    $isSuccess = 0;
                                    continue;
                                }
                                if ($isSuccess) {
                                    $pushInsertData['title'] = '中奖通知';
                                    $pushInsertData['content'] = '香港六合彩 第' . $v['stage'] . '期 ' . $v['title'] . ' ' . $v['number'] . ' 已中奖,中奖金额<span>' . $reMoney . '</span>';
                                    $pushId = Db::name('push')->insertGetId($pushInsertData);
                                    if ($pushId) {
                                        $winPush = Cache::get('win_push_' . $v['uid']);
                                        if ($winPush) {
                                            Cache::tag('win_push')->set('win_push_' . $v['uid'], $winPush . ',' . $pushId);
                                        } else {
                                            Cache::tag('win_push')->set('win_push_' . $v['uid'], $pushId);
                                        }
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
                                $updateData['unpaid_money'] = array('exp', 'unpaid_money-' . $v['money']);
                                Db::name('member')->where('id', $v['uid'])->update($updateData);
                                Db::name('single')->where('id', $v['id'])->update(['state' => 1, 'update_at' => $time, 'open_number' => $v['open_number']]);
                                //返点给上级
//                                if ($v['proxy_ids']) {
//                                    //计算当前玩法当前玩家每注奖金
//                                    $whereData['id'] = array('in', $v['proxy_ids']);
//                                    $memData = Db::name('member')->where($whereData)->field('id,gm_name,rebate,back_rebate,bonus,is_proxy')->order('rebate asc')->select();
//                                    $nowRebate = $v['back_rebate'];
//                                    foreach ($memData as $mk => $mv) {
//                                        $checkData = array();
//                                        if ($mv['is_proxy']) {
//                                            $checkData['back_rebate'] = $nowRebate;
//                                            $checkData['proxy_rebate'] = $mv['back_rebate'];
//                                            $fanli = getFanli2($checkData, $v['money']);
//                                            $nowRebate = $mv['rebate'];
//                                            Db::name('member')->where('id', $mv['id'])->setInc('money', $fanli);
//                                            $memd = Db::name('member')->where('id', $mv['id'])->field('money,gm_name')->find();
//                                            addDetail($mv['id'], 1, $fanli, $memd['money'], 12, $v['cate'], $v['gm_name'] . '用户投注返点代理', $v['odds'], $v['id']);
//                                        }
//                                    }
//                                }
                            } catch (\Exception $e) {
                                throw $e;
                                continue;
                            }
                        }
                    } catch (\Exception $e) {
                        file_put_contents(__DIR__ . '/xglhc_open.txt', $e . $v['id'] . PHP_EOL, FILE_APPEND);
                        Db::name('single')->where('id', $v['id'])->update(['state' => 3, 'update_at' => $time, 'open_number' => $v['open_number']]);
                    }
                }
            }
            flock($fp,LOCK_UN);
        }
        fclose($fp);
    }
}