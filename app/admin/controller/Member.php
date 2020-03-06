<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/9/1
 * Time: 10:04
 */

namespace app\admin\controller;
use app\admin\model\Cash;
use app\admin\model\LoginLog;
use app\admin\model\Members;
use app\admin\model\Recharge;
use think\Db;
use think\Request;


class Member extends Admin
{
    /**
     * 会员信息首页
     */

    public function index(Request $request){
        $w=[];
        $gm_name = $request->param('gm_name');
        $is_temporary    = $request->param('is_temporary');
        if($gm_name){
            $w['gm_name']=$gm_name;
        }
        if($is_temporary){
            $w['is_temporary']   = $is_temporary;
        }else{
            $w['is_temporary']   = 0;
        }
        $from   = $request->param('from');
        $to     = $request->param('to');
        $uid    = $request->param('uid');
        $t_uid    = $request->param('t_uid');
        $junior_ids    = urldecode($request->param('junior_ids'));

        if($from && $to){
            $from = strtotime($from);
            $to = strtotime($to);
            $w['create_at'] = [['>=',$from],['<=',$to]];
        }

        if($uid){
            $w['id']    =$uid;
        }
//        if($t_uid){
//            $w['tid']   =$t_uid;
//        }

        if($junior_ids){
            $w['id'] = array('in',$junior_ids);
        }
        $list = Members::where($w)->order('id desc')->paginate(20,false,['query'=>request()->param()]);
        $data = $list->all();
        $login_array = cache('login_array');
        foreach ( $data as $k=>$v){
            if (isset($login_array['uid_'.$v['id']])){
                $time = $login_array['uid_'.$v['id']];
                if ($time > time()){
                    $data[$k]['onLine'] ='在线';
                }else{
                    $data[$k]['onLine'] ='离线';
                }
            }else{
                $data[$k]['onLine'] = '离线';
            }
            if($v['proxy_id']!=0){
                $dl_name = Db::name('member')
                    ->where(array('id' => $v['proxy_id']))
                    ->value('gm_name');
                $v['dl_name'] = $dl_name;
            }else{
                $v['dl_name'] = '';
            }
            $list[$k] = $v;
        }
        $onlineNum = 0;

        foreach ($login_array as $k2=>$v2){
            if($v2>time()){
                $onlineNum ++;
            }
        }
        $expList = Db::name('detail_exp')->select();
        return view('index',[
            'onlineNum'=>$onlineNum,
            'list'=>$list,
            'expList'=>$expList,
            'page'=>$list->render(),
        ]);
    }
    /**
     * 查看会员信息
     */
    public function show_list(Request $request){
        $id = $request->param('id');
        $info = Members::get($id);
        if($info['proxy_rebate']==0){
            $info['proxy_rebate']=10;
        }
        $whereData2['rebate'][] = array('lt',$info['proxy_rebate']);
        $uids = explode(',',$info['junior_ids']);
        $rebate = Db::name('member')->where('id','in',$uids)->where('is_temporary',0)->where('m_status',0)->max('rebate');
        if(empty($rebate)){
            $rebate = 0;
        }
        $whereData2['rebate'][] = array('egt',$rebate);
        $rebate_list = Db::name('rebate_list')->where($whereData2)->select();
        return view('edit',[
            'info'=>$info,
            'rebate_list'=>$rebate_list,
        ]);
    }
    /**
     * 改变机器人开启关闭状态
     */

    public function edit_open(Request $request){
        $id     = $request->post('id');
        $status = $request->post('status');
        $result = Db::name('robot')
            ->where(array('id'=>$id))
            ->update(array('status'=>$status));
        if($result){
            json_return(200,'成功');
        }else{
            json_return(500,'失败');
        }
    }


    /**
     * 修改会员信息
     */

