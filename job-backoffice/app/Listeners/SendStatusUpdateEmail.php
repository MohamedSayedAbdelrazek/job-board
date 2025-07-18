<?php

namespace App\Listeners;

use App\Events\ApplicationStatusUpdated;
use App\Jobs\SendStatusEmailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendStatusUpdateEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ApplicationStatusUpdated $event): void
    {
        //
        dispatch(new SendStatusEmailJob($event->jobApplication));

        // Mail::to($event->jobApplication->user->email)
        // ->send(new \App\Mail\ApplicationStatusMail($event->jobApplication));
    }
}
