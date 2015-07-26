<?php

namespace Katsitu\Http\Controllers\Api\V1;

use Katsitu\Http\Requests;
use Katsitu\Http\Controllers\Controller;
use Katsitu\Institute;
use Katsitu\City;

class Select2SourceController extends Controller
{

    public function query($category, $name)
    {
        $model_name = studly_case(str_singular($category));

        if (strlen($name) < 3) {
            return [ 'error' => $model_name . ' name must be consist of 3 characters or more.' ];
        }

        $model = $this->getModelInstance($model_name);

        return $model->where('name', 'like', "%$name%")->get()->map(function($row){
            return [
                'id' => intval($row->id),
                'text' => $row->name
            ];
        });
    }

    public function single($category, $id)
    {
        $model_name = studly_case(str_singular($category));

        $model = $this->getModelInstance($model_name)->find($id);
        return [
                'id' => intval($model->id),
                'text' => $model->name
            ];
    }

    private function getModelInstance($model_name)
    {
        $model_name = 'Katsitu\\' . $model_name;
        return new $model_name;

    }
}
