<?php

namespace App\Listeners;

use App\Events\SomeoneLoginAttempt;
use App\Jobs\SendLoginAttemptJobs;
use App\Mail\SendMarkDownMail;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendLoginAttempt
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
     * @param  \App\Events\SomeoneLoginAttempt  $event
     * @return void
     */
    public function handle(SomeoneLoginAttempt $event)
    {
        $users =User::get();
        foreach($users as $user){
            Mail::to($user->email)->send(new SendMarkDownMail($event->maxAttempt));
        }

        // $delay=now()->addSecond(10);
        // SendLoginAttemptJobs::dispatch($event->user)->delay($delay);
    }
}
