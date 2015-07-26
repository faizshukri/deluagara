<?php

namespace Katsitu\Listeners;

use Katsitu\Contracts\Progress;
use Katsitu\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AuthLoginListener
{

    protected $progress;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Progress $progress)
    {
        //
        $this->progress = $progress;
    }

    /**
     * Handle the event.
     *
     * @param  Events  $event
     * @return void
     */
    public function handle(User $user, $remember)
    {
        $this->progress->updateProgress($user);
    }
}
