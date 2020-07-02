<?php

namespace Owchzzz\Syndicate\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;
use Owchzzz\Syndicate\Models\Organization;

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
        return true;
        if (! $organization->members()->where('model_id', $user->id)->count()) {
            return false;
        }

        return true;
    }
}
