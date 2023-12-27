<!-- resources/views/posts/show.blade.php -->

@extends('layouts.app')

@section('title', 'Post Details')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
            <p>Likes: <span id="likeCount">{{ $post->like }}</span></p>
            <p>Views: <span id="viewCount">{{ $post->view }}</span></p>
            <p>Posted at: {{ $post->created_at }}</p>

            <!-- Button to increase likes -->
            <form action="{{ route('posts.increaseLikes', ['post' => $post->id]) }}" method="post">
                @csrf
                @method('patch')
                <button type="submit" class="btn btn-primary">Increase Likes</button>
            </form>
        </div>
    </div>

    <!-- Display existing comments -->
    <div class="card mt-3">
        <div class="card-body">
            <h3>Comments</h3>
            @forelse ($post->comments as $comment)
                <div>
                    <p>{{ $comment->content }}</p>
                    <p>Likes: {{ $comment->like }}</p>
                    <!-- Add more details as needed -->
                </div>
            @empty
                <p>No comments yet.</p>
            @endforelse
        </div>
    </div>

    <!-- Form to add a new comment -->
    <div class="card mt-3">
        <div class="card-body">
            <h3>Add a Comment</h3>
            <form action="{{ route('comments.store', ['post' => $post->id]) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea name="content" id="content" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Comment</button>
            </form>
        </div>
    </div>
@endsection
