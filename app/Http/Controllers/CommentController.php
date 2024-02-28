<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, User $user, Post $post) 
    {
       //dd('saving comment: ' . $request);

       // validation
       $this->validate($request, [
        'comment' => 'required|max:255'
       ]);

       // Store in ddbb
       Comment::create([
        'comment' => $request->comment,
        'user_id' => auth()->user()->id,
        'post_id' => $post->id
       ]);

       // Return to view
       return back()->with('message', 'Comentario realizado correctamente.');
    }
}
