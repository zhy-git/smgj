<?php
namespace app\api\command;

use app\api\controller\HX;
use think\Cache;
use think\Config;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Robot extends Command
{
    protected function configure()
    {
        $this->setName('robot')->setDescription('机器人');
    }

    protected function execute(Input $input, Output $output)
    {
        /* 永不超时 */
        ini_set('max_execution_time', 0);
        $this->doCron();
    }

    /**
     * 机器人
     */

    public function doCron(){
        $robot_info = Db::name('robot')
            ->where(array('status'=>1))
            ->select();
        foreach ($robot_info as $k=>$v){
            //检查是否在最小开奖时间之类
            $cache_name = 'robot'.$v['cate'].$v['hall'].$v['id'];
            $last_time = Cache::store('redis')->get($cache_name);
            if($last_time){
                if(time()-$last_time<$v['min_time']){
                    continue;
                }
            }

            //获取下一期的期号
            switch ($v['cate']){
                case 1 :
                    $number = getNumberCache('eight');
                    $stage= key($number); //获取最新一期的key（即期数）
                    $numbers =$number[$stage]; //获取最新开奖号
                    $nexts = setEightStageTime($stage,$numbers['dateline']);
                    break;
                case 2 :
                    $number = getNumberCache('canada');
                    $stage= key($number); //获取最新一期的key（即期数）
                    $numbers =$number[$stage]; //获取最新开奖号
                    //计算下次期数 和 开间时间
                    $nexts = setCanadaStageTime($stage,$numbers['dateline']);
                    break;
                case 3 :
                    $number = getNumberCache('car');
                    $stage= key($number); //获取最新一期的key（即期数）
                    $numbers =$number[$stage]; //获取最新开奖号

                    $nexts = setCarStageTime($stage,$numbers['dateline']);
                    break;
                case 4 :
                    $number = getNumberCache('airship');
                    $stage= key($number); //获取最新一期的key（即期数）
                    $numbers =$number[$stage]; //获取最新开奖号
                    $nexts = setAirshipStageTime($stage,$numbers['dateline']);
                    break;
            }
            if($nexts['dateline']-time()>30){
                continue;
            }
            //获取随机的投注类型
            $title_name = 'title'.$v['cate'];
            $title = Cache::store('redis')->get($title_name);
            if(!$title){
                $title  =  Db::name('bet')
                    ->field('type,title')
                    ->where(array('cate'=>$v['cate']))
                    ->select();
                Cache::store('redis')->set($title_name,$title);
            }

            $choose_number =  array_rand($title,1);
            $title_arr = $title[$choose_number];

            //获取随机的投注下类型
            $type = $title_arr['type'];
            $rule_name = 'rule'.$v['cate'].$type;
            $rule = Cache::store('redis')->get($rule_name);
            if(!$rule){
                $rule  =  Db::name('odds')
                    ->where(array('cate'=>$v['cate'],'hall'=>1,'type'=>$type))
                    ->column('rule');
                Cache::store('redis')->set($rule_name,$rule);
            }
            $choose_number0 =  array_rand($rule,1);
            $rule = $rule[$choose_number0];
            //获取投注的金额
            $money = rand($v['down'],$v['up']);
            if(!$money%5==0){
                $money = ceil($money/5)*5;
            }
            $content = ['info'=>
                [
                    'title'=>$title_arr['title'],
                    'stage'=>$nexts['stage_next'],
                    'money'=>$money,
                    'number'=>$rule,
                    'uid'=>1,
                    'nickname'=>$v['nickname'],
                    'head'=>Config::get('img_url').$v['logo']
                ]
            ];
            $ext = $content;
            $hall_name = 'robot_chat'.$v['cate'].$v['hall'];
            $hall = Cache::store('redis')->get($hall_name);
            if(!$hall){
                $hall  =  Db::name('hall')
                    ->where(array('cate'=>$v['cate'],'hall'=>$v['hall']))
                    ->value('chat_id');
                Cache::store('redis')->set($hall_name,$hall);
            }
            $username = [$hall];
            $HX = new HX();
            $result = $HX->yy_hxSend("admin", $username, $content, "chatrooms", $ext);
            Cache::store('redis')->set($cache_name,time());
        }
    }


}