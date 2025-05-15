<?php

namespace App\Providers;

use App\Models\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

class LogServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Log login events
        Event::listen(Login::class, function ($event) {
            Log::activity(
                $event->user->id,
                'login',
                'User logged in successfully'
            );
        });

        // Log logout events
        Event::listen(Logout::class, function ($event) {
            Log::activity(
                $event->user->id,
                'logout',
                'User logged out successfully'
            );
        });
    }
} 