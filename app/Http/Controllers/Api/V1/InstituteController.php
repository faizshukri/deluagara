<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Institute;

class InstituteController extends Controller
{
    private $institute;

    public function __construct(Institute $institute)
    {
        $this->institute = $institute;
    }

    public function institutes($name)
    {
        if (strlen($name) < 3) {
            return [ 'error' => 'Institute name must be consist of 3 characters or more.' ];
        }

        return $this->institute->where('name', 'like', "%$name%")->get()->map(function($ins){
            return [
                'id' => intval($ins->id),
                'text' => $ins->name
            ];
        });
    }
}
