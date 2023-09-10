<?php

namespace App\Http\Controllers\Auth;

use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        //check if user is logged in
        if (auth()->check()) {
            return redirect()->route('home');
        }

        return view('auth.register');
    }

    protected function validator(array $data, $table)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:50'],
            'phonenumber' => ['required', new PhoneNumber, 'min:10', 'max:12', 'unique:' . $table],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     */
    // protected function create(array $data)
    public function register(Request $request, UserService $service)
    {
        $validator = $this->validator($request->all(), 'users');

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $userCode =  $service->create($request->input('username'), $request->input('phonenumber'));

        return view('infopage', ['userCode' => $userCode]);
    }
}
