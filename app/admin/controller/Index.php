<?php
namespace app\admin\controller;



use think\Db;
use think\Request;
use app\admin\model\Detail;
use app\admin\model\Members;
use app\admin\model\Recharge;

class Index extends Admin
{
    public function index(Request $request){

        $today = strtotime(date('Y-m-d'));
        $w1['create_at'] = ['<',$today];
        $w1['create_at'] =['>',($today+86400)];
        $w['create_at'] = ['>',$today];
        $w['is_del'] = 0;
        $w['state'] = 1;
        $halls = Db::name('hall')
            ->alias('h')
            ->field("h.*,c.name as cate_name")
            ->join('dl_cate c','c.id=h.cate')
            ->where('h.is_use',1)
            ->order('cate,hall')
            ->select();
        foreach ($halls as $k=>&$v){
            $v['win'] = Db::name('single')->where('cate',$v['cate'])->where('hall',$v['hall'])->where($w)->sum('money-z_money');
            $v['bet'] = Db::name('single')->where('cate',$v['cate'])->where('hall',$v['hall'])->where($w)->sum('money');
            $v['bet_num'] = Db::name('single')->where('cate',$v['cate'])->where('hall',$v['hall'])->where($w)->count();
        }
        $all['balance'] = Db::name('member')->where('is_temporary',0)->where('m_status',0)->sum('money');
        $all['win'] = Db::name('single')->where($w)->sum('money-z_money');
        $all['win_2'] = Db::name('single')->where($w1)->where('is_del',0)->where('state',1)->sum('money-z_money');
//        dump($halls);die;
        return view('',[
            'halls'=>$halls,
            'all'=>$all,
        ]);
    }
    public function index_bak()
    {
        $sys_info = $this->get_sys_info();
        $this->assign('sys_info',$sys_info);
        return view();
    }

    /**
     * 获取系统信息
     */
    public function get_sys_info(){
        $sys_info['os']             = PHP_OS;
        $sys_info['zlib']           = function_exists('gzclose') ? 'YES' : 'NO';//zlib
        $sys_info['safe_mode']      = (boolean) ini_get('safe_mode') ? 'YES' : 'NO';//safe_mode = Off
        $sys_info['timezone']       = function_exists("date_default_timezone_get") ? date_default_timezone_get() : "no_timezone";
        $sys_info['curl']           = function_exists('curl_init') ? 'YES' : 'NO';
        $sys_info['web_server']     = $_SERVER['SERVER_SOFTWARE'];
        $sys_info['phpv']           = phpversion();
        $sys_info['ip']             = GetHostByName($_SERVER['SERVER_NAME']);
        $sys_info['fileupload']     = @ini_get('file_uploads') ? ini_get('upload_max_filesize') :'unknown';
        $sys_info['max_ex_time']    = @ini_get("max_execution_time").'s'; //�ű����ִ��ʱ��
        $sys_info['set_time_limit'] = function_exists("set_time_limit") ? true : false;
        $sys_info['domain']         = $_SERVER['HTTP_HOST'];
        $sys_info['memory_limit']   = ini_get('memory_limit');
        $sys_info['version']        = '1.1.0';
        //$mysqlinfo = Db::query("SELECT VERSION() as version");
        $sys_info['mysql_version']  = 5.4;
        if(function_exists("gd_info")){
            $gd = gd_info();
            $sys_info['gdinfo']     = $gd['GD Version'];
        }else {
            $sys_info['gdinfo']     = "δ֪";
        }
        return $sys_info;
    }
}
