<?php

namespace App\Models;


use App\Events\EnrollInsert;

class ActivityEnroll extends BaseModel
{
    protected $table = 'activity_enroll';
    protected $fillable = ['activity_id', 'uid'];

    protected $dispatchesEvents = [
        'created' => EnrollInsert::class //关联创建事件
    ];
}
