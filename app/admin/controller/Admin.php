<?php
namespace app\admin\controller;

use think\Cache;
use think\Config;
use think\Controller;
use think\Db;
use think\Request;

class admin extends Controller
{
    public function _initialize()
    {
        //判断是否登入成功
        if(!isAdminLogin()){
            $this->redirect('Login/index');
        }
        $request = Request::instance();
        $moduleName     = $request->module();
        $controllerName = $request->controller();
        $actionName     = $request->action();
        $menu_list      = $this->getMenuList();

        //判断权限
//        $auth=new \Auth\Auth() or die('加载auth类失败');
//        $rule_name=$moduleName.'/'.$controllerName.'/'.$actionName;
//
//
//        $result=$auth->check($rule_name,session('info.id'));
//        if(!$result){
//            echo '<script>alert(\'对不起,您的权限不足!\');history.go(-1)</script>';exit;
//        }
        //记录日志
        $operation_obj = new \Net\Operation();
        if (preg_match('/add|save|saveEdit|delete|edit|del|dj(.*)?/', $actionName)) {
            $operation_obj->writeLog();
        }

        $this->assign('menu_list',$menu_list);
        $this->assign('controllerName',strtolower($controllerName));
        $this->assign('actionName',strtolower($actionName));

    }
    /**
     * 上传一张图片
     */
    public function upload_one(){
        $file = request()->file('file');
        if(!$file){
            $data = array("status" =>0,"error" => '请选择上传图片');
            echo json_encode($data);
            exit;
        }
        $path = ROOT_PATH . 'public' . DS . 'uploads'. DS .'cate_img';
        $info = $file->move($path);
        if($info){
            $picd = 'cate_img/'.$info->getSaveName();
            $pic = Config::get('img_url').$picd;
            $data = array("status" =>1,"pic" => $pic,'picd'=>$picd);
            echo json_encode($data);
            exit;
        }else{
            $data = array("status" =>0,"error" => '上传图片失败');
            echo json_encode($data);
            exit;
        }
    }

    public function test(){
        $data = Db::name('right')->where(array('pid'=>0,'status'=>1))->select();
        foreach($data as $k=>$v){
            $child = Db::name('right')->where(array('pid'=>$v['id'],'status'=>1))->select();
            if($child){
                $data[$k]['sub_menu'] = $child;
            }
        }
        var_dump($data);exit;
    }
    /**
     * 获取菜单列表
     * @return array
     */
    public function getMenuList(){
        $uid = session('info.id');
        if($uid==1){
            $menu_list = $this->getAllMenu();
        }else {

            $group_ids = Db::name('auth_group_access')->where(array('uid' => $uid))->column('group_id');

            $group_rules = Db::name('auth_group')->where('id', 'in', $group_ids)->select();

            $rules = "";

            foreach ($group_rules as $k => $v) {
                if ($k == 0) {
                    $rules = $v['rules'];
                }else {
                    $rules .= "," . $v['rules'];
                }
            }
            $rules = explode(',', $rules);

            $rules = array_unique($rules);
            $rule_name = Db::name('auth_rule')->where('id', 'in', $rules)->field('name')->select();
            $rule_use = [];
            foreach ($rule_name as $vv) {
                $rule_use[] = strtolower($vv['name']);
            }
            foreach ($rule_use as $vv) {
                $arr = explode('/',$vv);
                $rule_use[] = 'admin/'.$arr[1].'/index';
            }
            $rule_use = array_unique($rule_use);
            $menu_list = $this->getAllMenu();
            foreach ($menu_list as $k => $v) {
                $url = 'admin/' . $v['control'] . '/' . $v['act'];
                if (!in_array($url, $rule_use)) {
                    unset($menu_list[$k]);
                }else{
                    foreach ($menu_list[$k]['sub_menu'] as $k2=>$v2){
                        $url2 = 'admin/' . $v2['control'] . '/' . $v2['act'];
                        if (!in_array($url2, $rule_use)) {
                            unset($menu_list[$k]['sub_menu'][$k2]);
                        }
                    }
                }

            }
        }
        return $menu_list;
    }
    /**
     * 菜单列表详情
     * @return array
     */
    public function getAllMenu(){
        $data = Db::name('right')->where(array('pid'=>0,'status'=>1))->order('sort asc')->select();
        foreach($data as $k=>$v){
            $child = Db::name('right')->where(array('pid'=>$v['id'],'status'=>1))->select();
            if($child){
                $data[$k]['sub_menu'] = $child;
            }
        }
        return $data;
    }

    /**
     *添加充值记录
     */
    public function add_charge_detail($uid,$money,$type=1){
        if($type==1){
           $explain = "后台充值";
        }elseif($type==2){
           $explain = "线下充值";
        }
        $my_money = Db::name('member')->where(array('id'=>$uid))->value('money');
            $save['uid']     = $uid;
            $save['type']    = 1;
            $save['money']   = $money;
            $save['balance'] = $my_money;
            $save['exp']     = 1;
            $save['explain'] =  $explain;
            $save['create_at'] = time();
        $result = Db::name('detail')->insert($save);
        return $result;

    }

    /**
     * 定义方法
     *
     * 重写thinkphp跳转成功方法
     *
     * @param string $message
     * @param string $uri
     * @param bool|mixed $param
     */
    public function success_new($message,$uri="",$param = [])
    {
        if ($uri) {
            $param_str = '';
            if($param) {
                foreach ($param as $k => $v) {
                    $param_str .= '/' . $k . '/' . $v;
                }

                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><script>alert(\'' . $message . '\');location=\'' . $uri . $param_str . '\'</script>';
            }else{
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><script>alert(\'' . $message . '\');location=\'' . $uri .  '\'</script>';
            }
        } else {
            echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><script>alert(\''.$message.'\');history.go(-1)</script>';
        }
        exit;
    }

    /**
     * 定义方法
     *
     * 重写thinkphp跳转失败方法
     *
     * @param string $message
     * @param string $uri
     * @param bool|mixed $param
     */
    public function error_new($message,$uri ="",$param = [])
    {
        if ($uri) {
            if($param) {
                $param_str = '';
                foreach ($param as $k => $v) {
                    $param_str .= '/' . $k . '/' . $v;
                }
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><script>alert(\'' . $message . '\');location=\'' . $uri . $param_str . '\'</script>';
            }else{
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><script>alert(\'' . $message . '\');location=\'' . $uri .  '\'</script>';
            }
        } else {
            echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><script>alert(\''.$message.'\');history.go(-1)</script>';
        }
        exit;
    }

    public function getNewMessage(){
        $ccRemind = Cache::get('ccRemind');
        if(!$ccRemind){
            $ccRemind['cash'] = 0;
            $ccRemind['charge'] = 0;
            Cache::set('ccRemind',$ccRemind);
        }
        return json($ccRemind);
    }

}
