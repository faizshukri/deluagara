<?php

namespace Katsitu\Http\Controllers;

use Katsitu\Contracts\GeoIP;
use Katsitu\Http\Controllers\Controller;
use Katsitu\Location;

class HomeController extends Controller
{
    public function main(GeoIP $geoip, Location $location)
    {
        $user_coord = $geoip->getLocation();

        $locations = $location->all();

        return view('main', compact('user_coord', 'locations'));
    }
}
