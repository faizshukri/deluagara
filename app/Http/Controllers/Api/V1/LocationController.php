<?php

namespace App\Http\Controllers\Api\V1;

use App\Location;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
                        'title' => $loc->user->name,
                        'description' => $loc->street
                    ]
                ];
            })
        ];

        return $geo;
    }
}
