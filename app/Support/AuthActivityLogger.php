<?php

namespace App\Support;

use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;

/**
 * Writes logins, logouts and failed logins to the activity log.
 * Call AuthActivityLogger::register() once from AppServiceProvider::boot().
 *
 * Passwords are never recorded. Logging problems never block a login.
 */
class AuthActivityLogger
{
    public static function register(): void
    {
        Event::listen(Login::class, function (Login $event): void {
            self::log('Logged in', $event->user);
        });

        Event::listen(Logout::class, function (Logout $event): void {
            if ($event->user) {
                self::log('Logged out', $event->user);
            }
        });

        Event::listen(Failed::class, function (Failed $event): void {
            self::log('Failed login attempt', null, [
                'email' => Str::limit((string) ($event->credentials['email'] ?? ''), 100),
            ]);
        });
    }

    private static function log(string $description, ?Authenticatable $user, array $extra = []): void
    {
        try {
            $logger = activity('auth')
                ->withProperties(array_merge($extra, [
                    'ip' => request()->ip(),
                    'user_agent' => Str::limit((string) request()->userAgent(), 200),
                ]));

            if ($user) {
                $logger->causedBy($user);
            }

            $logger->log($description);
        } catch (\Throwable $e) {
            report($e); // never let logging break signing in
        }
    }
}
