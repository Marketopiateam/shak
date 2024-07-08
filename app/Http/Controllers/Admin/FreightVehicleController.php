<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileUploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFreightVehicleRequest;
use App\Models\FreightVehicle;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FreightVehicleController extends BaseController
{
    
    public function __construct(FreightVehicle $model)
    {
        parent::__construct($model);
    }
    public function dataHandler($request) {
        return [
            'name' => $request->name,
            'km_charge' => $request->km_charge,
            'enable' => $request->enable != null ? 1 : 0,
            'description'=>  $request->description,
            'height'=>  $request->height,
            'width'=>  $request->width,

        ];
    }
    public function store(StoreFreightVehicleRequest $request) 
    {
        abort_if(Gate::denies('freight_vehicle_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $service = $this->model->create($this->dataHandler($request));

        FileUploader::upload($service, $request->images, 'freight_vehicle_images', 'multiple_image');

        return redirect()->route('admin.freight-vehicles.index');
        
    }
    
} 
