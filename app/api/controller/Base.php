<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/10/30
 * Time: 11:08
 */

namespace app\api\controller;


use app\admin\model\Members;
use think\Cache;
use think\Controller;
use think\Request;

class Base extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        parent::__construct();


        $uid = $request->post('uid');
        $token = $request->post('token');
        //check_token($uid, $token);
    }

}