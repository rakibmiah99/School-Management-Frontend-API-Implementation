<?php

namespace App\Providers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Http::macro('sms', function () {
            return Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . session('__token'),
            ])->baseUrl(env("API_URL"));
        });
    }
}
