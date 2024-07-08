<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use App\Http\Resources\OrderResource;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TripCancel implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $trip;
    public $status;

    public function __construct(Order $trip, $status)
    {
        $this->trip =  $trip;
        $this->status =  $status;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('trip-' . $this->trip->id)
        ];
    }
    public function broadcastWith()
    {
        return ($this->status);
    }
    public function broadcastAs()
    {
        return  'cancel';
    }
}
