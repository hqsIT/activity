<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        //活动报名监听事件
        'App\Events\EnrollInsert' => [
            'App\Listeners\EnrollInsertListener',
        ],
        //分享点赞
        'App\Events\ShareFavourInsert' => [
            'App\Listeners\ActivityFavourListener',
        ],
        //分享取消赞
        'App\Events\ShareFavourDelete' => [
            'App\Listeners\ActivityUnFavourListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
