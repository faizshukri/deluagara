<?php


namespace Katsitu\Services;


use Illuminate\Support\Facades\Mail;

class FaizMailer {

    public function sendVerificationEmail($user)
    {
        Mail::send('email.verify', ['user'=>$user], function($m) use ($user) {
            $m->from(config('katsitu.emails.noreply.address'), config('katsitu.emails.noreply.name'));
            $m->to($user->email, $user->name)->subject('Verify your email address');
        });
    }
}