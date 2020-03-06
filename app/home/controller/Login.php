<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/9/14
 * Time: 16:56
 */

namespace app\home\controller;


use app\admin\model\Members;
use think\Controller;
use think\Request;
use think\Db;

class Login extends Controller
{
    public function index(Request $request){
        if($request->isPost()){
          $data= $request->post();

          if(!captcha_check($data['verifyCode'])) {
              // 校验失败
              $this->error('验证码不正确');
          }

          if(!$data['username']){
              $this->error('请输入登陆账号');
          }
          if(!$data['password']){
              $this->error('请输入密码');
          }
          $info = Members::get(['gm_name'=>$data['username']]);
          if(!$info){
              $this->error('账号不存在');
          }
            if($info['password'] != md5($data['password'])){
                $this->error('密码错误');
            }
          if($info['m_status'] == 1){
              $this->error('账号已被冻结');
          }
          session('member_info',['uid'=>$info->id,'name'=>$info->gm_name,'is_proxy'=>$info->is_proxy,'proxy_id'=>$info->proxy_id,'is_temporary'=>0]);
          Members::where('id',$info->id)->update(['update_at'=>time(),'session_id'=>session_id()]);
          //create login log by hawk at 2018/4/2
          $LogData['uid']=$info->id;
          $LogData['ip']=get_client_ip();
          $LogData['ip_address']=get_city_id(get_client_ip());
          $LogData['create_at'] = time();
          $result=Db::name('login_log')->insert($LogData);
            $this->success('登入成功',url('Index/agree'));
        }else{
            return view();
        }
    }
    public function reg(Request $request){
        $id = input('param');
        if(empty($id)){
            $this->error('本平台不支持自行注册！',url('index'));
        }
        if($request->isPost()){
            $data= $request->post();
            if(!captcha_check($data['verifyCode'])) {
                // 校验失败
                $this->error('验证码不正确');
            }
            $validate = validate('Member');
            if(!$validate->scene('link_reg')->check($data)){
                $this->error($validate->getError());
            };
            $param = $data['param'];
            $addLinkData = Db::name('add_link')->where('param',$param)->find();
            if(!$addLinkData){
                $this->error('邀请链接有误');
            }
            if(empty($data['qq'])){
                $this->error('qq号码不能为空');
            }
            $member = new Members();
            $whereData['gm_name'] = $data['username'];
            $ismem = $member->where($whereData)->value('id');
            if($ismem) {
                $this->error('登陆账号已存在');
            }else{
                Db::startTrans();
                try {
                    $userInfo = $member->where('id',$addLinkData['uid'])->field('id,rebate,bonus,proxy_ids,back_rebate')->find();
                    $insertData['password'] = md5($data['password']);
                    $insertData['qq'] = $data['qq'];
                    $insertData['gm_name'] = $data['username'];
                    $insertData['is_proxy'] = $addLinkData['is_agent'];
                    $insertData['proxy_id'] = $addLinkData['uid'];
                    $insertData['rebate'] = $addLinkData['rebate'];
                    $insertData['bonus'] = $addLinkData['bonus'];
                    $insertData['proxy_rebate'] = $userInfo['rebate'];
                    $insertData['proxy_bonus'] = $userInfo['bonus'];
                    $insertData['back_rebate'] = $addLinkData['back_rebate'];
                    $insertData['proxy_back_rebate'] = $userInfo['back_rebate'];
                    $insertData['create_at'] = time();
                    if($userInfo['proxy_ids']){
                        $insertData['proxy_ids'] = $userInfo['proxy_ids'].','.$userInfo['id'];
                    }else{
                        $insertData['proxy_ids'] = $userInfo['id'];
                    }
                    $res = $member->allowField(true)->insertGetId($insertData);
                    $updateData['junior_num'] = array('exp','junior_num+1');
                    $updateData['junior_ids'] = array('exp','concat(junior_ids,",'.$res.'")');
                    $updateWhereData['id'] = array('in',$insertData['proxy_ids']);
                    $member->where($updateWhereData)->update($updateData);
                    Db::commit();
                } catch (\Exception $e) {
                    // 回滚事务
                    Db::rollback();
                    $returnData['code'] = 0;
                    $returnData['msg'] = '注册失败,请稍后再试';
                    return json($returnData);
                }
                $returnData['code'] = 1;
                $returnData['msg'] = '账号注册成功';
                $returnData['url'] = url('index');
                return json($returnData);
            }
        }else{
            $this->assign('id',$id);
            return view();
        }
    }

    public function freeTry(){
        exit();
        $insertData['password'] = md5('xinhui123');
        $insertData['gm_name'] = '游客'.date('Md').mt_rand(1,9999);
        $insertData['is_temporary'] = 1;
        $insertData['is_proxy'] = 0;
        $insertData['money'] = 10000;
        $insertData['gm_name'] = '游客'.date('Md').mt_rand(1,9999);
        $insertData['update_at'] = time();
        $insertData['create_at'] = time();
        $res = Db::name('member')->insertGetId($insertData);
        if($res){
            session('member_info',['uid'=>$res,'name'=>$insertData['gm_name'],'is_proxy'=>0,'proxy_id'=>0,'is_temporary'=>1]);
            $this->success('登入成功',url('Index/index'));
        }else{
            $this->error('服务器繁忙，请稍后再试');
        }
    }
    //发送短信
    public function send(Request $request){
        $data = $request->post();
        $type ='Reg.'.$data['type'];
        $result = $this->validate($data,$type);
        if(true !== $result){
            $this->error($result);
        }
        $str = str_shuffle(1234567890);
        $yzm = substr($str, 0, 6);
        $sendUrl = 'http://v.juhe.cn/sms/send'; //短信接口的URL
        $smsConf = array(
            'key'   => '6126e416e0ed643830b6e4ff3fd681fc', //您申请的APPKEY
            'mobile'    => $data['tel'],
            'tpl_id'    => '52225',
            'tpl_value' =>'#code#='.$yzm //您设置的模板变量，根据实际情况修改
        );
        $content = juhecurl($sendUrl,$smsConf,1); //请求发送短信
        if($content){
            $result = json_decode($content,true);
            $error_code = $result['error_code'];
            if($error_code == 0){
                //状态为0，说明短信发送成功
                session('reg.yzm_'. $data['tel'], $yzm);
                session('reg.yzm_time_'. $data['tel'],time()+300);
                return json(['status'=>1,'msg'=>'发送成功,请注意查收']);
            }else{
                //状态非0，说明失败
                $msg = $result['reason'];
                return json(['status'=>0,'msg'=>$msg]);
            }
        }else{
            return json(['status'=>0,'msg'=>'请求发送短信失败']);
        }

    }
    /*忘记密码
     * */
    public function forget(Request $request){
        if($request->isPost()){
            $data= $request->post();
            $result = $this->validate($data,'Reg.forgets');
            if(true !== $result){
                $this->error($result);
            }
            $time = session('reg.yzm_time_'.$data['tel'])-time();
            if($time<=0){
                $this->error('验证已失效');
            }
            if(session('reg.yzm_'.$data['tel']) !== $data['code']){
                $this->error('验证码不正确');
            }
            $member = new Members();
            $info = $member->where('tel',$data['tel'])->find();
            if(!$info){
                $this->error('该用户不存在');
            }
            $res = $member->allowField(true)->save(['password'=>$data['password']],['id'=>$info['id']]);
            if($res){
                $this->success('修改成功',url('index'));
            }else{
                $this->error('修改失败');
            }
        }else{
            return view();
        }
    }
    public function out(){
        session('member_info',null);
        $this->redirect('Login/index');
    }
}