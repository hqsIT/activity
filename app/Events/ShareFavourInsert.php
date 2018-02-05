<?php

namespace App\Events;

use App\Models\ShareFavour;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

/**
 * 报名插入事件
 * Class ShareFavourInsert
 * @package App\Events
 * @author klinson <klinson@163.com>
 */
class ShareFavourInsert
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $ShareFavour;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ShareFavour $ShareFavour)
    {
        //
        $this->ShareFavour = $ShareFavour;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
