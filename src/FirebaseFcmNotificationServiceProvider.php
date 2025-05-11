<?php

namespace Dwivedianuj9118\FirebaseFcmNotification;

use Illuminate\Support\ServiceProvider;

class FirebaseFcmNotificationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // Publish config and credential file
        $this->publishes([
            __DIR__ . '/../publish/firebase_credentials.json' => public_path('firebase_credentials.json'),
        ], 'papaya-fcm-config');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(NotificationService::class, function ($app) {
            return new NotificationService();
        });
    }
}
