<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/9/4
 * Time: 9:36
 */

namespace app\admin\controller;


use app\admin\model\Cash;
use app\admin\model\Detail;
use app\admin\model\Members;
use app\admin\model\Recharge;
use think\Db;
use think\Request;

class Game extends Admin
{

    /**
     * AG/BB记录
     */
    public function index(Request $request){
        $from    = $request->param('from');
        $to      = $request->param('to');
        $id      = $request->param('id');
        $mobile  = $request->param('mobile');
        $w =[];
        if($from && $to){
            $from = strtotime($from);
            $to   = strtotime($to);
            $w['create_at'] = [['>=',$from],['<=',$to]];
        }
        $w['exp'] = 7;
        if($id){
            $w['uid']  = $id;
        }
        if($mobile ){
            if(is_numeric($mobile)) {
                $Members = new Members();
                $uid = $Members->get_mobile_id($mobile);
                if (!$uid) {
                    $this->error_new('用户不存在');
                } else {
                    $w['uid'] = $uid;
                }
            }else{
                $uid = Db::name('member')->where(array('gm_name'=>$mobile))->value('id');
                if (!$uid) {
                    $this->error_new('用户不存在');
                } else {
                    $w['uid'] = $uid;
                }
            }
        }
        $list = Detail::where($w)->order('id desc')->paginate(20);
        return view('',[
            'list' =>$list,
            'page' =>$list->render(),
        ]);

    }
    /**
     * 修改流水状态
     */
    public function edit_water_status(Request $request){
        $type   = $request->post('type');
        $uid    = $request->post('uid');
        $id     = $request->post('id');

        Db::startTrans();
        try{
            if($type==1) {
                $result_up = Db::name('detail')->where(array('id' =>$id))->update(array('status' => 2));
                $money     = Db::name('detail')->where(array('id' =>$id))->value('money');
                $up_data["money"] = array("exp", "money+" . $money);
                $result = Db::name('member')->where(array('id'=>$uid))->update($up_data);
            }
            if($type==2) {
                $result_up = Db::name('detail')->where(array('id' =>$id))->update(array('status' => 3));
            }
        }catch (\Exception $e){
            Db::rollback();
            json_return(500,'失败');
        }
        if($result_up){
            Db::commit();
            json_return(200,'成功');
        }else{
            Db::rollback();
            json_return(500,'失败');
        }
    }


}