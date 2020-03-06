<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/10/30
 * Time: 11:08
 */
namespace app\api\controller;


use think\Cache;
use think\Config;
use think\Controller;
use think\Db;
use think\Request;


class Index extends Controller
{


	public function test(){
		
	}



    /**
     * 登陆
     */

    public function login(Request $request){

        $mobile     = $request->post('mobile');
        $password   = $request->post('password');
        if(!$mobile || !$password){
            json_return(204,'缺少参数');
        }
        $User = Db::name('member');
        $user_info =$User
            ->field('id,nickname,head,money,password,token,gm_name')
            ->where(array('mobile'=>$mobile))
            ->find();
        if(!$user_info){
            json_return(201,'用户不存在');
        }
        if(md5($password)!=$user_info['password']){
            json_return(201,'用户名密码错误');
        }else{
            if(!$user_info['gm_name']){
                $data['gm_name'] = 'ycgm'.$user_info['id'];
            }
            $data['token'] = md5(rand(0000,9999));
            $User->where(array('mobile'=>$mobile))->update($data);
            unset($user_info['password']);
            $user_info['token'] = $data['token'];
            $login_log['uid'] = $user_info['id'];
            $login_log['create_at'] = time();
            $login_log['ip'] = get_client_ip();
            $ip_address = Db::name('login_log')
                ->where(array('ip'=>$login_log['ip'] ))
                ->value('ip_address');
            if(!$ip_address){
            $ip_address =  get_city_id($login_log['ip']);
            }
            $login_log['ip_address'] = $ip_address;
            Db::name('login_log')->insert($login_log);
            json_return(200,'登录成功',$user_info);
        }

    }

    /**

     * 用户注册

     */

    public function register(Request $request){

        $mobile     = $request->post('mobile');

        $code       = $request->post('code');

        $password   = $request->post('password');

        $recommend_phone   = $request->post('recommend_phone');

        if(!$mobile || !$code || !$password){
            json_return(204,'缺少参数');
        }


        $Captcha = Db::name('captcha');

        $captcha_info = $Captcha->where(array('mobile'=>$mobile))->find();

        $true_code = $captcha_info['code'];

        if($true_code!=$code){
            json_return(201,'验证码错误');
        }

        $User = Db::name('member');

        $user_info = $User->where(array('mobile'=>$mobile))->find();

        if($user_info){
            json_return(201,'账号已经注册');
        }
        if($recommend_phone){
            $re_result = $User->where(array('mobile'=>$recommend_phone))->value('id');
            if($re_result){
                $data['tid']   = $re_result;
            }else{
                json_return(201,'推荐人不存在');
            }

        }
        //注册环信
        $Hx = new HX();

        $Hx->openRegister($mobile);
        
        $data['nickname']   = 'yicai' . rand(10000,99999);

        $data['mobile']     = $mobile;

        $data['password']   = md5($password);

        $data['create_at']  = time();

        $data['ip'] = get_client_ip();

        $data['token'] = md5(rand(0000,9999));

        if ( $User->insert($data)) {

            json_return(200,'注册成功,请登录');

        } else {

            json_return(201,'注册失败');

        }
    }

    /**

     *  发送短信验证码

     * */

    public function sendSms(Request $request){
        $mobile     = $request->post('mobile');
        if(!$mobile){
            json_return(204,'缺少参数');

        }

        $mobile = trim($mobile);
        if( strlen($mobile)!=11){
            json_return(201,'手机格号码式不正确');
        }
        //生成的随机数

        $mobile_code = random(4,1);

        //短信接口地址

        $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";

        $post_data = "account=C53947997&password=f53afbe8897259bffa85f9c98386fd76&mobile=".$mobile."&content=".rawurlencode("您的验证码是：".$mobile_code."。请不要把验证码泄露给其他人。");

        $gets =  xml_to_array(curlPost($post_data, $target));

        $Captcha = Db::name('captcha');

        $captcha_info = $Captcha->where(array('mobile'=>$mobile))->find();

        if($gets['SubmitResult']['code']==2){
            if($captcha_info){
                $save_data['code'] = $mobile_code;
                $save_data['time'] = time();
                $save_data['number'] = array("exp", "number+" . 1);

                $Captcha->where(array('mobile'=>$mobile))->update($save_data);
            }else{
                $add_data['code'] = $mobile_code;
                $add_data['time'] = time();
                $add_data['number'] = 1;
                $add_data['mobile'] = $mobile;

                $Captcha->insert($add_data);
            }

            json_return(200,'发送成功');
        }else{

            json_return(201,'发送失败');

        }

    }

    /**
     * 版本控制
     */
    public function get_version(Request $request){

        $app_id       = $request->post('app_id');
        $version_code = $request->post('version_code');

        if(!$app_id || !$version_code){
            json_return(204, '缺少参数');
        }

        $condition = array(
            'app_id'=>$app_id,
        );
        $condition0 = array(
            'app_id'=>$app_id,
            'version_code'=>$version_code
        );
        $version_info0 = Db::name('version')
            ->where($condition0)
            ->find();


        $version_info = Db::name('version')
            ->where($condition)
            ->order('id desc')
            ->find();

        if($version_info0){
            if($version_info0['is_stop']==1 || $version_info['is_forced']==1){//原版本停用，或者新版本强制更新
                if($version_code!=$version_info['version_code']){
                    $return_data['id_upload'] = 1;
                }
            }else{//新版本不强制更新
                $return_data['id_upload'] = 0;
            }
            if($version_code!=$version_info['version_code']){
                $return_data['is_new'] = 0;
            }else{
                $return_data['is_new'] = 1;
            }

        }else{//原版本不存在
            $return_data['id_upload'] = 1;
            $return_data['is_new']    = 1;
        }
        $return_data['version_info'] = $version_info;
        json_return(200, '成功',$return_data);


    }


    /**
     * 添加记录
     */

    public function add_back_detail($uid,$money,$my_money,$cate,$hall,$exp,$tid="",$is_check=""){
        $date = date("Ymd");
        if($exp==3){
            $explain = $date.'投注回水';
        }elseif ($exp==6){
            $explain = $date.'投注流水';
        }elseif ($exp==4) {
            $explain = $date.'代理回水';
        }
        $up_data["money"] = $my_money;
        if(!$is_check) {
            Db::name('member')->where(array('id' => $uid))->update($up_data);
        }
        if($tid){
            $save['proxy_uid'] = $tid;
        }
        if($is_check){
            $save['status'] = 1;
        }
        $save['uid']     =  $uid;
        $save['type']    = 1;
        $save['money']   = $money;
        $save['balance'] = $my_money;
        $save['exp']     = $exp;
        $save['explain'] =  $explain;
        $save['cate']    =  $cate;
        $save['hall']    =  $hall;
        $save['create_at'] = time();
        $result = Db::name('detail')->insert($save);
    }

    public function test(){
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

    public function test1(){
        $client = new \JPush\Client('4a998fe41bb56c6adfc6c2a3','00382559bc931004e9dd2d71');
        $client->push()
            ->setPlatform('all')
            ->addRegistrationId('1507bfd3f7c23006bdb')
            ->setNotificationAlert('恭喜您注册成功')
            ->send();
    }
    

   



    


}