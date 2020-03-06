<?php
namespace app\admin\controller;
use think\Cache;
use think\Db;
use think\Request;


/**
 * 操作记录类
 *
 * Class OperationController
 * @package Admin\Controller
 */
class Operation extends Admin {
    /**
     * 显示操作记录
     */
    public function showlist(Request $request)
    {
        $begin_time = $request->get('from');
        $end_time   = $request->get('to');

        $operation_obj = new \Net\Operation();
        $where = [];
        if ($begin_time || $end_time){
            if ($begin_time){
                $where['operation_time'] = array('>',$begin_time);

                $this ->assign('begin_time',$begin_time);
            }
            if ($end_time){
                $where['operation_time'] = array('<',$end_time);
                $this ->assign('end_time',$end_time);
            }
        }
//        $per = 60;
//        $log_count  = count($operation_obj->logList($where));
//        $page = new \Page\Page($log_count, $per);
//        $log_list  = $operation_obj->logList($where,$page->limit);
//
//        if ($log_list) {
//            $this ->assign('log_list',$log_list);
//            $this ->assign('pagelist',$page ->fpage());
//        } else {
//            $this ->assign('pagelist','暂无数据');
//        }
        $log_list = Db::name('operation_log')
            ->alias('o')
            ->field('o.*,u.username')
            ->join('dl_user u','u.id = o.operation_uid')
            ->order('o.id desc')
            ->paginate(30);

        $list = $log_list->all();
        foreach ( $list as $k=>$v){
            $cz = strtolower('admin/'.	$v['operation_node']);
            $do_name =  Db::name('auth_rule')
                ->where('name',$cz)
                ->value('title');
            if(!$do_name){
                $do_name = '未可知';
            }
            $v['do_name'] = $do_name;
            $log_list[$k] = $v;
        }
        return view('showlist',[
            'log_list'=>$log_list,
            'page'=>$log_list->render(),
        ]);

    }

    /**
     * 定义方法
     *
     * 删除时间段操作记录
     *
     * @param $d_begin_time string 开始时间
     * @param $d_end_time string 结束时间
     */
    public function del($d_begin_time,$d_end_time)
    {
        if (!$d_begin_time) {
            echo '<script>alert(\'请输入删除开始时间!\');history.back()</script>';
            return false;
        } elseif(!$d_end_time) {
            echo '<script>alert(\'请输入删除结束时间!\');history.back()</script>';
            return false;
        }
        $where['time'] = array('egt',strtotime($d_begin_time,' 00:00:00'));
        $where['time'] = array('elt',strtotime($d_end_time.' 23:59:59'));
        $result = M('operation_log') ->where($where) ->delete();
        if ($result) {
            echo '<script>alert(\'删除记录成功!\');history.back()</script>';
        } else {
            echo '<script>alert(\'删除记录失败!\');history.back()</script>';
        }
    }

    /**
     * 软件参数设置
     */
    public function index(){
        $data = Db::name('setting')->select()[0];
        return view('',[
            'data'=>$data,
        ]);
    }
    /**
     * 修改系统参数
     */
    public function edit(Request $request){
        if($request->isPost()){
            $data = $request->post();
            $map=array(
                'id'=>$data['id']
            );
            $result=Db::name('setting')->where($map)->update($data);
            if ($result) {
                $this->success_new('修改成功',url('Admin/operation/index'));
            }else{
                $this->error_new('修改失败');
            }
        }
    }

    /**
     * 根据IP获取地址
     */
    public function get_addr(Request $request){
        $ip = $request->param('ip');
        $addr = get_city_id($ip);
        Cache::store('redis')->set($ip,$addr);
        $data['operation_addr'] = $addr;
        $result = Db::name('operation_log')
            ->where(array('operation_ip'=>$ip,'operation_addr'=>0))
            ->update($data);
        if ($result) {
            $this->success_new('获取成功',url('Admin/operation/showlist'));
        }else{
            $this->error_new('获取失败');
        }
    }

    /**
     * 删除数据
     */
    public function sc_show(){
        return view('do_delete',[

        ]);
    }

    /**
     * 删除数据
     */
    public function do_delete(Request $request){
        $id  = $request->post('id');
        $day = $request->post('day');


        if($id==4){
            $del_day = "-".$day." day";
            $del_time = date("Y-m-d",strtotime($del_day));
            for($i=1;$i<=10;$i++){
                switch ($i){
                    case 1:
                        $table_name = "at_eight";
                        break;
                    case 2:
                        $table_name = "at_canada";
                        break;
                    case 3:
                        $table_name = "at_car";
                        break;
                    case 4:
                        $table_name = "at_airship";
                        break;
                    case 5:
                        $table_name = "at_ssc";
                        break;
                    case 6:
                        $table_name = "at_tjssc";
                        break;
                    case 7:
                        $table_name = "at_gd10";
                        break;
                    case 8:
                        $table_name = "at_cq10";
                        break;
                    case 9:
                        $table_name = "at_fast";
                        break;
                    case 10:
                        $table_name = "at_gd11";
                        break;
                    case 11:
                        $table_name = "at_hk";
                        break;
                }
                Db::name($table_name)->where('create_time','<',$del_time)->delete();
            }

        }

        if($id==3){
            $del_day = "-".$day." day";
            $del_time = date("Y-m-d",strtotime($del_day));
            $table_name = "operation_log";
            Db::name($table_name)->whereTime('operation_time','<',$del_time)->delete();

        }
        if(in_array($id,[1,2,5,6,7])) {
            $del_day = "-".$day." day";
            $del_time =strtotime($del_day);
            if ($id == 1) {
                $table_name = "member";
            }
            if ($id == 2) {
                $table_name = "login_log";
            }
            if ($id == 5) {
                $table_name = "recharge";
            }
            if ($id == 6) {
                $table_name = "withdrawals";
            }
            if ($id == 7) {
                $table_name = "single";
            }
            Db::name($table_name)->where('create_at', '<', $del_time)->delete();
        }
        json_return(200,'删除成功');
    }

