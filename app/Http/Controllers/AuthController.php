<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginWithCode($code)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        $user = User::whereHas('userCodes', function ($query) use ($code) {
            $query->where('code', $code);
            $query->where('created_at', '>', now()->subDays(7));
        })->first();

        if ($user) {
            Auth::login($user);
            return redirect()->route('home'); // Redirect to home page after successful login
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid code, try to register.']);
        }
    }

    public function generateLink    ()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $code = $user->userCodes()->create([
            'code' => uniqid(),
        ]);

        return view('infopage', ['userCode' => $code->code]);
    }
}
