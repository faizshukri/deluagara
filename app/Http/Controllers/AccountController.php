<?php

namespace App\Http\Controllers;

use App\Contracts\GeoIP;
use App\Contracts\Progress;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{

    private $user;

    private $geoip;

    private $progress;

    public function __construct(User $user, GeoIP $geoip, Progress $progress)
    {
        $this->user = $user;
        $this->geoip = $geoip;
        $this->progress = $progress;
    }

    // Handle /account
    public function index(Request $request, User $user = null)
    {
        if( !$user->exists ) $user = $request->user();
        $user_coord = $this->geoip->getLocation();
        $progress = $this->progress->getProgress();

        return view('accounts/main', compact('user', 'user_coord', 'progress'));
    }

    public function edit(Request $request)
    {
        //@TODO Implement this
        return $this->index($request);
    }

    // Handle /{username}
    public function user(Request $request, User $user)
    {
        return $this->index($request, $user);
    }
}
