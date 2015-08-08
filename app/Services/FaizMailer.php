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

    public function sendExceptionLog(Exception $log)
    {
        $handler = new \Monolog\Handler\SwiftMailerHandler(
            Mail::getSwiftMailer(),
            \Swift_Message::newInstance('[Log] Exception at ' . date('Y-m-d H:i:s'))
                ->setFrom(config('katsitu.emails.noreply.address'), config('katsitu.emails.noreply.name'))
                ->setTo(config('katsitu.emails.admin.address'))
                ->setContentType('text/html'),
            Logger::ERROR, // set minimal log lvl for mail
            true // bubble to next handler?
        );

        $formatter = new HtmlFormatter();

        $handler->setFormatter($formatter);

        Log::getMonolog()->pushHandler($handler);

        Log::error($log);
    }
}
