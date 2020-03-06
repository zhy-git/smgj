<?php
namespace app\api\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Eight extends Command
{
    protected function configure()
    {
        $this->setName('eight')->setDescription('pc蛋蛋');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    /**
     * 手动开奖
     */
    public function doCron(){
        $number = getNumberCache('eight'); //获取最新开奖号
        if($number) {
            $stage_num = key($number);//获取最新一期号
            $value = $number[$stage_num];
            $numbers = $value['number'];//获取最新开奖号
            $number_arr_s = explode(',',$numbers);
            $number_arr = getEightNum($number_arr_s);
            $he = array_sum($number_arr);
            $w['stage'] = $stage_num;
            $w['cate']  = 1;
            $w['state'] = 0;
            $w['code']  = 0;
            $list = Db::name('single')->where($w)->select();
            $explain ='';
            if($list) {
                $time = time();
                foreach ($list as $v){
                    $pl =0;
                    //计算赔率
                    switch ($v['type']){
                        case 1://大小单双
                            $dx = eightDx($he); //判断大小
                            $ds = eightDs($he);//判断单双
                            if($v['number'] == $dx){
                                if($v['number'] == '大'){
                                    $pl = 1;
                                }elseif ($v['number'] == '小'){
                                    $pl = 1;
                                }
                            }elseif($v['number'] == $ds){
                                if($v['number'] == '单'){
                                    $pl = 1;
                                }elseif ($v['number'] == '双'){
                                    $pl = 1;
                                }
                            }
                            $explain = $stage_num.'期大小单双中'.$v['number'];
                            break;
                        case 2://猜极大极小
                            if($he >=22 && $he<=27 && $v['number']=='极大'){
                                $pl = 1;
                            }elseif ($he >=0 && $he<=5 && $v['number']=='极小'){
                                $pl = 1;
                            }
                            $explain = $stage_num.'期极大极小中'.$v['number'];
                            break;
                        case 3://大单小单大双小双
                            $dx = eightDx($he); //判断大小
                            $ds = eightDs($he);//判断单双
                            if($v['number'] == $dx.$ds){
                                if($v['number'] == '大单'){
                                    $pl = 1;
                                }elseif($v['number'] == '小单'){
                                    $pl = 1;
                                }elseif($v['number'] == '大双'){
                                    $pl = 1;
                                }elseif($v['number'] == '小双'){
                                    $pl = 1;
                                }
                                $explain = $stage_num.'期猜大单小单大双小双中'.$v['number'];
                            }
                            break;

                        case 4://特码
                            if($he == $v['number']){
                                $pl = 1;
                                $explain = $stage_num.'期猜特码中'.$v['number'];
                            }
                            break;
                        case 5://豹子
                            if($number_arr[0]==$number_arr[1] && $number_arr[1]==$number_arr[2] && $number_arr[0]==$number_arr[2]){
                                $pl = 1;
                            }
                            $explain = $stage_num.'期猜豹子中'.$v['number'];
                            break;
                        case 6://对子
                            $arr_num = array_count_values($number_arr);
                            if(in_array(2,$arr_num)) {
                                $pl = 1;
                            }
                            $explain = $stage_num.'期猜对子中'.$v['number'];
                            break;
                        case 7://色波
                            $sb = eightBo($he);
                            if($v['number']==$sb) {
                                $pl = 1;
                                $explain = $stage_num.'期猜红黄绿中'.$v['number'];
                            }
                            break;
                    }
                    $open_number = implode(',',$number_arr);

                    if($pl){
                        $explain = 'PC蛋蛋'.$explain;
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