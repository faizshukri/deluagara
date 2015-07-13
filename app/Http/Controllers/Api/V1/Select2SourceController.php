<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Institute;
use App\City;

class Select2SourceController extends Controller
{

    public function query($category, $name)
    {
        $model_name = studly_case(str_singular($category));

        if (strlen($name) < 3) {
            return [ 'error' => $model_name . ' name must be consist of 3 characters or more.' ];
        }

        $model_name = 'App\\' . $model_name;
        $model = new $model_name;

        return $model->where('name', 'like', "%$name%")->get()->map(function($row){
            return [
                'id' => intval($row->id),
                'text' => $row->name
            ];
        });
    }

}
