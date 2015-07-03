<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $user = $request->user();
        return view('accounts/main', compact('user'));
    }

    public function edit(Request $request)
    {
        //@TODO Implement this
        return $this->index($request);
    }

    public function user($username)
    {
        $user = $this->user->where('username', $username)->firstOrFail();
        return view('accounts/main', compact('user'));
    }
}
