<?php

namespace App\Events;

use App\Models\ActivityEnroll;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * 报名插入事件
 * Class EnrollInsert
 * @package App\Events
 * @author klinson <klinson@163.com>
 */
class EnrollInsert
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $Enroll;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ActivityEnroll $enroll)
    {
        //
        $this->Enroll = $enroll;
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
