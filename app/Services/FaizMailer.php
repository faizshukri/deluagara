<?php


namespace Katsitu\Services;

use Exception;
use Illuminate\Support\Facades\Mail;
use Katsitu\User;
use phpbrowscap\Browscap;

class FaizMailer {

    public function sendVerificationEmail(User $user)
    {
        Mail::send('email.verify', compact('user'), function($m) use ($user) {
            $m->from(config('katsitu.emails.noreply.address'), config('katsitu.emails.noreply.name'));
            $m->to($user->email, $user->name)->subject('Verify your email address at Katsitu.Com');
        });
    }

    public function sendPasswordReset(User $user)
    {
        Mail::send('email.passwordreset', compact('user'), function($m) use ($user) {
            $m->from(config('katsitu.emails.noreply.address'), config('katsitu.emails.noreply.name'));
            $m->to($user->email, $user->name)->subject('Password Reset at Katsitu.Com');
        });
    }

    public function sendExceptionLog(Exception $error)
    {
        $browscap = new Browscap(storage_path('app/others'));
        $browscap->doAutoUpdate = false;
        $browser = $browscap->getBrowser();

        Mail::send('email.exceptionlog', ['error' => $error->__toString(), 'browser' => $browser ], function($m) {
            $m->from(config('katsitu.emails.noreply.address'), config('katsitu.emails.noreply.name'));
            $m->to(config('katsitu.emails.technician.address'), config('katsitu.emails.technician.name'))
                ->subject('Katsitu Error Log at ' . date('Y-m-d H:i:s'));
        });
    }
}
