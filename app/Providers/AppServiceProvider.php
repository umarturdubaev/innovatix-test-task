<?php

namespace App\Providers;

use App\Contracts\DomainInterface;
use App\Services\HttpService;
use App\Services\WhoIsApiService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DomainInterface::class, function ($app) {
            $url = config('services.whois.url');
            $apiKey = config('services.whois.api_key');
            return new WhoIsApiService(new HttpService(), $url, $apiKey);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
