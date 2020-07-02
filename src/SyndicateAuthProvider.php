<?php
namespace Owchzzz\Syndicate;

use Owchzzz\Syndicate\Models\Organization;
use Owchzzz\Syndicate\Policies\OrganizationPolicy;
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