    public function edit(Request $request){

        if($request->isPost()){
            $data = $request->post();
            if(empty($data['gm_name'])){
                $this->error_new('账号不能为空');
            }
            $Member = new Members();
            //$rebateArr = explode(',',$data['rebate']);
//            $data['rebate'] = $rebateArr[0];
//            $data['bonus'] = $rebateArr[1];
            $data['is_proxy'] = $data['agent_user'];
            $whereData['gm_name'] = $data['gm_name'];
            $whereData['id'] = array('neq',$data['id']);
            $a = $Member->where($whereData)->find();
            if(!empty($a)){
                $this->error_new('已存在用户');
            };
            $validate = validate('User');
            if(!empty($data['repassword'])){
                $checkData['password'] = $data['repassword'];
                if(!$validate->scene('resetPass')->check($checkData)){
                    $this->error_new($validate->getError());
                };
                $data['password'] = $data['repassword'];
            }
            if(!empty($data['remoney_password'])){
                $checkData['moneyPass'] = $data['remoney_password'];
                if(!$validate->scene('resetMoneyPass')->check($checkData)){
                    $this->error_new($validate->getError());
                };
                $data['money_password'] = md5($data['remoney_password']);
            }

            $Member = new Members();
            $map=array(
                'id'=>$data['id']
            );
            $info = $Member->get($data['id']);
            $uids = explode(',',$info['junior_ids']);
            $back_rebate = Db::name('member')->where('id','in',$uids)->where('is_temporary',0)->where('m_status',0)->max('back_rebate');
            if(empty($back_rebate)){
                $back_rebate = 0;
            }
            if($data['agent_user']==0){
                if($data['back_rebate']>0){
                    $this->error_new('会员返点只能为0');
                }
            }
            if($data['back_rebate']<$back_rebate){
                $this->error_new('返点不可低于'.$back_rebate);
            }
            if(!empty($info['proxy_back_rebate']) && $data['back_rebate']>$info['proxy_back_rebate']){
                $this->error_new('返点不可高于'.$info['proxy_back_rebate']);
            }
            $result=$Member->allowField(true)->editData($map,$data);
            Db::name('member')->where('proxy_id',$data['id'])->update(['proxy_back_rebate'=>$data['back_rebate']]);
            if ($result) {
                $this->success_new('修改成功',url('Admin/member/index'));
            }else{
                $this->error_new('修改失败');
            }
        }
    }


    /**
     * 登陆日志
     */
    public function login_log(Request $request){
        $mobile = $request->param('mobile');
        $from   = $request->param('from');
        $to     = $request->param('to');
        $w = [];
        if($from && $to){
            $from = strtotime($from);
            $to = strtotime($to);
            $w['a.create_at'] = [['>=',$from],['<=',$to]];
        }
        if($mobile){
            $uid = Members::where(array('mobile'=>$mobile))->value('id');
            $w['a.uid'] = $uid;
        }

        $w['a.type']=1;
        $gm_name = $request->param('gm_name');
        if($gm_name){
            $w['b.gm_name']=$gm_name;
        }
        $is_temporary    = $request->param('is_temporary');

        if($is_temporary){
            $w['b.is_temporary']   = $is_temporary;
        }else{
            $w['b.is_temporary']   = 0;
        }
        $list = LoginLog::where($w)
            ->alias('a')
            ->join('member b','a.uid = b.id')
            ->field('a.*,b.gm_name')
            ->order('id desc')->paginate(20,false,['query'=>request()->param()]);
        return view('login_log',[
            'list'=>$list,
            'page'=>$list->render(),
        ]);
    }
    
    /**
     * 冻结用户
     */
    public function edit_frozen(Request $request){
        $id = $request->post('id');
        $data['m_status'] =1;
        $result = Db::name('member')->where(array('id'=>$id))->update($data);
        add_member_msg($id,'您的账号已被冻结，有任何疑意，请联系客服!');
        if($result){
            json_return(200,'成功');
        }else{
            json_return(500,'失败');
        }

    }
    /**
     * 解冻用户
     */
    public function edit_unfreeze(Request $request){
        $id = $request->post('id');
        $data['m_status'] =0;
        $result = Db::name('member')->where(array('id'=>$id))->update($data);
        add_member_msg($id,'恭喜您,您的账号已解冻!');
        if($result){
            json_return(200,'成功');
        }else{
            json_return(500,'失败');
        }

    }

    /**
     * 删除用户
     */
    public function del(Request $request){
        $id          = $request->param('id');
        //$user_info   = Db::name('member')->where(array('id'=>$id))->find();
        //$insert_info = Db::name('member_bak')->insert($user_info);
        $result      = Db::name('member')->where(array('id'=>$id))->delete();
        if ($result) {
            $this->success_new('删除成功',url('Admin/member/index'));
        }else{
            $this->error_new('删除失败');
        }
    }

    /**
     * 机器人信息
     */
    public function robot(Request $request){
        $cate    = $request->param('cate');
        $hall    = $request->param('hall');
        $w=[];
        if($cate){
            $w['r.cate'] = $cate;
        }
        if($hall){
            $w['r.hall'] = $hall;
        }
        $list = Db::name('robot')
            ->alias('r')
            ->field('r.*,c.name as cate_name,h.name as hall_name')
            ->join('dl_cate c','r.cate=c.id')
            ->join('dl_hall h','h.cate=r.cate and h.hall=r.hall')
            ->where($w)
            ->order('r.id desc')
            ->paginate(20);
        $cates = Db::name('cate')->select();
        return view('robot',[
            'cates'=>$cates,
            'list'=>$list,
            'page'=>$list->render(),
        ]);
    }
    /**
     * 添加机器人信息
     */
    public function add_robot(Request $request){
        $data = $request->post();
        $result=Db::name('robot')->insert($data);
        if ($result) {
            $this->success_new('添加成功',url('Admin/member/robot'));
        }else{
            $this->error_new('添加失败');
        }
    }
    /**
     * 查看机器人信息
     */
    public function robot_show(Request $request){
        $id = $request->param('id');
        $info = Db::name('robot')->where(array('id'=>$id))->find();
        $cates = Db::name('cate')->select();
        return view('robot_edit',[
            'cates'=>$cates,
            'data'=>$info
        ]);
    }

