<?php
namespace RichardAbear\Syndicate;

use RichardAbear\Syndicate\Models\Organization;
use RichardAbear\Syndicate\Policies\OrganizationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;

class SyndicateAuthProvider extends AuthServiceProvider
{
    protected $policies = [
        Organization::class => OrganizationPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
