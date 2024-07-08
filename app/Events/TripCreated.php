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


    public $trip;

    public function __construct(Order $trip )
    {
        // $trip = $trip->toArray();
        $this->trip = $trip;
        var_dump($this->trip,$trip);
// dd( (new OrderResource($this->trip))->toArray(request()));
    }


    public function broadcastOn(): array
    {
        return [
               new Channel('drivers')
        ];
    }
    public function broadcastWith()
    {
        $orderResource = new OrderResource($this->trip);
        $orderArray = $orderResource->toArray(request());

        var_dump($orderArray); // For debugging purposes

        return $orderArray;
        // return (new OrderResource($this->trip))->toArray(request());

    }
    public function broadcastAs()
    {
        return  'drivers1';
    }
}
