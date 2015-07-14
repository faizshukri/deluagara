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

    public function __construct(Request $request, GeoIP $geoip, Progress $progress)
    {
        $this->user = $request->user();
        $this->geoip = $geoip;
        $this->progress = $progress;
    }

    // Handle /account
    public function index( User $user = null )
    {
        if( !$user->exists ) $user = $this->user;
        $user_coord = $this->geoip->getLocation();
        $progress = $this->progress->getProgress();

        return view('accounts/main', compact('user', 'user_coord', 'progress'));
    }

    public function edit()
    {
        $user = $this->user->load('location');
        return view('accounts/edit', compact('user'));
    }

    public function update( User $user )
    {
//        dd($user);
        return redirect()->route('account.index');
    }

    // Handle /{username}
    public function user( User $user )
    {
        return $this->index($user);
    }
}
