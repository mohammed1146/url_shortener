<?php

namespace App\Providers;

use App\UrlShortener\Infrastructure\Interface\IRepository;
use App\UrlShortener\Url\Interface\IUrlShortener;
use App\UrlShortener\Url\Repository\Mysql\UrlShortenerRepository;
use App\UrlShortener\Url\Service\UrlShortener;
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
        $this->app->singleton(IRepository::class, UrlShortenerRepository::class);

        $this->app->singleton(IUrlShortener::class, UrlShortener::class);
    }
}
