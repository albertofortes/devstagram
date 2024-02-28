<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(User $user)
    {
        // get user we follow:
        // dd(auth()->user()->following->pluck('id')->toArray());
        $ids = auth()->user()->following->pluck('id')->toArray();
        //$posts = Post::whereIn('user_id', $ids)->get();
        //$posts = Post::whereIn('user_id', $ids)->latest()->paginate(10);
        //dd($posts);

        $myPosts = Post::where('user_id', auth()->user()->id)->latest()->get();
        $followingPosts = Post::whereIn('user_id', $ids)->latest()->get();
        
        $posts = $myPosts->merge($followingPosts)->toQuery()->paginate(12); // https://stackoverflow.com/questions/48148472/laravel-method-paginate-does-not-exist  paginate only in queries not in collection
        //dd($posts);
        
        return view('home', [
            'posts' => $posts
        ]);
    }
}
