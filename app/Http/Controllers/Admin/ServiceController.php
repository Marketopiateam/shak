<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Models\Service;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\FileUploader;
class ServiceController extends BaseController
{
    public function __construct(Service $model)
    {
        parent::__construct($model);
    }
    public function dataHandler($request) {
        return [
            'title' => $request->title,
            'km_charge' => $request->km_charge,
            'enable' => $request->enable != null ? 1 : 0,
            'offer_rate' => $request->offer_rate != null ? 1 : 0,
            'intercity_type' => $request->intercity_type != null ? 1 : 0,
            'commission_type' => $request->commission_type != null ? 1 : 0,
        ];
    }
    public function store(StoreServiceRequest $request) 
    {
        abort_if(Gate::denies('service_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $service = Service::create($this->dataHandler($request));

        FileUploader::upload($service, $request->images, 'service_images', 'multiple_image');

        return redirect()->route('admin.services.index');
        
    }
}
