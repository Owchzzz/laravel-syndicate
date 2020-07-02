<?php
namespace RichardAbear\Syndicate;

use Illuminate\Support\Facades\Hash;
use phpseclib\Crypt\Random;

class MemberAccountValidator
{
    public static function findOrCreateFromEmail(string $email)
    {
        $UserModel = config('syndicate.user_model');
        $user = $UserModel::where('email', $email)->first();
        if (! $user) {
            $password = Random::string(16);
            $user = new $UserModel([
                'name' => '',
                'email' => $email,
                'password' => Hash::make($password),
            ]);
            $user->save();
        }

        return $user;
    }
}
