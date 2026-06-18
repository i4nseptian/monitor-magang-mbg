<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        RateLimiter::for('login', function (Request $request) {
            $key = 'login:'.$request->ip();
            return Limit::perMinute(5)->key($key);
        });

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->key($request->user()?->id ?: $request->ip());
        });

        \Illuminate\Support\Facades\Event::listen(
            \Illuminate\Auth\Events\Login::class,
            function ($event) {
                \App\Models\LoginHistory::create([
                    'user_id' => $event->user->id,
                    'ip_address' => request()->ip(),
                    'login_at' => now(),
                ]);
            }
        );
    }
}
