<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class LikePost extends Component
{
    public $post;

    public function render(Post $post)
    {
        //dd($post);
        return view('livewire.like-post');
    }
}
