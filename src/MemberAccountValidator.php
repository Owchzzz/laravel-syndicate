<?php
namespace Owchzzz\Syndicate;

class MemberAccountValidator
{
    public static function findOrCreateFromEmail(string $email)
    {
        $UserModel = config('syndicate.user_model');
        $user = $UserModel::where('email', $email)->first();
        if (! $user) {
            $user = new $UserModel([
                'name' => '',
                'email' => $email,
                'password' => null,
            ]);
        }

        return $user;
    }
}
