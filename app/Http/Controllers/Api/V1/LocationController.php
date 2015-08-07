<?php

namespace Katsitu\Http\Controllers\Api\V1;

use Katsitu\Location;
use Illuminate\Http\Request;

use Katsitu\Http\Requests;
use Katsitu\Http\Controllers\Controller;

class LocationController extends Controller
{
    private $location;

    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    public function locations()
    {
        return $this->location->all();
    }

    public function geolocations()
    {
        $geo = [
            'type' => 'FeatureCollection',
            'features' => $this->locations()->map(function($loc){
                return [
                    'type' => 'Feature',
                    'geometry' => [
                        'type' => 'Point',
                        'coordinates' => [ floatval($loc->longitude), floatval($loc->latitude) ]
                    ],
                    'properties' => [
                        'marker-color' => '#548cba',
                        'marker-symbol' => 'building',
                        'name' => $loc->user->name,
                        'username' => $loc->user->username,
                        'profile_image' => $loc->user->profile_image_sm,
                        'city' => $loc->city->name
                    ]
                ];
            })
        ];

        return $geo;
    }
}
