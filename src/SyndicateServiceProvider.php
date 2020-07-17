<?php
namespace RichardAbear\Syndicate;

use Illuminate\Support\ServiceProvider;
use RichardAbear\Syndicate\SyndicateAuthProvider;
use RichardAbear\Syndicate\SyndicateEventsProvider;
use RichardAbear\Syndicate\Contracts\OrganizationInterface;

class SyndicateServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'./../config/syndicate.php' => config_path('syndicate.php'),
            __DIR__.'./../views/mail' => resource_path('mail/')
        ], 'syndicate');

        $this->publishes([
            __DIR__.'./../graphql' => 'graphql/',
        ], 'syndicate-lighthouse');

        $this->publishes([
            __DIR__.'./Models' => 'app/Models',
        ], 'syndicate-models');

        $this->loadMigrationsFrom(__DIR__.'./../database/migrations');

        $this->app->register(SyndicateEventsProvider::class);
        $this->app->register(SyndicateAuthProvider::class);

        $this->app->bind(OrganizationInterface::class, config('syndicate.organization_model'));
    }
}
