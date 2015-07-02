<?php

namespace App\Http\Controllers;

use App\Contracts\GeoIP;
use App\Http\Controllers\Controller;
use App\Location;

class HomeController extends Controller
{
    public function main(GeoIP $geoip, Location $location)
    {
        $user_coord = $geoip->getLocation();

        $locations = $location->all();

        return view('main', compact('user_coord', 'locations'));
    }
}
