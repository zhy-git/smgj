<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/9/16
 * Time: 10:29
 */

namespace app\admin\model;

use think\Model;
class Detail extends Model
{
    protected $autoWriteTimestamp = true;
    public function member()
    {
        return $this->hasOne('Members','id','uid');
    }
    public function detail()
    {
        return $this->hasMany('Detail','uid','uid');
    }
}