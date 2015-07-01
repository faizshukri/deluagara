<?php

namespace App\Http\Controllers;

use App\Contracts\GeoIP;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function main(GeoIP $geoip)
    {
        $location = $geoip->getLocation();

        return view('main', compact('location'));
    }
}
