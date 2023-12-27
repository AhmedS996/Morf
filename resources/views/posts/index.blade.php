<!-- resources/views/posts/index.blade.php -->

@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    <div class="container">
        <h2 class="mb-4">All Posts</h2>

        @auth
            <p>Welcome {{ auth()->user()->name }}</p>
        @endauth

        <div class="row">
            @forelse ($posts as $post)
                <div class="col-md-12"> <!-- Use col-md-12 to make each post take up one column -->
                    <div class="card post-card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Title: {{ $post->title }}</h5>
                            <p class="card-text">{{ $post->content }}</p>
                            <p class="card-text">Likes: {{ $post->like }}</p>
                            <p class="card-text">Views: {{ $post->view }}</p>
                            <p class="card-text"><small class="text-muted">Posted at: {{ $post->created_at }}</small></p>
                            <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn btn-primary">View Details</a>
                            <!-- Add more details or buttons as needed -->
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <p>No posts found.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
