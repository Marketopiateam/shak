<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }
    public function update(Request $request){
        $row = $this->model->firstOrFail();
        $array = $request->all();
        unset($array['group-a']);
        $row = $row->update($array + ['increase' => json_encode($request->increase)]);
        return redirect()->route('admin.settings.index', 1);

    }
    
}