    /**
     * 验证码
     */
    public function qrcode(Request $request){
        $type = $request->param('type');
        $w = [];
        if($type){
            $w['type'] = $type;
        }
        $data = Db::name('qrcode')
            ->where($w)
            ->order('id desc')
            ->select();
        return view('',[
            'data'=>$data
        ]);
    }

    /**
     * 编辑验证码
     */
    public function qrcode_show(Request $request){
        $id = $request->param('id');
        $data = Db::name('qrcode')
            ->where(array('id'=>$id))
            ->find();
        return view('qrcode_edit',[
            'data'=>$data
        ]);
    }

    /**
     * 编辑验证码
     */
    public function qrcode_edit(Request $request){
        if($request->isPost()){
            $data = $request->post();
            $map=array(
                'id'=>$data['id']
            );
            $result=Db::name('qrcode')->where($map)->update($data);
            if ($result) {
                $this->success_new('修改成功',url('Admin/operation/qrcode'));
            }else{
                $this->error_new('修改失败');
            }
        }
    }

    /**
     * 删除二维码
     */
    public function qrcode_del(Request $request){
        $id = $request->param('id');
        $result = Db::name('qrcode')
            ->where(array('id'=>$id))
            ->delete();
        if ($result) {
            $this->success_new('删除成功',url('Admin/operation/qrcode'));
        }else{
            $this->error_new('删除失败');
        }
    }

    /**
     * 添加二维码
     */
    public function qrcode_add(Request $request){
        if($request->isPost()){
            $data = $request->post();
            //return json($data);
            $result=Db::name('qrcode')->insert($data);
            if ($result) {
                $this->success_new('添加成功',url('Admin/operation/qrcode'));
            }else{
                $this->error_new('添加失败');
            }
        }
    }

    /**
     * 额度转换
     */
    public function quota(){
        $data = Db::name('star')
            ->select();
        return view('',[
            'data'=>$data
        ]);
    }

    /**
     * 额度转换编辑
     */
    public function quota_edit(Request $request){
        $id        = $request->param('id');
        $up        = $request->param('up');
        $result = Db::name('star')
            ->where('id',$id)
            ->update(['up'=>$up]);
        if ($result) {
            json_return(200,'修改成功');
        }else{
            json_return(500,'修改失败');
        }

    }

    public function upload_one(){
        if($this->request->isPost()){
            //接收参数
            $images = $this->request->file('file');

            //计算md5和sha1散列值，TODO::作用避免文件重复上传
            $md5 = $images->hash('md5');
            $sha1= $images->hash('sha1');

            //判断图片文件是否已经上传
            $img = Db::name('qrcode')->where(['md5'=>$md5,'sha1'=>$sha1])->find();//我这里是将图片存入数据库，防止重复上传
            if(!empty($img)){
                return json(['status'=>1,'msg'=>'上传成功','data'=>['picd'=>$img['id'],'pic'=>$this->request->root(true).'/'.$img['path']]]);
            }else{
                // 移动到框架应用根目录/public/uploads/picture/目录下
                $imgPath = 'public' . DS . 'uploads' . DS . 'picture';
                $info = $images->move(ROOT_PATH . $imgPath);
                $path = 'uploads/picture/'.date('Ymd',time()).'/'.$info->getFilename();
                return json(['status'=>1,'msg'=>'上传成功','data'=>['picd'=>1,'pic'=>$this->request->root(true).'/'.$path]]);
//                $data = [
//                    'qrcode' => $path,
//                    'path' => $path ,
//                    'md5' => $md5 ,
//                    'sha1' => $sha1 ,
//                    'status' => 1 ,
//                    'create_at' => time() ,
//                ];
//                if($img_id=Db::name('qrcode')->insertGetId($data)){
//                    return json(['status'=>1,'msg'=>'上传成功','data'=>['picd'=>$img_id,'pic'=>$this->request->root(true).'/'.$path]]);
//                }else{
//                    return json(['status'=>0,'msg'=>'写入数据库失败']);
//                }
            }
        }else{
            return ['status'=>0,'msg'=>'非法请求!'];
        }
    }
}