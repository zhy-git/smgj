<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/9/29
 * Time: 20:08
 */

namespace app\admin\model;


use think\Model;

class Single extends Model
{
    public function gold()
    {
        return $this->hasOne('gold','stage','stage');
    }
}