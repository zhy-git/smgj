<?php
namespace app\api\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Fast extends Command
{
    protected function configure()
    {
        $this->setName('fast')->setDescription('江苏快3');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    public function doCron(){
        $number = getNumberCache('fast'); //获取最新开奖号
        if($number) {
            $stage_num = key($number);//获取最新一期号
            $value = $number[$stage_num];
            $numbers = $value['number'];//获取最新开奖号
            $number_arr = explode(',', $numbers);
            $w['stage'] = $stage_num;
            $w['cate'] = 9;
            $w['state'] = 0;
            $w['code'] = 0;
            $list = Db::name('single')->where($w)->select();
            $explain ='';
            if($list) {
                $time = time();
                foreach ($list as $v){
                    $pl =0;
                    //计算赔率
                    switch ($v['type']){
                        case 1://大小单双
                            $he = array_sum($number_arr);

                            $dx = FastDx($he);
                            if($v['number']==$dx) {
                                $pl=1;
                                $explain = $stage_num . '期大小单双中' . $v['number'];
                            }
                            break;
                        case 2://点数
                            $he = array_sum($number_arr);
                            if($v['number'] == $he){
                                $pl = 1;
                                $explain = $stage_num.'期点数选中'.$v['number'];
                            }
                            break;
                        case 3://围骰

                            $number_str = implode('', $number_arr);
                            if($v['number']==$number_str){
                                $pl = 1;
                                $explain = $stage_num.'期围骰中'.$v['number'];
                            }
                            break;
                        case 4://短牌
                            sort($number_arr);
                            $number_str = implode('', $number_arr);
                            if(stripos($number_str,$v['number']) != false){
                                $pl = 1;
                                $explain = $stage_num.'期短牌中'.$v['number'];
                            }
                            break;
                        case 5://长牌
                             sort($number_arr);
                            $number_str = implode('', $number_arr);
                            if(stripos($number_str,$v['number']) != false){
                                $pl = 1;
                                $explain = $stage_num.'期长牌中'.$v['number'];
                            }
                            break;
                    }
                    $open_number = $numbers;
                    if($pl){
                        $explain = '江苏快三'.$explain;
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