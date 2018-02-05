<?php

namespace App\Listeners;

use App\Events\EnrollInsert;
use App\Events\ShareFavourDelete;
use App\Events\ShareFavourInsert;
use Illuminate\Support\Facades\DB;

/**
 * 监听报名插入
 * Class EnrollInsertListener
 * @package App\Listeners
 * @author klinson <klinson@163.com>
 */
class ActivityUnFavourListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 报名人数+1
     *
     * @param  EnrollInsert  $event
     * @return void
     */
    public function handle(ShareFavourDelete $event)
    {
        DB::update('update `a_share` set `favour_count`=`favour_count`-1 where `id` = ?;' , [$event->ShareFavour->share_id]);
    }
}
