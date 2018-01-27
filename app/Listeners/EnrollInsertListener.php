<?php

namespace App\Listeners;

use App\Events\EnrollInsert;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

/**
 * 监听报名插入
 * Class EnrollInsertListener
 * @package App\Listeners
 * @author klinson <klinson@163.com>
 */
class EnrollInsertListener
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
    public function handle(EnrollInsert $event)
    {
        DB::update('update `a_activity` set `enroll_number`=`enroll_number`+1 where `id` = ?;' , [$event->Enroll->activity_id]);
    }
}
