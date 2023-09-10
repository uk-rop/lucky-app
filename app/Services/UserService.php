<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;

class UserService
{
    public function create($username, $phonenumber)
    {
        $user = User::create([
            'username' => $username,
            'phonenumber' => $phonenumber,
        ]);

        $user->userCodes()->create([
            'code' => Str::random(10),
        ]);

        return $user->userCodes()->first()->code;
    }
}
