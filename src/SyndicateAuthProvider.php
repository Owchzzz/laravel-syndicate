<?php
namespace RichardAbear\Syndicate;

use RichardAbear\Syndicate\Models\Organization;
use RichardAbear\Syndicate\Policies\OrganizationPolicy;
use RichardAbear\Syndicate\Contracts\OrganizationInterface;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;

class SyndicateAuthProvider extends AuthServiceProvider
{
    protected $policies = [
        OrganizationInterface::class => OrganizationPolicy::class
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
