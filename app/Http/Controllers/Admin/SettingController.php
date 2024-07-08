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
        $increase = $request->input('group-a');
        $increases = [];
        // dd($increase);
        foreach ($increase as $value) {
            foreach ($value as $item) {
                $increases[] = $item;

            }
        }
        $array = $request->all();
        unset($array['group-a']);
        $row = $row->update($array + ['increase' => json_encode($increases)]);
        return redirect()->route('admin.settings.index', 1);

    }
    
}
