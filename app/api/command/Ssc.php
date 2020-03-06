<?php
namespace app\api\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Ssc extends Command
{
    protected function configure()
    {
        $this->setName('ssc')->setDescription('重庆时时彩兑奖');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    /**
     *开奖
     */
    public function doCron(){
//        $number = getNumberCache('ssc'); //获取最新开奖号
//        if($number) {
//            $stage_num = key($number);//获取最新一期号
//            $value = $number[$stage_num];
//            $numbers = $value['number'];//获取最新开奖号
////            $stage_num = 20180119041;//获取最新一期号
////            $numbers = '3,4,2,6,5';//获取最新开奖号
//            $number_arr = explode(',', $numbers);

        //$w['s.stage'] = $stage_num;
        $w['s.cate'] = 1;
        $w['s.state'] = 0;
        $w['s.code'] = 0;
        $w['s.is_del'] = 0;

        $list = Db::name('single')
            ->where($w)
            ->alias('s')
            ->join('dl_bet b','s.type=b.type and s.cate=b.cate')
            ->join('dl_member m','s.uid=m.id')
            ->join('dl_at_ssc a','s.stage=a.stage')
            ->field('s.id,s.stage,s.type,s.uid,s.number,s.money,s.z_money,s.multiple,s.notes,s.wei,s.denomination,b.title,m.gm_name,m.is_proxy,m.proxy_id,m.rebate,m.bonus,m.proxy_rebate,m.proxy_bonus,a.number open_number')
            ->select();
//            print_r($list);
//            die();
        if($list) {
            $time = time();
            foreach ($list as $v){
                try {
                    $returnData = array();//返回信息
                    $number_arr = explode(',', $v['open_number']);
                    //计算赔率
                    switch ($v['type']){
                        case 1://五星直选复式
                            $returnData = sscZxfs($v['number'],$number_arr,$v['type']);
                            break;
                        case 2://五星直选单式
                            $returnData = sscZxds($v['number'],$number_arr,$v['type']);
                            break;
                        case 3://五星直选组合
                            $returnData = sscZxzh($v['number'], $number_arr);
                            break;
                        case 4://五星组选组选120
                            $returnData = sscZuxyel($v['number'], $number_arr);
                            break;
                        case 5://五星组选组选60
                            $returnData = sscZuxss($v['number'], $number_arr, $v['type']);
                            break;
                        case 6://五星组选组选30
                            $returnData = sscZuxss($v['number'], $number_arr, $v['type']);
                            break;
                        case 7://五星组选组选20
                            $returnData = sscZuxss($v['number'], $number_arr, $v['type']);
                            break;
                        case 8://五星组选组选10
                            $returnData = sscZuxss($v['number'], $number_arr, $v['type']);
                            break;
                        case 9://五星组选组选5
                            $returnData = sscZuxss($v['number'], $number_arr, $v['type']);
                            break;
                        case 10://五星特殊一帆风顺
                            $returnData = sscQw($v['number'], $number_arr, $v['type']);
                            break;
                        case 11://五星特殊好事成双
                            $returnData = sscQw($v['number'], $number_arr, $v['type']);
                            break;
                        case 12://五星特殊三星报喜
                            $returnData = sscQw($v['number'], $number_arr, $v['type']);
                            break;
                        case 13://五星特殊四季发财
                            $returnData = sscQw($v['number'], $number_arr, $v['type']);
                            break;
                        case 14://四星后四直选复式
                            $returnData = sscZxfs($v['number'],$number_arr,$v['type']);
                            break;
                        case 15://四星后四直选单式
                            $returnData = sscZxds($v['number'],$number_arr,$v['type']);
                            break;
                        case 17://四星后四组选组选24
                            $returnData = sscZuxsx($v['number'], $number_arr, $v['type']);
                            break;
                        case 18://四星后四组选组选12
                            $returnData = sscZuxsx($v['number'], $number_arr, $v['type']);
                            break;
                        case 19://四星后四组选组选6
                            $returnData = sscZuxsx($v['number'], $number_arr, $v['type']);
                            break;
                        case 20://四星后四组选组选4
                            $returnData = sscZuxsx($v['number'], $number_arr, $v['type']);
                            break;
                        case 65://定位胆
                            $returnData = sscZxdwd($v['number'], $number_arr);
                            break;
                        case 66://后三一码不定位
                            $returnData = sscBdwd($v['number'], $number_arr, $v['type']);
                            break;
                        case 67://前三一码不定位
                            $returnData = sscBdwd($v['number'], $number_arr, $v['type']);
                            break;
                        case 68://后三二码不定位
                            $returnData = sscBdwd($v['number'], $number_arr, $v['type']);
                            break;
                        case 69://前三二码不定位
                            $returnData = sscBdwd($v['number'], $number_arr, $v['type']);
                            break;
                        case 70://后四一码不定位
                            $returnData = sscBdwd($v['number'], $number_arr, $v['type']);
                            break;
                        case 71://后四二码不定位
                            $returnData = sscBdwd($v['number'], $number_arr, $v['type']);
                            break;
                        case 72://五星二码不定位
                            $returnData = sscBdwd($v['number'], $number_arr, $v['type']);
                            break;
                        case 73://五星三码不定位
                            $returnData = sscBdwd($v['number'], $number_arr, $v['type']);
                            break;
                        case 74://前二大小单双
                            $returnData = sscDxds($v['number'], $number_arr, $v['type']);
                            break;
                        case 75://后二大小单双
                            $returnData = sscDxds($v['number'], $number_arr, $v['type']);
                            break;
                        case 78://任二直选复式
                            $returnData = sscRessfs($v['number'], $number_arr, $v['type']);
                            break;
                        case 79://任二直选单式
                            $returnData = sscReds($v['number'], $number_arr, $v['wei']);
                            break;
                        case 80://任二直选和值
                            $returnData = sscRehz($v['number'], $number_arr, $v['wei']);
                            break;
                        case 81://任二组选复式
                            $returnData = sscZere($v['number'], $number_arr, $v['wei']);
                            break;
                        case 82://任二组选单式
                            $returnData = sscRszxds($v['number'], $number_arr, $v['wei']);
                            break;
                        case 83://任二组选和值
                            $returnData = sscRszxhz($v['number'], $number_arr, $v['wei']);
                            break;
                        case 84://任三直选复式
                            $returnData = sscRessfs($v['number'], $number_arr, $v['type']);
                            break;
                        case 85://任三直选单式
                            $returnData = sscRsands($v['number'], $number_arr, $v['wei']);
                            break;
                        case 86://任三直选和值
                            $returnData = sscRsanhz($v['number'], $number_arr, $v['wei']);
                            break;
                        case 87://任三组选组三复式
                            $returnData = sscRsanzs($v['number'], $number_arr, $v['wei']);
                            break;
                        case 88://任三组选组三单式
                            $returnData = sscRsanzsds($v['number'], $number_arr, $v['wei']);
                            break;
                        case 89://任三组选组六复式
                            $returnData = sscRsanzl($v['number'], $number_arr, $v['wei']);
                            break;
                        case 90://任三组选组六单式
                            $returnData = sscRsanzsls($v['number'], $number_arr, $v['wei']);
                            break;
                        case 91://任三混合组选
                            $returnData = sscRsanhx($v['number'], $number_arr, $v['wei']);
                            break;
                        case 92://任三组选和值
                            $returnData = sscRsanzxhz($v['number'], $number_arr, $v['wei']);
                            break;
                        case 93://任四直选复式
                            $returnData = sscRessfs($v['number'], $number_arr, $v['type']);
                            break;
                        case 94://任四直选单式
                            $returnData = sscRsds($v['number'], $number_arr, $v['wei']);
                            break;
                        case 95://任四组选组选24
                            $returnData = sscRszxes($v['number'], $number_arr, $v['wei']);
                            break;
                        case 96://任四组选组选12
                            $returnData = sscRszxye($v['number'], $number_arr, $v['wei']);
                            break;
                        case 97://任四组选组选6
                            $returnData = sscRszxl($v['number'], $number_arr, $v['wei']);
                            break;
                        case 98://任四组选组选4
                            $returnData = sscRszxs($v['number'], $number_arr, $v['wei']);
                            break;
                        case 99://四星前四直选复式
                            $returnData = sscZxfs($v['number'],$number_arr,$v['type']);
                            break;
                        case 100://四星前四直选单式
                            $returnData = sscZxds($v['number'],$number_arr,$v['type']);
                            break;
                        case 139://任三前三特殊
                            $returnData = sscRsants($v['number'],$number_arr,$v['type']);
                            break;
                        case 140://任三中三特殊
                            $returnData = sscRsants($v['number'],$number_arr,$v['type']);
                            break;
                        case 141://任三后三特殊
                            $returnData = sscRsants($v['number'],$number_arr,$v['type']);
                            break;
                        case 142://龙虎万千
                            $returnData = sscZhplh($v['number'],$number_arr,$v['type']);
                            break;
                        case 143://龙虎万百
                            $returnData = sscZhplh($v['number'],$number_arr,$v['type']);
                            break;
                        case 144://龙虎万十
                            $returnData = sscZhplh($v['number'],$number_arr,$v['type']);
                            break;
                        case 145://龙虎万个
                            $returnData = sscZhplh($v['number'],$number_arr,$v['type']);
                            break;
                        case 146://龙虎千百
                            $returnData = sscZhplh($v['number'],$number_arr,$v['type']);
                            break;
                        case 147://龙虎千十
                            $returnData = sscZhplh($v['number'],$number_arr,$v['type']);
                            break;
                        case 148://龙虎千个
                            $returnData = sscZhplh($v['number'],$number_arr,$v['type']);
                            break;
                        case 149://龙虎百十
                            $returnData = sscZhplh($v['number'],$number_arr,$v['type']);
                            break;
                        case 150://龙虎百个
                            $returnData = sscZhplh($v['number'],$number_arr,$v['type']);
                            break;
                        case 151://龙虎十个
                            $returnData = sscZhplh($v['number'],$number_arr,$v['type']);
                            break;
                        case 152://五星总和大小单双
                            $returnData = sscWxzhdxds($v['number'],$number_arr);
                            break;
                        case 153://总和大小单双整合
                            $returnData = sscZhzhdxds($v['number'],$number_arr,$v['type']);
                            break;
                        case 154://万位大小单双
                            $returnData = sscZhzhdxds($v['number'],$number_arr,$v['type']);
                            break;
                        case 155://千位大小单双
                            $returnData = sscZhzhdxds($v['number'],$number_arr,$v['type']);
                            break;
                        case 156://百位大小单双
                            $returnData = sscZhzhdxds($v['number'],$number_arr,$v['type']);
                            break;
                        case 157://十位大小单双
                            $returnData = sscZhzhdxds($v['number'],$number_arr,$v['type']);
                            break;
                        case 158://个位大小单双
                            $returnData = sscZhzhdxds($v['number'],$number_arr,$v['type']);
                            break;
                        case 159://前三豹子顺子
                            $returnData = sscTszh($v['number'],$number_arr,$v['type']);
                            break;
                        case 160://中三豹子顺子
                            $returnData = sscTszh($v['number'],$number_arr,$v['type']);
                            break;
                        case 161://后三豹子顺子
                            $returnData = sscTszh($v['number'],$number_arr,$v['type']);
                            break;
                    }
                    $pl = getPl($returnData['win_id']);
                    if ($returnData['win']) {
                        $explain = '时时彩' . $v['title'] . $v['stage'] . '期，中奖' . $returnData['win'] . '注';
                        if(is_array($returnData['win_id'])){
                            $reMoney = array();
                            foreach ($returnData['win_id'] as $rdk=>$rdv){
                                //计算当前玩法当前玩家每注奖金
                                $perMoney = getBonus($pl[$rdk], $v,$v['type']);
                                $danwei = denominationChange($v['denomination']);
                                $reMoney[] = ($perMoney * $rdv * $v['multiple'])/$danwei;
                            }
                            $reMoney = array_sum($reMoney);
                        }else{
                            //计算当前玩法当前玩家每注奖金
                            $perMoney = getBonus($pl, $v,$v['type']);
                            if($v['hall'] == 2){
                                $reMoney = ($perMoney * $returnData['win'] * $v['money']);
                            }else{
                                $danwei = denominationChange($v['denomination']);
                                $reMoney = ($perMoney * $returnData['win'] * $v['multiple'])/$danwei;
                            }
                        }

                        Db::startTrans();
                        try {
                            Db::name('single')->where('id', $v['id'])->update(['state' => 1, 'code' => 1, 'update_at' => $time, 'open_number' => $v['open_number'], 'z_money' => $reMoney]);
                            Db::name('member')->where('id', $v['uid'])->setInc('money', $reMoney);
                            $balance = Db::name('member')->where('id', $v['uid'])->value('money');
                            addDetail($v['uid'], 1, $reMoney, $balance, 2, 1, $explain,$v['hall'],$v['id']);
                            Db::commit();
                        } catch (\Exception $e) {
                            // 回滚事务
                            Db::rollback();
                        }
                    } else {
                        try {
                            if ($returnData['errorCode'] != 0) {
                                $singleErrorAddData['single_id'] = $v['id'];
                                $singleErrorAddData['error_code'] = $returnData['errorCode'];
                                $singleErrorAddData['create_time'] = time();
                                $singleErrorAddData['cate'] = 1;
                                Db::name('single_error')->insert($singleErrorAddData);
                            }
                            Db::name('single')->where('id', $v['id'])->update(['state' => 1, 'update_at' => $time, 'open_number' => $v['open_number']]);
                        } catch (\Exception $e) {

                        }
                    }
                    //返点给上级
                    if($v['proxy_id']){
                        if ($returnData['win']) {
                            $zhongfali = getZhongFanli($v,$reMoney);
                            Db::startTrans();
                            try {
                                Db::name('member')->where('id', $v['proxy_id'])->setInc('money', $zhongfali);
                                $memd = Db::name('member')->where('id', $v['proxy_id'])->field('money,gm_name')->find();
                                addDetail($v['proxy_id'], 1, $zhongfali, $memd['money'], 6, 1, $v['gm_name'].'用户中奖返点',$v['hall'],$v['id']);
                                Db::commit();
                            } catch (\Exception $e) {
                                // 回滚事务
                                Db::rollback();
                            }
                        }
                        //计算当前玩法当前玩家每注奖金
                        $fanli = getFanli($v ,$v['money']);
                        $danwei = denominationChange($v['denomination']);
                        $fanliMoney = bcdiv($fanli,$danwei,3);
                        Db::startTrans();
                        try {
                            Db::name('member')->where('id', $v['proxy_id'])->setInc('money', $fanliMoney);
                            $memd = Db::name('member')->where('id', $v['proxy_id'])->field('money,gm_name')->find();
                            addDetail($v['proxy_id'], 1, $fanliMoney, $memd['money'], 6, 1, $v['gm_name'].'用户投注返点',$v['hall'],$v['id']);
                            Db::commit();
                        } catch (\Exception $e) {
                            // 回滚事务
                            Db::rollback();
                        }
                    }

                } catch (\Exception $e) {
                    file_put_contents(__DIR__.'/ssc_open.txt', $e.$v['id'].PHP_EOL,FILE_APPEND);
                    Db::name('single')->where('id', $v['id'])->update(['state' => 3, 'update_at' => $time, 'open_number' => $v['open_number']]);
                    echo 'error';
                }

            }
        }

    }
}