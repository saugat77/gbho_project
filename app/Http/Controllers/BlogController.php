<?php

namespace App\Http\Controllers;

use App\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::published()->latest()->paginate(15);

        return view('frontend.blog.index', compact([
            'posts',
        ]));
    }

    public function show(Post $post)
    {
        return view('frontend.blog.show', compact([
            'post',
        ]));
    }
}
