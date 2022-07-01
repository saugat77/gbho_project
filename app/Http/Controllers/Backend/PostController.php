<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Service\ImageService;
use Illuminate\Support\Arr;

class PostController extends Controller
{
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        return view('post.index');
    }

    public function create()
    {
        return view('post.form');
    }

    public function store(PostRequest $request)
    {
        $post = Post::create(Arr::except($request->validated(), ['cover_image']));

        if ($request->hasFile('cover_image')) {
            $post->cover_image = $this->imageService->storeImage($request->file('cover_image'));
            $post->save();
        }

        return redirect()->route('posts.index')->with('success', 'All done. Post added successfully.');
    }

    public function edit(Post $post)
    {
        return view('post.form', compact('post'));
    }

    public function update(PostRequest $request, Post $post)
    {
        $post->update(Arr::except($request->validated(), ['cover_image']));

        if ($request->hasFile('cover_image')) {
            $this->imageService->unlinkImage($post->cover_image);
            $post->cover_image = $this->imageService->storeImage($request->file('cover_image'));
            $post->save();
        }

        return redirect()->route('posts.edit', $post)->with('success', 'All done. Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post moved to trash');
    }

    public function restore($slug)
    {
        $post = Post::where('slug', $slug)->withTrashed()->firstOrFail();
        $post->restore();
        return redirect()->back()->with('success', 'Post has been restored.');
    }

    public function forceDelete($slug)
    {
        $post = Post::where('slug', $slug)->withTrashed()->firstOrFail();
        $this->imageService->unlinkImage($post->cover_image);
        $post->forceDelete();

        return redirect()->back()->with('success', 'Post has been deleted permanently.');
    }
}
