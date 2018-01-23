<?php

namespace App\Models;

use Carbon\Carbon;

class Activity extends BaseModel
{
    protected $table = 'activity';

    const ACTIVITY_TYPE = ['未知', '足球', '篮球', '羽毛球', '乒乓'];

//    public function getCreateTimeAttribute($date)
//    {
//        if (Carbon::now() > Carbon::parse($date)->addDays(10)) {
//            return Carbon::parse($date);
//        }
//
//        return Carbon::parse($date)->diffForHumans();
//    }

    public function getTypeAttribute($data)
    {
        return static::ACTIVITY_TYPE[$data];
    }
}