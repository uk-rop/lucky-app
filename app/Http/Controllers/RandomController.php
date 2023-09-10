<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SpinService;

class RandomController extends Controller
{
    public function tryYourLuck(SpinService $service)
    {
        $spin = $service->spin();

        return view('home', ['spin' => $spin]);
    }

    public function history()
    {
        //get last 3 spins
        $spins = auth()->user()->spins()->orderBy('created_at', 'desc')->take(3)->get();

        return view('home', ['spin_history' => $spins]);
    }
}
