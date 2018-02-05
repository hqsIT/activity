<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 2018/1/31
 * Time: 0:09
 */

namespace App\Models;


class Share extends BaseModel
{
    protected $table = 'share';

//    protected function setUidAttribute($value)
//    {
//        return session('login_info');
//    }

    public function publisher()
    {
        return $this->hasOne('App\Models\User', 'id', 'uid');
    }

    public function getCreateTimeAttribute($value)
    {
        return date('Y-m-d H:i:s', $value);
    }

    public function favourers()
    {
        return $this->hasMany('App\Models\ShareFavour', 'share_id', 'id');
    }
}