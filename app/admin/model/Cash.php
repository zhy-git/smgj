<?php
/**
 * Created by PhpStorm.
 * User: tangmusen
 * Date: 2017/9/1
 * Time: 17:50
 */

namespace app\admin\model;


use think\Model;

class Cash extends Model
{
    protected $table = 'dl_withdrawals';
    protected $autoWriteTimestamp = true;
    public function member()
    {
        return $this->hasOne('Members','id','uid');
    }
    

}