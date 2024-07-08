<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\room;
use Illuminate\Http\Request;

class ChatController extends BaseController
{
    public function __construct(room $model)
        {
            parent::__construct($model);
        }

    public function single($id)  {
        $row = $this->model->with('chat', 'trip', 'chat.sender', 'chat.receiver',)->findOrFail($id);
        $moduleName = $this->getModelName();
        $pageTitle = "Create ". $moduleName;
        $pageDes = "Here you can create " .$moduleName;
        $folderName = $this->getClassNameFromModel();
        $routeName = $folderName;
        return view('admin.chats.single' , compact(
            'pageTitle',
            'moduleName',
            'pageDes',
            'folderName',
            'routeName',
            'id',
            'row'
        ));

    }
}
