<?php

namespace Katsitu\Http\Controllers;

use Illuminate\Http\Request;

use Katsitu\Http\Requests;
use Katsitu\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index(){

        return view('events/main');
    }
}
