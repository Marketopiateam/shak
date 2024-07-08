<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Traits\MapsProcessing;
use Illuminate\Http\Resources\Json\JsonResource;

class ServicesResource extends JsonResource
{


    public function toArray(Request $request): array
    {

        return [
            'id'            => $this->id,
            'name'          => $this->title,
            'image'         => $this->thumbnail[0]['url'],
            'offer_rate'    => $this->offer_rate,
            'service_type'  => $this->service_type,
        ];
    }
}
