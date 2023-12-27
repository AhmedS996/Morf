<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->input('title');

        $posts = Post::when($title, function ($query, $title) {
            return $query->where('title', $title);
        })
        ->latest() // Order by creation date in descending order (latest first)
        ->get();

        return view('posts.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function increaseLikes(Request $request, string $id)
    {
        $this->middleware('auth');

        $post = Post::findOrFail($id);
        $post->update(['like' => $post->like + 1]);

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ensure that the user is authenticated
        $this->middleware('auth');

        $post = Post::findOrFail($id);
        $post->load('comments'); // Load comments for the post

        // Increment views count
        $post->update(['view' => $post->view + 1]);

        return view('posts.show', compact('post'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
