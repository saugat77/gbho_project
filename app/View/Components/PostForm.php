<?php

namespace App\View\Components;

use App\Post;
use Illuminate\View\Component;

class PostForm extends Component
{
    public Post $post;

    public function __construct(Post $post = null)
    {
        $this->post = $post ?? new Post();
    }

    public function render()
    {
        return view('components.post-form');
    }
}
