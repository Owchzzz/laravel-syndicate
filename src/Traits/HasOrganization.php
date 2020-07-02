<?php
namespace Owchzzz\Syndicate\Traits;

use Illuminate\Database\Eloquent\Model;
use Owchzzz\Syndicate\Models\Organization;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use phpDocumentor\Reflection\Types\Mixed_;

trait HasOrganization
{
    // Boot the organization functionality.
    public static function bootHasOrganization(): void
    {
        if (config('syndicate.create_default_organization')) { // If the option to turn on default permanent organizations is enabled, Syndicate will create a default organization for that user.
            static::created(function (Model $model) {
                $user_instance = config('syndicate.user_model');
                if ($model instanceof $user_instance) {
                    $organization = new Organization(['name' => 'My Organization', 'is_permanent' => true]);
                    $organization->save();
                    $organization->members()->attach([$model->getKey() => ['owner' => true]]);
                }
            });
        }
    }

    /**
     * Returns a list of that entities organizations
     *
     * @return MorphToMany
     */
    public function organizations(): MorphToMany
    {
        return $this->morphToMany(Organization::class, 'model', 'organization_models')->withPivot('owner');
    }

    /**
     * Returns the users permanent organization (assuming syndicate default_organization is set to true)
     *
     * @return Organization
     */
    public function permanentOrganization(): Organization
    {
        return $this->organizations()->where('owner', true)->first();
    }

    /**
     * Checks if the entity belongs to a certain organization
     *
     * @param mixed $organization
     * @return void
     */
    public function belongsToOrganization($organization)
    {
        $id = $organization; // Organization Assumes its an id

        if ($organization instanceof Organization) { // Organization check if its a model
            $id = $organization->getKey();
        }
        
        return $this->organizations()->where($this->getKeyName(), $id)->count() ? true : false;
    }
}
