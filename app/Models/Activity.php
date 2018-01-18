<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Activity extends Model
{

    public $timestamps = true;
    public $dateFormat = 'Y/m/d h:i:s';
    protected $table = 'activity';
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    const ACTIVITY_TYPE = ['未知', '足球', '篮球', '羽毛球', '乒乓'];

    public function getCreateTimeAttribute($date)
    {
        if (Carbon::now() > Carbon::parse($date)->addDays(10)) {
            return Carbon::parse($date);
        }

        return Carbon::parse($date)->diffForHumans();
    }

    public function getStartTimeAttribute($date)
    {
        return date('Y/m/d h:i:s', $date);
    }

    public function getEndTimeAttribute($date)
    {
        return date('Y/m/d h:i:s', $date);
    }

    public function getTypeAttribute($data)
    {
        return static::ACTIVITY_TYPE[$data];
    }
}
