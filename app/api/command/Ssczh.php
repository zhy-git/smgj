<?php
namespace app\api\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Ssczh extends Command
{
    protected function configure()
    {
        $this->setName('ssczh')->setDescription('重庆时时彩整合盘兑奖');
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
        $number = getNumberCache('ssc'); //获取最新开奖号
        if($number) {
            $stage_num = key($number);//获取最新一期号
            $value = $number[$stage_num];
            $numbers = $value['number'];//获取最新开奖号
//            $stage_num = 20171230117;//获取最新一期号
//            $numbers = '7,6,8,7,1';//获取最新开奖号
            $number_arr = explode(',', $numbers);

            $w['stage'] = $stage_num;
            $w['cate'] = 1;
            $w['state'] = 0;
            $w['code'] = 0;
            $w['is_del'] = 0;
            $w['hall'] = 5;
            $list = Db::name('single')->where($w)->select();
            $typeName = '';
            if($list) {
                $time = time();
                foreach ($list as $v){
                    $winNotes = 0;//赢了多少注
                    $oddsNum = 0;
                    //计算赔率
                    switch ($v['type']){
                        case 1://第一球
                            $resData = sscZhDxds($v['number'], $number_arr, $v['type']);
                            $winNotes = $resData['win'];
                            $oddsNum = $resData['data'];
                            $typeName = '第一球';
                            break;
                        case 2://第二球
                            $resData = sscZhDxds($v['number'], $number_arr, $v['type']);
                            $winNotes = $resData['win'];
                            $oddsNum = $resData['data'];
                            $typeName = '第二球';
                            break;
                        case 3://第三球
                            $resData = sscZhDxds($v['number'], $number_arr, $v['type']);
                            $winNotes = $resData['win'];
                            $oddsNum = $resData['data'];
                            $typeName = '第三球';
                            break;
                        case 4://第四球
                            $resData = sscZhDxds($v['number'], $number_arr, $v['type']);
                            $winNotes = $resData['win'];
                            $oddsNum = $resData['data'];
                            $typeName = '第四球';
                            break;
                        case 5://第五球
                            $resData = sscZhDxds($v['number'], $number_arr, $v['type']);
                            $winNotes = $resData['win'];
                            $oddsNum = $resData['data'];
                            $typeName = '第五球';
                            break;
                        case 6://总和
                            $resData = sscZhZh($v['number'], $number_arr);
                            $winNotes = $resData['win'];
                            $oddsNum = $resData['data'];
                            $typeName = '总和';
                            break;
                        case 7://龙虎
                            $resData = sscZhLh($v['number'], $number_arr);
                            $winNotes = $resData['win'];
                            $oddsNum = $resData['data'];
                            $typeName = '龙虎';
                            break;
                        case 8://前三
                            $resData = sscZhTsh($v['number'], $number_arr,$v['type']);
                            $winNotes = $resData['win'];
                            $oddsNum = $resData['data'];
                            $typeName = '前三';
                            break;
                        case 9://中三
                            $resData = sscZhTsh($v['number'], $number_arr,$v['type']);
                            $winNotes = $resData['win'];
                            $oddsNum = $resData['data'];
                            $typeName = '中三';
                            break;
                        case 10://后三
                            $resData = sscZhTsh($v['number'], $number_arr,$v['type']);
                            $winNotes = $resData['win'];
                            $oddsNum = $resData['data'];
                            $typeName = '后三';
                            break;
                    }
                    $pl = getPl($v['cate'],$oddsNum,5);
                    if($pl){
                        if($winNotes){
                            //注释
                            $explain = '时时彩'.$typeName.$stage_num.'期 整合盘，中奖'.$winNotes.'注';
                            $reMoney = $pl*$winNotes*$v['money'];
                            Db::startTrans();
                            try {
                                Db::name('single')->where('id',$v['id'])->update(['state'=>1,'code'=>1,'update_at'=>$time,'open_number'=>$numbers,'z_money'=>$reMoney]);
                                Db::name('member')->where('id',$v['uid'])->setInc('money',$reMoney);
                                $balance = Db::name('member')->where('id',$v['uid'])->value('money');
                                addDetail($v['uid'],1,$reMoney,$balance,2,1,$explain,5);
                                Db::commit();
                            } catch (\Exception $e) {
                                // 回滚事务
                                Db::rollback();
                            }
//                            if(Db::name('single')->where('id',$v['id'])->update(['state'=>1,'code'=>1,'update_at'=>$time,'open_number'=>$numbers,'z_money'=>$reMoney])){
//                                Db::name('member')->where('id',$v['uid'])->setInc('money',$reMoney);
//                                $balance = Db::name('member')->where('id',$v['uid'])->value('money');
//                                addDetail($v['uid'],1,$reMoney,$balance,2,1,$explain,5);
//                            }
                        }else{
                            Db::name('single')->where('id',$v['id'])->update(['state'=>1,'update_at'=>$time,'open_number'=>$numbers]);
                        }
                    }else{
                        Db::name('single')->where('id',$v['id'])->update(['state'=>1,'update_at'=>$time,'open_number'=>$numbers]);
                    }
                }
            }
        }
    }
}