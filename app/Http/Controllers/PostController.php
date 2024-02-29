<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'index');
    }
    
    public function index(User $user)
    {
        //$posts = Post::where('user_id', $user->id)->get();
        $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(8);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create() 
    {
       //dd('Creando post!');

       return view('posts.create');
    }

    public function store(Request $request) 
    {
       //dd('saving post!');

        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required'
        ]);

        /*Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' =>auth()->user()->id
        ]);*/
        // otra forma de crear posts ya teniendo las relaciones:
        $request->user()->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' =>auth()->user()->id
        ]);

        //return view('posts.create');
        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        //dd('Removing: ', $post->id);
        
        // Created a policy:  sail artisan make:policy PostPolicy --model=Post
        // At Policies/PostPolicy.pgp method delete we have the condition: user that created the ticket or the superuser
        if ($this->authorize('delete', $post)) {                        
            $post->delete();

            // Remove image
            $image_path = public_path('uploads/' . $post->image);
    
            if (File::exists($image_path)) {
                unlink($image_path);
            }
            
            //r eturn redirect()->route('posts.index', auth()->user()->username);
            // dd(User::findOrFail($post->user_id)->username);  
            return redirect()->route('posts.index', User::findOrFail($post->user_id)->username);      
        }
    }
}
