<?php

namespace RichardAbear\Syndicate\GraphQL\Mutations;

use Exception;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use RichardAbear\Syndicate\Contracts\OrganizationInterface;
use RichardAbear\Syndicate\MemberManager;
use RichardAbear\Syndicate\Models\Organization;
use RichardAbear\Syndicate\MemberAccountValidator;

class OrganizationMutations
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
    }

    public function removeFromOrganization($rootValue, array $args)
    {
        $organization = app(OrganizationInterface::class)::findOrFail($args['organization_id']);

        /**
         * @var Model $user
         */
        $user = auth()->user();
        // Added new feature

        if ($user->can('update', $organization)) {
            $UserModel = config('syndicate.user_model');
            $target_user = $UserModel::find($args['user_id']);
            
            if (!$target_user) {
                throw new Exception("User does not exist", 404);
            }

            $manager = new MemberManager($organization, $user);
            $manager->remove($target_user);
        }
    }

    public function inviteIntoOrganization($rootValue, array $args)
    {
        $organization = app(OrganizationInterface::class)::findOrFail($args['organization_id']);

        /**
         * @var User $user
         */
        $user = auth()->user();

        if ($user->can('update', $organization)) {
            $manager = new MemberManager($organization, $user);
            $manager->invite(MemberAccountValidator::findOrCreateFromEmail($args['email']));
            return ['message' => 'SUCCESS'];
        }

        throw new Exception("User does not have permission to access this organization");
    }

    public function acceptInvitation($rootValue, array $args)
    {
        try {
            MemberManager::validateInviteToken($args['token']);
        } catch (\Exception $e) {
            throw new Exception("Unable to verify token", 401);
        }

        return ['message' => 'SUCCESS'];
    }
}
