<?php

namespace RichardAbear\Syndicate\Policies;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use RichardAbear\Syndicate\Models\Organization;
use Illuminate\Auth\Access\HandlesAuthorization;
use RichardAbear\Syndicate\Contracts\OrganizationInterface;

class OrganizationPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(Model $user, OrganizationInterface $organization)
    {
        return $user->belongsToOrganization($organization);
    }

    public function update(Model $user, OrganizationInterface $organization)
    {
        if (! $organization->members()->where('model_id', $user->id)->count()) {
            return false;
        }

        return true;
    }

    public function member(Model $user, OrganizationInterface $organization)
    {
        return true;
    }
}
