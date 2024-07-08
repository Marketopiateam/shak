<?php

namespace App\Helpers;

class FileUploader
{
   public static function upload($model, $file, $collection, $type = 'single_image')  
   {
    if ($type == 'single_image') {
        $model->addMedia($file)->toMediaCollection($collection);
    } else {
        foreach ($file as $image) {
            $model->addMedia($image)->toMediaCollection($collection);
        }        
    }
   }
}
