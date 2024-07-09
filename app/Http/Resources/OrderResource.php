<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Traits\MapsProcessing;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{


    public function toArray(Request $request): array
    {

        $data =   [
            'id'                    => $this->id,
            'destination_lat'       => $this->destination_lat,
            'destination_long'      => $this->destination_long ?? '',
            'destination_address'   => $this->destination_address ?? '',
            'source_lat'            => $this->source_lat ?? '',
            'source_long'           => $this->destination_long ?? '',
            'source_address'        => $this->source_address ?? '',
            'amount'                => $this->offer_rate ?? '',
            'final_rate'            => $this->final_rate ?? '',
            'distance'              => $this->distance ?? '',
            'distance_type'         => $this->distance_type ?? '',
            'status'                => $this->status,
            'offerdriver'           => $this->offerdriver ?? '',
            'is_offer'              => $this->service->offer_rate ?? '',
            'created_at'            => $this->created_at ?? '',
            'driver'                => ($this->driver != null ? new UserResource((object)$this->driver) : ''),
            'user'                  => ($this->user != null ? new UserResource((object)$this->user) : ''),
            'when_date'             => $this->when_date ?? '',
            'inter_city'            => $this->inter_city ?? '',
            'user_service_id'       => $this->user_service_id ?? '',
            'paid'                  => $this->paid ?? '',
            'payment_type'          => $this->payment_type ?? '',
            'commission'          => $this->commission ?? '',
            'destination_City'          => $this->destination_City ?? '',
            'source_city'          => $this->source_city ?? '',
            'parcel_dimension'          => $this->parcel_dimension ?? '',
            'parcel_image'          => $this->parcel_image ?? '',
            'parcel_weight'          => $this->parcel_weight ?? '',
            'number_of_passenger'          => $this->number_of_passenger ?? '',
            'is_placed'          => $this->is_placed ?? '',
            'is_started'          => $this->is_started ?? '',
            'is_accept'          => $this->is_accept ?? '',
            'is_complete'          => $this->is_complete ?? '',
            'is_canceled'          => $this->is_canceled ?? '',
            'canceled_by'          => $this->canceled_by ?? '',
            'comment'          => $this->comment ?? '',
            'service_type'              => $this->service != null ? $this->service->service_type : '',



        ];

        return $data;
    }
}
