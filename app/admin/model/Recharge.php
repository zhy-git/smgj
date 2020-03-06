<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/9/1
 * Time: 13:32
 */

namespace app\admin\model;


use think\Model;

class Recharge extends Base
{
    protected $table = 'dl_recharge';
    protected $autoWriteTimestamp = true;
    public function member()
    {
        return $this->hasOne('Members','id','uid');
    }
}