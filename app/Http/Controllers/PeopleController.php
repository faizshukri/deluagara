<?php

namespace App\Http\Controllers;

use App\Scholarship;
use App\UserStatus;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PeopleController extends Controller
{
    //
    public function index()
    {
        $statuses = UserStatus::all();
        $scholarship = Scholarship::all();

        return view('people.main', compact('statuses', 'scholarship'));
    }
}
