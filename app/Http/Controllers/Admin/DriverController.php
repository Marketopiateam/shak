<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DriverProfile;
use Illuminate\Http\Request;

class DriverController extends BaseController
{
    public function __construct(DriverProfile $model)
    {
        parent::__construct($model);
    }

    public function index()  
    {
        $request = request();
        $allDriversCount = $this->model->count(); 
        $pendingDriversCount = $this->model->where('status', '=', 'pending')->count(); 
        $activeDriversCount = $this->model->where('status', '=', 'active')->count(); 
        $blockedDriversCount = $this->model->where('status', '=', 'blocked')->count(); 
        $rows = DriverProfile::with('user'); 
       if ($request->status != null && $request->status != '') {
              $rows = $rows->where('status', $request->status);
       }
         $rows = $rows->orderBy('id', 'desc')->paginate(10);
         $moduleName = $this->getModelName();
         $pageTitle = $moduleName;
         $pageDes = "Here you can create " .$moduleName;

        return view('admin.drivers.index', compact(
            'rows', 
            'pendingDriversCount',
            'allDriversCount',
            'activeDriversCount',
            'blockedDriversCount',
            'moduleName',
            'pageTitle',
            'pageDes'
        ));
    }
    public function block($id)  
    {
        $this->model->findOrFail($id)->update([
            'status'    => 'blocked'
        ]);
        return redirect()->route('admin.drivers.index')->with('success', __('app.blocked_successfully'));
    }
    public function active($id)  
    {
        $this->model->findOrFail($id)->update([
            'status'    => 'active'
        ]);
        return redirect()->route('admin.drivers.index')->with('success', __('app.activated_successfully'));
    }
    public function show($id)  
    {
        $row = $this->model->findOrFail($id);
        $moduleName = $this->getModelName();
        $pageTitle = $moduleName;
        $pageDes = "Here you can create " .$moduleName;
        return view('admin.drivers.show', compact(
            'row', 
            'moduleName',
            'pageTitle',
            'pageDes'
        ));
    }
}
