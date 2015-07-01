<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //
    public function main(Request $request){

        $request->setTrustedProxies(array('127.0.0.1')); // only trust proxy headers coming from the IP addresses on the array (change this to suit your needs)

        $url = 'https://freegeoip.net/json';

        if(!in_array(substr($request->getClientIp(), 0, 7), ['::1', '192.168'])) {
            $url .= '/'. $request->getClientIp();
        }

        $json = json_decode(file_get_contents($url), true);
        $location = [ $json['latitude'], $json['longitude'] ];

        return view('main', compact('location'));
    }
}
