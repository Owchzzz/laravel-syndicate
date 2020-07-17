<?php
namespace RichardAbear\Syndicate\Models;

use Illuminate\Database\Eloquent\Model;
use RichardAbear\Syndicate\MemberManager;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use RichardAbear\Syndicate\Contracts\OrganizationInterface;

class Organization extends Model implements OrganizationInterface
{
    protected $fillable = ['name', 'is_permanent'];

    /**
     * Returns all the members for an organization. This does not include polymorphed relationships that are not of the user_model class
     *
     * @return MorphToMany
     */
    public function members():MorphToMany
    {
        return $this->morphedByMany(config('syndicate.user_model'), 'model', 'organization_models')->withPivot(['invite_key', 'pending', 'owner']);
    }

    /**
     * Returns an instance of member manager where you will be able to manage members for that organization
     *
     * @param Model $manager
     * @return MemberManager
     */
    public function getMemberManager(Model $manager = null): MemberManager
    {
        return new MemberManager($this, $manager);
    }
}
