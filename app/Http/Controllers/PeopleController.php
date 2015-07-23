<?php

namespace App\Http\Controllers;

use App\Contracts\GeoIP;
use App\Sponsor;
use App\User;
use App\Location;
use App\City;
use App\UserStatus;
use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PeopleController extends Controller
{
    //
    public function index(Request $request, GeoIP $geoip)
    {

        if($request->input('name') !== NULL) $users = $this->search($request)->paginate(14);
        else $users = User::paginate(14);

        $statuses = UserStatus::all();
        $sponsors = Sponsor::all();
        $request = $request->all();
        $city = !empty($request['city']) ? City::find(intval($request['city']))->name : '' ;
        $user_coord = $geoip->getLocation();

        return view('people.main', compact('statuses', 'sponsors', 'users', 'request', 'city', 'user_coord'));
    }

    private function search($request){

        $city = $request->input('city');
        $name = $request->input('name');
        $gender = $request->input('gender');
        $status = $request->input('status');
        $sponsor = $request->input('sponsor');

        $user_table = with(new User)->getTable();
        $location_table = with(new Location)->getTable();

        $users = DB::table($user_table)->select($user_table.'.*');

        if ($name != NULL) {
            $users = $users->where('name', 'LIKE', '%' . $name . '%');
        }

        if ($city != NULL) {
            $users = $users->join($location_table, $location_table.'.user_id', '=', $user_table.'.id')
                           ->where($location_table.'.city_id', $city);
        }

        if ($gender != NULL) {
            $users = $users->where('gender', $gender);
        }

        if ($status != NULL) {
            $users = $users->whereIn($user_table.'.user_status_id', $status);
        }

        if ($sponsor != NULL) {
            $users = $users->where($user_table.'.sponsor_id', $sponsor);
        }

        return User::whereIn('id', $users->lists('id'));
    }
}
