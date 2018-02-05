<?php
/**
 * Created by PhpStorm.
 * User: klinson <klinson@163.com>
 * Date: 2018/1/31
 * Time: 0:09
 */

namespace App\Models;


use App\Events\ShareFavourDelete;
use App\Events\ShareFavourInsert;

class ShareFavour extends BaseModel
{
    protected $table = 'share_favour';
    protected $fillable = ['share_id', 'uid'];

    protected $dispatchesEvents = [
        'created' => ShareFavourInsert::class, //关联创建事件
        'deleted' => ShareFavourDelete::class
    ];
}