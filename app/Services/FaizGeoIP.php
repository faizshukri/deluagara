<?php


namespace App\Services;


use App\Contracts\GeoIP;
use Illuminate\Http\Request;

class FaizGeoIP implements GeoIP {

    private $request;

    // https://freegeoip.net/json
    // http://www.telize.com/geoip
    private $serviceUrl = 'http://geoip.faizshukri.com/json';

    public function __construct(Request $request){
        $this->request = $request;
        $this->request->setTrustedProxies(array('127.0.0.1')); // only trust proxy headers coming from the IP addresses on the array (change this to suit your needs)
    }

    public function getLocation(){

        if(!in_array(substr($this->request->getClientIp(), 0, 7), ['::1', '192.168']))
        {
            $this->serviceUrl .= '/'. $this->request->getClientIp();
        }

        $json = json_decode(file_get_contents($this->serviceUrl), true);

        return [ 'latitude' => $json['latitude'], 'longitude' => $json['longitude'] ];
    }
}