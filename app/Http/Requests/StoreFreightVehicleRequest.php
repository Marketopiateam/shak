<?php

namespace App\Http\Requests;

use App\Models\FreightVehicle;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFreightVehicleRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('freight_vehicle_create'),
            response()->json(
                ['message' => 'This action is unauthorized.'],
                Response::HTTP_FORBIDDEN
            ),
        );

        return true;
    }

    public function rules(): array
    {
        return [
            
            
            
            'description' => [
                'string',
                'nullable',
            ],
            'height' => [
                'numeric',
                'nullable',
            ],
            'image' => [
                'image',
                'nullable',
            ],
            'km_charge' => [
                'numeric',
                'nullable',
            ],
            
            'name' => [
                'string',
                'nullable',
            ],
            'width' => [
                'numeric',
                'nullable',
            ],
        ];
    }
}