    /**
     * 修改机器人信息
     */
    public function robot_edit(Request $request){
        if($request->isPost()){
            $data = $request->post();
            $map=array(
                'id'=>$data['id']
            );
            $result=Db::name('robot')->where($map)->update($data);
            if ($result) {
                $this->success_new('修改成功',url('Admin/member/robot'));
            }else{
                $this->error_new('修改失败');
            }
        }
    }

    /**
     * 添加会员
     */
    public function add(Request $request){
        if($request->isPost()){
            $data = $request->post();
            if(empty($data['gm_name'])){
                $this->error('账号不能为空');
            }
            $data['ip'] = get_client_ip();
            $Member = new Members();
//            $rebateArr = explode(',',$data['rebate']);
//            $data['rebate'] = $rebateArr[0];
//            $data['bonus'] = $rebateArr[1];
            $data['is_proxy'] = $data['agent_user'];
            $whereData['gm_name'] = $data['gm_name'];
            //$whereData['nickname'] = $data['nickname'];
            $a = $Member->where($whereData)->find();
           if(!empty($a)){
               $this->error('已存在用户');
           };
            if($data['agent_user']==0 && $data['back_rebate']!=0){
                $this->error_new('会员返点只能为0');
            }
            $result=$Member->allowField(true)->addData($data);
            if ($result) {
                $this->success('添加成功',url('Admin/member/index'));
            }else{
                $this->error('添加失败');
            }
        }

        $list = Db('rebate_list')->cache(true,60)->select();
        return view('',[
            'list'=>$list,
        ]);
    }
    /**
     * 银行列表
     */
    public function bank(Request $request){
        $gm_name = $request->param('gm_name');
        $w=[];
        if($gm_name){
            $w['m.gm_name']=$gm_name;
        }
        $list = Db::name('user_card')
            ->alias('c')
            ->field('c.*,m.gm_name')
            ->join('dl_member m','c.uid=m.id')
            ->where($w)
            ->paginate(20,false,['query'=>request()->param()]);
        return view('',[
            'list'=>$list,
            'page'=>$list->render(),
        ]);
    }
    /**
     * 绑定银行卡修改
     */
    public function bank_edit(Request $request){
        if($request->isPost()){
            $data = $request->param();
            $insertData['bank'] = $data['bank'];
            $insertData['bank_branch'] = $data['bank_branch'];
            $insertData['num'] = $data['num'];
            $insertData['create_at'] = time();
            $insertData['name'] = $data['name'];
            $result = Db::name('user_card')->where('id',$data['id'])->update($insertData);
            if ($result) {
                $this->success_new('修改成功',url('Admin/member/bank'));
            }else{
                $this->error_new('修改失败');
            }

        }else{
            $id =$request->param('id');
            $info = Db::name('user_card')
                ->where('id',$id)
                ->find();
            $banks = Db::name('banks')
                ->select();
            return view('',[
                'info'=>$info,
                'banks'=>$banks,
            ]);
        }
    }
    /**
     * 支付宝列表
     */
    public function zfb(Request $request){
        $gm_name = $request->param('gm_name');
        $w=[];
        if($gm_name){
            $w['m.gm_name']=$gm_name;
        }
        $list = Db::name('user_card2')
            ->alias('c')
            ->field('c.*,m.gm_name')
            ->join('dl_member m','c.uid=m.id')
            ->where($w)
            ->paginate(20,false,['query'=>request()->param()]);
        return view('',[
            'list'=>$list,
            'page'=>$list->render(),
        ]);
    }
    /**
     * 绑定银行卡修改
     */
    public function zfb_edit(Request $request){
        if($request->isPost()){
            $data = $request->param();
            $insertData['num'] = $data['num'];
            $insertData['create_at'] = time();
            $insertData['name'] = $data['name'];
            $result = Db::name('user_card2')->where('id',$data['id'])->update($insertData);
            if ($result) {
                $this->success_new('修改成功',url('Admin/member/zfb'));
            }else{
                $this->error_new('修改失败');
            }

        }else{
            $id =$request->param('id');
            $info = Db::name('user_card2')
                ->where('id',$id)
                ->find();
            return view('',[
                'info'=>$info,
            ]);
        }
    }
}