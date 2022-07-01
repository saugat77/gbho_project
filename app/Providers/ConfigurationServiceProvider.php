<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class ConfigurationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // during tests settings table is not found
        // so checking the enviromnent to prevent tests from failing
        if (!app()->runninginConsole()) {
            $this->overwriteConfigurationsFromSettings();
        }
    }

    protected function overwriteConfigurationsFromSettings()
    {
        if (!\Illuminate\Support\Facades\Schema::hasTable('settings')) {
            return;
        }
        // RECAPTCHA Site Key
        if (settings('recaptcha_api_site_key')) {
            config(['recaptcha.api_site_key' =>  settings('recaptcha_api_site_key')]);
        }

        // RECAPTCHA Secret Key
        if (settings('recaptcha_api_secret_key')) {
            config(['recaptcha.api_secret_key' =>  settings('recaptcha_api_secret_key')]);
        }

        // Facebook App ID
        if (settings('facebook_app_id')) {
            config(['services.facebook.client_id' =>  settings('facebook_app_id')]);
        }

        // Facebook App Secret
        if (settings('facebook_app_secret')) {
            config(['services.facebook.client_secret' =>  settings('facebook_app_secret')]);
        }

        // Google Client ID
        if (settings('google_client_id')) {
            config(['services.google.client_id' =>  settings('google_client_id')]);
        }

        // Google Client Secret
        if (settings('google_client_secret')) {
            config(['services.google.client_secret' =>  settings('google_client_secret')]);
        }

        // Configure Mail settings
        $mailConfig = [
            'driver' => settings('mail_driver'),
            'host' => settings('mail_host'),
            'port' => settings('mail_port'),
            'encrption' => settings('mail_encryption'),
            'username' => settings('mail_username'),
            'password' => settings('mail_password'),
            'from' => [
                'address' => settings('mail_from_address') ?? 'info@makaludogchew.com',
                'name' => settings('mail_from_name') ?? 'Makalu Dog Chew'
            ]
        ];
        Config::set('mail', $mailConfig);
        (new \Illuminate\Mail\MailServiceProvider(app()))->register();
    }
}
