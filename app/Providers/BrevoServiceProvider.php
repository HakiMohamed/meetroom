<?php

namespace App\Providers;

use Brevo\Client\Api\TransactionalEmailsApi;
use Brevo\Client\Configuration;
use Illuminate\Support\ServiceProvider;

class BrevoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(TransactionalEmailsApi::class, function ($app) {
            $config = Configuration::getDefaultConfiguration()
                ->setApiKey('api-key', env('MAIL_PASSWORD'));

            return new TransactionalEmailsApi(null, $config);
        });
    }
}
