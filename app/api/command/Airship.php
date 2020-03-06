<?php
namespace app\api\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Airship extends Command
{
    protected function configure()
    {
        $this->setName('airship')->setDescription('幸运飞艇兑奖');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    public function doCron(){
        $number = getNumberCache('airship'); //获取最新开奖号
        if($number) {
            $stage_num = key($number);//获取最新一期号
            $value = $number[$stage_num];
            $numbers = $value['number'];//获取最新开奖号
            $number_arr = explode(',', $numbers);
            $w['stage'] = $stage_num;
            $w['cate']  = 4;
            $w['state'] = 0;
            $w['code']  = 0;
            $list = Db::name('single')->where($w)->select();
            $explain ='';
            if($list) {
                $time = time();
                foreach ($list as $v){
                    $pl =0;
                    //计算赔率
                    if($v['type']>=1 && $v['type']<=5){
                        $wei_number = $number_arr[$v['type']-1];
                        $dx = carDxWei($wei_number); //判断大小
                        $ds = carDs($wei_number);//判断单双
                        $longfu = longfu($wei_number,9-$wei_number);//判断龙虎
                        if($v['number']==$dx || $v['number']==$ds ||$v['number']==$longfu){
                            $pl = 1;
                            $explain = $stage_num.'期大小单双龙虎中'.$v['number'];
                        }
                    }elseif ($v['type']>=6 && $v['type']<=10){
                        $wei_number = $number_arr[$v['type']-1];
                        $dx = carDxWei($wei_number); //判断大小
                        $ds = carDs($wei_number);//判断单双
                        if($v['number']==$dx || $v['number']==$ds){
                            $pl = 1;
                            $explain = $stage_num.'期大小单双中'.$v['number'];
                        }

                    } elseif ($v['type']==11){
                        $wei_number = $number_arr[0]+$number_arr[1];
                        $dx = carDxWei($wei_number); //判断大小
                        $ds = carDs($wei_number);//判断单双
                        if($v['number']==$dx || $v['number']==$ds){
                            $pl = 1;
                            $explain = $stage_num.'期冠亚和值大小单双中'.$v['number'];
                        }
                    } elseif ($v['type']==12){
                        $wei_number = $number_arr[0]+$number_arr[1];
                        if($v['number']==$wei_number){
                            $pl = 1;
                            $explain = $stage_num.'期冠亚和值中'.$v['number'];
                        }
                    }elseif ($v['type']>=12 && $v['type']<=22){
                        $wei_number = $number_arr[$v['type']-13];
                        if($v['number']==$wei_number){
                            $pl = 1;
                            $explain = $stage_num.'期冠特码中'.$v['number'];
                        }
                    }
                    $open_number = $numbers;
                    if($pl){
                        $explain = '幸运飞艇'.$explain;
                        $odd = getOdds($v['cate'],$v['hall'],$v['type'],$v['number']);
                        if(!$odd){
                            $content = $v['cate'].'---'.$v['type'].'---'.$v['hall'].'---'.$v['number'].'没有赔率';
                            file_put_contents('my_log.txt',$content.PHP_EOL,8);
                        }
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