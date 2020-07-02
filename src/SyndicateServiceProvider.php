<?php
namespace Owchzzz\Syndicate;

use Illuminate\Support\ServiceProvider;

class SyndicateServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'./../config/syndicate.php' => config_path('syndicate.php')
        ]);

        $this->loadMigrationsFrom(__DIR__.'./../database/migrations');
    }
}
