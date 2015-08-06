<?php

namespace Katsitu\Http\Controllers;

use Illuminate\Http\Request;

use Katsitu\Contracts\Progress;
use Katsitu\Services\FaizMailer;
use Katsitu\Http\Requests;
use Katsitu\Http\Controllers\Controller;

class AccountController extends Controller
{

    private $request;

    private $progress;

    public function __construct(Request $request, Progress $progress)
    {
        $this->request = $request;
        $this->progress = $progress;
    }
    //
    public function edit()
    {
        $user = $this->request->user();
        return view('accounts/edit', compact('user'));
    }

    public function update(Requests\EditAccountRequest $request, FaizMailer $mailer)
    {
        $data = $request->all();

        $user = $this->request->user();

        $user->username = $data['username'];
        $user->email = $data['email'];

        if($data['password'])
            $user->password = bcrypt($data['password']);

        if(array_key_exists('email', $user->getDirty())) {
            $user->confirmed = 0;
            $user->confirmation_code = str_random(32);
            $user->save();

            $mailer->sendVerificationEmail($user);
        }

        $user->save();

        $this->progress->updateProgress($user->fresh());
        flash()->success('Your account has been updated.');
        return redirect()->route('profile', [$user->username]);
    }
}
