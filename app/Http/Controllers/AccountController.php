<?php

namespace App\Http\Controllers;

use App\Contracts\GeoIP;
use App\Contracts\Progress;
use App\Sponsor;
use App\User;
use App\UserStatus;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{

    private $user;

    private $geoip;

    private $progress;

    private $request;

    public function __construct(Request $request, GeoIP $geoip, Progress $progress)
    {
        $this->user = $request->user();
        $this->geoip = $geoip;
        $this->progress = $progress;
        $this->request = $request;
    }

    // Handle /account
    public function index( User $user = null )
    {
        if( !$user->exists ) $user = $this->user;
        $user_coord = $this->geoip->getLocation();
        $progress = $this->progress->getProgress();

        return view('accounts/main', compact('user', 'user_coord', 'progress'));
    }

    public function edit(Sponsor $sponsor, UserStatus $status)
    {
        $user = $this->user->load('location.city', 'status');
        $statuses = $user->status ? $user->status->all() : $status->all();
        $sponsors =  $user->sponsor ? $user->sponsor->all() : $sponsor->all();

        return view('accounts/edit', compact('user', 'sponsors', 'statuses'));
    }

    public function update( Requests\EditAccountRequest $request )
    {
        $data = $request->all();
        dd($data);
        return redirect()->route('account.index');
    }

    // Handle /{username}
    public function user( User $user )
    {
        return $this->index($user);
    }
}
