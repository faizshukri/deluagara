<?php

namespace Katsitu\Http\Controllers\Auth;

use Katsitu\Contracts\Progress;
use Katsitu\User;
use Illuminate\Http\Request;
use Mail;
use Validator;
use Katsitu\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{

    protected $redirectPath = '/';

    protected $redirectTo = '/';

    protected $loginPath = '/login';

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    private $request;
    private $mail;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, Mail $mail)
    {
        $this->middleware('guest', ['except' => ['getLogout', 'confirmEmail']]);
        $this->request = $request;
        $this->mail = $mail;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'username' => 'required|alpha_num|min:3|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'activity' => serialize(['register']),
            'confirmation_code' => str_random(32)
        ]);

        Mail::send('email.verify', ['user'=>$user], function($m) use ($user) {
            $m->from(config('katsitu.emails.noreply.address'), config('katsitu.emails.noreply.name'));
            $m->to($user->email, $user->name)->subject('Verify your email address');
        });

        $this->request->session()->flash('confirmation', 'Thanks for signing up! Please check your email.');

        return $user;
    }

    public function confirmEmail(User $user, Progress $progress, $confirmationCode)
    {

        if( !$confirmationCode ) {
            throw new \Exception;
        }

        $user = $user->where('confirmation_code', $confirmationCode)->first();

        if (!$user) {
            throw new \Exception;
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();
        $progress->updateProgress($user);

        flash()->success('You have successfully verified your account');
        return redirect()->route('home');
    }
}
