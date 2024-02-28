<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user)
    {
        // $user is the profile person
        // In request we will send the logged person id
        // dd($user->username);
        $user->followers()->attach(auth()->user()->id);

        return back();
    }

    public function destroy(User $user, Request $request)
    {
        // $user is the profile person
        // In request we will send the logged person id
        // dd($user->username);
        $user->followers()->detach(auth()->user()->id);

        return back();
    }
}
