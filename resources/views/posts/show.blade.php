<!-- resources/views/posts/show.blade.php -->

@extends('layouts.app')

@section('title', 'Post Details')

@section('content')
    <div class="card mt-5">
        <div class="card-body shadow">
            <h2>{{ $post->title }}</h2>
            <hr>
            <p>{{ $post->content }}</p>
            <hr>
            <div class="d-flex justify-content-between pr-3 pl-3">
            <p>Likes: <span id="likeCount">{{ $post->like }}</span></p>
            <p>Views: <span id="viewCount">{{ $post->view }}</span></p>
            <p>Posted at: {{ $post->created_at }}</p>
            </div>

            <!-- Button to increase likes -->
            <form action="{{ route('posts.increaseLikes', ['post' => $post->id]) }}" method="post">
                @csrf
                @method('patch')
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-thumbs-up"></i></button>
            </form>
        </div>
    </div>

    <!-- Display existing comments -->
    <div class="card mt-3">
        <div class="card-body">
            <h3>Comments</h3>
            <hr>
            @forelse ($post->comments as $comment)
                <div class="comment-container shadow p-4">
                    <p class="text-muted">Commented by: {{ auth()->user()->name }}</p>
                    <hr>
                    <p>{{ $comment->content }}</p>
                    <p>Likes: <span id="likeCount-comment-{{ $comment->id }}">{{ $comment->like }}</span></p>
                    <!-- Add more details as needed -->

                    <!-- Button to increase likes for the comment -->
                    <form action="{{ route('comments.increaseLikes', ['comment' => $comment->id]) }}" method="post">
                        @csrf
                        @method('patch')
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-regular fa-thumbs-up"></i>
                        </button>
                    </form>
                </div>
                @unless($loop->last)
                    <hr class="comment-divider">
                @endunless
            @empty
                <p>No comments yet.</p>
            @endforelse
        </div>
    </div>

    <!-- Form to add a new comment -->
    <div class="card mt-3 mb-4">
        <div class="card-body shadow">
            <h3>Add a Comment</h3>
            <form action="{{ route('posts.comments.store', ['post' => $post->id]) }}" method="post">
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
