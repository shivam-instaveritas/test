<?php

namespace App\Listeners;

use App\Events\NewUserCreated;
use App\Jobs\SendMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailConfirmation
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  =NewUserCreated  $event
     * @return void
     */
    public function handle(NewUserCreated $event)
    {
        $user = $event->user;
        dispatch(new SendMail($user));
    }
}
