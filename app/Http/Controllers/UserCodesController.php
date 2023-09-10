<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserCodesRequest;
use App\Http\Requests\UpdateUserCodesRequest;
use App\Models\UserCodes;
use App\Services\UserService;

class UserCodesController extends Controller
{
    public function generateLink(UserService $service)
    {
        $code = $service->createNewCode();


        return view('home', ['code' => $code]);
    }

    public function removeAll()
    {
        $user = auth()->user();

        $user->userCodes()->delete();

        return view('home');
    }

    public function remove($code)
    {
        $user = auth()->user();

        $user->userCodes()->where('code', $code)->delete();

        return view('home');
    }
}
