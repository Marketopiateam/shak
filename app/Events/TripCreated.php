<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use App\Http\Resources\OrderResource;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TripCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $trip,$user_service_id;

    public function __construct(Order $trip )
    {

        $this->trip = $trip;
        $this->user_service_id = $trip->user_service_id;

    }


    public function broadcastOn(): array
    {
        return [
               new Channel('drivers')
        ];
    }
    public function broadcastWith()
    {

        $this->trip->user_service_id = $this->user_service_id ;
        return (new OrderResource($this->trip))->toArray(request());

    }
    public function broadcastAs()
    {
        return  'drivers1';
    }
}
