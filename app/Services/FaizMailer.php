<?php


namespace Katsitu\Services;

use Exception;
use Illuminate\Support\Facades\Mail;
use Katsitu\User;
use Monolog\Formatter\HtmlFormatter;
use Monolog\Logger;
use Log;

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
        Mail::send('email.exceptionlog', ['error' => $error->__toString()], function($m) {
            $m->from(config('katsitu.emails.noreply.address'), config('katsitu.emails.noreply.name'));
            $m->to(config('katsitu.emails.technician.address'), config('katsitu.emails.technician.name'))
                ->subject('Katsitu Error Log at ' . date('Y-m-d H:i:s'));
        });
    }
}
