<?php
namespace app\api\command;

use app\api\controller\HX;
use think\Cache;
use think\Config;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;

class Robots extends Command
{
    protected function configure()
    {
        $this->setName('robots')->setDescription('机器人');
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
            ->where('cate',2)
            ->select();
        foreach ($robot_info as $k=>$v){
            //检查是否在最小开奖时间之内
            $cache_name = 'robot'.$v['cate'].$v['hall'].$v['id'];
            $last_time = Cache::get($cache_name);
            if($last_time){
                if(time()-$last_time<$v['min_time']){
                    continue;
                }
            }
            $room_id = $v['cate'].'0'.$v['hall'];
            $cate_info = Db::name('cate')->where('id',$v['cate'])->find();
            if(!empty($cate_info)){
                //获取下一期的期号
                $number = getNumberCache($cate_info['nickname']);
                $stage= key($number); //获取最新一期的key（即期数）
                $numbers =$number[$stage]; //获取最新开奖号
                $nexts = setStageTime($cate_info['nickname']);
                $all_time= 210;
                if($nexts['endBetTime']>=time() && ($nexts['dateline'])<=$all_time){
                    //获取随机的投注类型
                    $title  =  Db::name('bet')
                        ->field('type,title')
                        ->where(array('cate'=>$v['cate']))
                        ->where('status',1)
                        ->where('is_use',1)
                        ->select();
                    $choose_number =  array_rand($title,1);
                    $title_arr = $title[$choose_number];
                    //获取随机的投注下类型
                    $type = $title_arr['type'];
                    $rule  =  Db::name('odds')
                        ->where(array('cate'=>$v['cate']))
                        ->where(array('type'=>$type))
                        ->where('status',1)
                        ->column('rule');
                    $odds = Db::name('odds')
                        ->where(array('cate'=>$v['cate']))
                        ->where(array('type'=>$type))
                        ->where('status',1)
                        ->column('rate');
                    if(count($rule)>0){
                        $choose_number0 =  array_rand($rule,1);
                        $rule = $rule[$choose_number0];
                        $odds = $odds[$choose_number0];
                        //获取投注的金额
                        $money = rand($v['down'],$v['up']);
//                        if(!$money%10==0){
//                            $money = ceil($money/10)*10;
//                        }
                        $content = array('typeName'=>$title_arr['title'],'stage'=>$nexts['stage_next'],'money'=>$money,'number'=>$rule,'type'=>$type,'odds'=>$odds);
                        $extra = array('head'=>'/uploads/'.$v['logo'],'name'=>$v['nickname'] ,'time'=>date('H:i:s',time()),'type'=>4);
                        $hall_name = 'robot_chat'.$v['cate'].$v['hall'];
                        $hall = Cache::get($hall_name);
                        if(!$hall){
                            $hall  =  Db::name('hall')
                                ->where(array('cate'=>$v['cate'],'hall'=>$v['hall']))
                                ->value('chat_id');
                            Cache::set($hall_name,$hall);
                        }
                        $content=array('content'=>array($content),'extra'=>$extra);
                        $re = rongMsg(9999999,[$room_id],json_encode($content));
                        Cache::set($cache_name,time());
                        $post_status = Cache::get('post_'.$room_id);
                        if($post_status!=2){
                            Cache::set('post_'.$room_id,2);
                        }
                    }
                }else{
                    $posts = Db::name('notice')->where('status',1)->select();
                    if($posts){
                        $post_status = Cache::get('post_'.$room_id);
                        if($post_status==2){
                            foreach ($posts as $ko => $vo) {
                                $extra = array('head'=>Config::get('img_url').$v['logo'],'name'=>$v['nickname'],'time'=>date('H:i:s',time()),'type'=>5);
                                $content=array('content'=>$vo['info'],'extra'=>$extra);
                                $re = rongMsg(9999999,[$room_id],json_encode($content));
                            }
                        }
                    }
                    Cache::set('post_'.$room_id,1);
                }
            }
        }
    }


}