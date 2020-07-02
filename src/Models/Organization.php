<?php
namespace Owchzzz\Syndicate\Models;

use Illuminate\Database\Eloquent\Model;
use Owchzzz\Syndicate\MemberManager;

class Organization extends Model
{
    protected $fillable = ['name', 'is_permanent'];

    /**
     * Returns all the members for an organization. This does not include polymorphed relationships that are not of the user_model class
     *
     * @return void
     */
    public function members()
    {
        return $this->morphedByMany(config('syndicate.user_model'), 'model', 'organization_models');
    }

    /**
     * Returns an instance of member manager where you will be able to manage members for that organization
     *
     * @param Model $manager
     * @return MemberManager
     */
    public function getMemberManager(Model $manager): MemberManager
    {
        return new MemberManager($this, $manager);
    }
}
