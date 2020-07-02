<?php

namespace RichardAbear\Syndicate\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;
use RichardAbear\Syndicate\Models\Organization;

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

    public function update(Model $user, Organization $organization)
    {
        if (! $organization->members()->where('model_id', $user->id)->count()) {
            return false;
        }

        return true;
    }
}
