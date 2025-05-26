<?php

namespace App\Listeners;

use App\Events\PodcastProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Hash;

class SendPodcastNotification
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
    public function handle(PodcastProcessed $event): void
    {
        \App\Models\User::create([
            'name' => $event->name,
            'email' => $event->email,
            'email_verified_at' => $event->emailVerified,
            'password' => Hash::make($event->password),
            'remember_token' => $event->token,
        ]);
    }
}
