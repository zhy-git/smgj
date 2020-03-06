<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Env;
return [
    // +----------------------------------------------------------------------
    // | 应用设置
    // +----------------------------------------------------------------------

    // 应用命名空间
    'app_namespace'          => 'app',
    // 应用调试模式
    'app_debug'              => Env::get('app_debug',true),
    'app_trace'              => Env::get('app_trace',true),
    // 应用模式状态
    'app_status'             => '',
    // 是否支持多模块
    'app_multi_module'       => true,
    // 入口自动绑定模块
    'auto_bind_module'       => false,
    // 注册的根命名空间
    'root_namespace'         => [],
    // 扩展函数文件
    'extra_file_list'        => [THINK_PATH . 'helper' . EXT],
    // 默认输出类型
    'default_return_type'    => 'html',
    // 默认AJAX 数据返回格式,可选json xml ...
    'default_ajax_return'    => 'json',
    // 默认JSONP格式返回的处理方法
    'default_jsonp_handler'  => 'jsonpReturn',
    // 默认JSONP处理方法
    'var_jsonp_handler'      => 'callback',
    // 默认时区
    'default_timezone'       => 'PRC',
    // 是否开启多语言
    'lang_switch_on'         => false,
    // 默认全局过滤方法 用逗号分隔多个
    'default_filter'         => '',
    // 默认语言
    'default_lang'           => 'zh-cn',
    // 应用类库后缀
    'class_suffix'           => false,
    // 控制器类后缀
    'controller_suffix'      => false,

    // +----------------------------------------------------------------------
    // | 模块设置
    // +----------------------------------------------------------------------

    // 默认模块名
    'default_module'         => 'home',
    // 禁止访问模块
    'deny_module_list'       => ['common'],
    // 默认控制器名
    'default_controller'     => 'Index',
    // 默认操作名
    'default_action'         => 'index',
    // 默认验证器
    'default_validate'       => '',
    // 默认的空控制器名
    'empty_controller'       => 'Error',
    // 操作方法后缀
    'action_suffix'          => '',
    // 自动搜索控制器
    'controller_auto_search' => false,

    // +----------------------------------------------------------------------
    // | URL设置
    // +----------------------------------------------------------------------

    // PATHINFO变量名 用于兼容模式
    'var_pathinfo'           => 's',
    // 兼容PATH_INFO获取
    'pathinfo_fetch'         => ['ORIG_PATH_INFO', 'REDIRECT_PATH_INFO', 'REDIRECT_URL'],
    // pathinfo分隔符
    'pathinfo_depr'          => '/',
    // URL伪静态后缀
    'url_html_suffix'        => 'html',
    // URL普通方式参数 用于自动生成
    'url_common_param'       => false,
    // URL参数方式 0 按名称成对解析 1 按顺序解析
    'url_param_type'         => 0,
    // 是否开启路由
    'url_route_on'           => true,
    // 路由使用完整匹配
    'route_complete_match'   => false,
    // 路由配置文件（支持配置多个）
    'route_config_file'      => ['route'],
    // 是否强制使用路由
    'url_route_must'         => false,
    // 域名部署
    'url_domain_deploy'      => false,
    // 域名根，如thinkphp.cn
    'url_domain_root'        => '',
    // 是否自动转换URL中的控制器和操作名
    'url_convert'            => true,
    // 默认的访问控制器层
    'url_controller_layer'   => 'controller',
    // 表单请求类型伪装变量
    'var_method'             => '_method',
    // 表单ajax伪装变量
    'var_ajax'               => '_ajax',
    // 表单pjax伪装变量
    'var_pjax'               => '_pjax',
    // 是否开启请求缓存 true自动缓存 支持设置请求缓存规则
    'request_cache'          => false,
    // 请求缓存有效期
    'request_cache_expire'   => null,
    // 全局请求缓存排除规则
    'request_cache_except'   => [],

    // +----------------------------------------------------------------------
    // | 模板设置
    // +----------------------------------------------------------------------

    'template'               => [
        // 模板引擎类型 支持 php think 支持扩展
        'type'         => 'Think',
        // 模板路径
        'view_path' => '', //电脑版
        'm_view_path' => APP_PATH.'wap/view/', //手机版
        // 模板后缀
        'view_suffix'  => 'html',
        // 模板文件名分隔符
        'view_depr'    => DS,
        // 模板引擎普通标签开始标记
        'tpl_begin'    => '{',
        // 模板引擎普通标签结束标记
        'tpl_end'      => '}',
        // 标签库标签开始标记
        'taglib_begin' => '{',
        // 标签库标签结束标记
        'taglib_end'   => '}',
    ],

    // 视图输出字符串内容替换
    'view_replace_str'       => [],
    // 默认跳转页面对应的模板文件
    'dispatch_success_tmpl'  => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',
    'dispatch_error_tmpl'    => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',

    // +----------------------------------------------------------------------
    // | 异常及错误设置
    // +----------------------------------------------------------------------

    // 异常页面的模板文件
    'exception_tmpl'         => THINK_PATH . 'tpl' . DS . 'think_exception.tpl',

    // 错误显示信息,非调试模式有效
    'error_message'          => '页面错误！请稍后再试～',
    // 显示错误信息
    'show_error_msg'         => false,
    // 异常处理handle类 留空使用 \think\exception\Handle
    'exception_handle'       => '',

    // +----------------------------------------------------------------------
    // | 日志设置
    // +----------------------------------------------------------------------

    'log'                    => [
        // 日志记录方式，内置 file socket 支持扩展
        'type'  => 'File',
        // 日志保存目录
        'path'  => LOG_PATH,
        // 日志记录级别
        'level' => [],
    ],

    // +----------------------------------------------------------------------
    // | Trace设置 开启 app_trace 后 有效
    // +----------------------------------------------------------------------
    'trace'                  => [
        // 内置Html Console 支持扩展
        'type' => 'Html',
    ],

    // +----------------------------------------------------------------------
    // | 缓存设置
    // +----------------------------------------------------------------------
    'cache' =>  [
        // 使用复合缓存类型
        'type'  =>  'complex',
        // 默认使用的缓存
        'default'   =>  [
            // 驱动方式
            'type'   => 'File',
            // 缓存保存目录
            'path'   => CACHE_PATH,
            'prefix' => '',
            'expire' => 0,
        ],
        // memcached缓存
        'memcached'   =>  [
            'type'   => 'memcached',
            'host'       => '127.0.0.1',
            'port' => 11211,
            'prefix' => '',
            'expire' => 0,
        ],
        // redis缓存
        'redis'   =>  [
            // 驱动方式
            'type'   => 'redis',
            // 服务器地址
            'host'       => '127.0.0.1',
            'port' => 6379,
        ],
    ],

    // +----------------------------------------------------------------------
    // | 会话设置
    // +----------------------------------------------------------------------

    'session'                => [
        'id'             => '',
        // SESSION_ID的提交变量,解决flash上传跨域
        'var_session_id' => '',
        // SESSION 前缀
        'prefix'         => 'think',
        // 驱动方式 支持redis memcache memcached
        'type'           => '',
        // 是否自动开启 SESSION
        'auto_start'     => true,
    ],

    // +----------------------------------------------------------------------
    // | Cookie设置
    // +----------------------------------------------------------------------
    'cookie'                 => [
        // cookie 名称前缀
        'prefix'    => '',
        // cookie 保存时间
        'expire'    => 0,
        // cookie 保存路径
        'path'      => '/',
        // cookie 有效域名
        'domain'    => '',
        //  cookie 启用安全传输
        'secure'    => false,
        // httponly设置
        'httponly'  => '',
        // 是否使用 setcookie
        'setcookie' => true,
    ],

    //分页配置
    'paginate'               => [
        'type'      => 'bootstrap',
        'var_page'  => 'page',
        'list_rows' => 15,
    ],
    //融云
    'rongyun'=>[
        'RONG_IS_DEV'            => true,//是否是在开发中
        'RONG_DEV_APP_KEY'       => 'tdrvipkstxex5', //融云开发环境下的key    仅供测试使用
        'RONG_DEV_APP_SECRET'    => 'Gxukb2Wi5M56qL', //融云开发环境下的SECRET  仅供测试使用
        'RONG_PRO_APP_KEY'       => 'cpj2xarlc7gtn', //融云生产环境下的key
        'RONG_PRO_APP_SECRET'    => 'PEO3x3v2Xc', //融云生产环境下的SECRET
    ],
    // 彩种
    'lottery_title' =>[
        '1'=>'pc蛋蛋',
        '2'=>'加拿大28',
        '3'=>'北京赛车',
        '4'=>'幸运飞艇',
        '5'=>'重庆时时彩',
        '6'=>'天津时时彩',
        '7'=>'北京快乐8',
        '8'=>'香港六合彩',
        '9'=>'广东快乐十分',
        '10'=>'重庆幸运农场',
        '11'=>'广东11选5',

    ],
    //明细
    'lottery_detail'=>[
        '3'=>[31,32,33,34,35,36], //投注
        '4'=>[41,42,43,44,45,46], //中奖
    ],

    //彩票接口
    'lottery_api'=>[
        'cqssc' =>'http://ho.apiplus.net/newly.do?token=t60d7dc0fc3b974bfk&code=cqssc&format=json', //重庆时时彩
        'car' =>'http://ho.apiplus.net/newly.do?token=t60d7dc0fc3b974bfk&code=bjpk10&format=json', //北京赛车pk10
        'xyft' =>'http://ho.apiplus.net/newly.do?token=t60d7dc0fc3b974bfk&code=mlaft&format=json', //幸运飞艇
        'jndeb'=>'http://ho.apiplus.net/newly.do?token=t60d7dc0fc3b974bfk&code=cakeno&format=json',//加拿大28
        'pcdd' =>'http://ho.apiplus.net/newly.do?token=t60d7dc0fc3b974bfk&code=bjkl8&format=json', //PC蛋蛋 （北京快8）
        'gdsyxw' => 'http://f.apiplus.net/gd11x5.json';
//      'gdsyxw' =>'http://ho.apiplus.net/newly.do?token=t3a8eb309806d8f01k&code=gd11x5&format=json', //广东11选5 ··
        //      'jsks' =>'http://ho.apiplus.net/newly.do?token=t3a8eb309806d8f01k&code=jsk3&format=json', //江苏快三··
//      'msssc' =>'http://ho.apiplus.net/newly.do?token=t3a8eb309806d8f01k&code=er75ssc&format=json', //秒速时时彩··
//      'mssc' =>'http://ho.apiplus.net/newly.do?token=t3a8eb309806d8f01k&code=er75sc&format=json', //秒速赛车··
         'mssc' => 'https://api.api68.com/pks/getLotteryPksInfo.do?lotCode=10037', //秒速赛车··
//      'xglhc' =>'http://ho.apiplus.net/newly.do?token=t3a8eb309806d8f01k&code=hk6&format=json', //香港六合彩
//      'xync' =>'http://ho.apiplus.net/newly.do?token=t3a8eb309806d8f01k&code=cqklsf&format=json', //幸运农场··
    ]
];