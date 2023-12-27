<!-- resources/views/posts/index.blade.php -->

@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    <div class="container">
        <h2 class="mb-4 mt-4">All Posts</h2>


        <!-- Search Form -->
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('posts.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="title" placeholder="Search by title" class="form-control" value="{{ request('title') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                        <div class="input-group-append">
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="container mt-4">
            <div class="btn-group" role="group" aria-label="Filter options">
                @php
                    $filters = [
                        '' => 'Latest',
                        'Most_views' => 'Most Views',
                        'Most_likes' => 'Most Likes',
                    ]
                @endphp
                @foreach ($filters as $key => $label)
                    <a href="{{ route('posts.index', ['filter' => $key]) }}" class="btn btn-outline-primary @if(request('filter', '') == $key) active @endif">{{ $label }}</a>
                @endforeach
            </div>
        </div>

        <!-- Display Posts -->
        <div class="row">
            @forelse ($posts as $post)
                <div class="col-md-12">
                    <div class="card post-card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Title: {{ $post->title }}</h5>
                            <p class="card-text">{{ $post->content }}</p>
                            <p class="card-text">Likes: {{ $post->like }}</p>
                            <p class="card-text">Views: {{ $post->view }}</p>
                            <p class="card-text"><small class="text-muted">Posted at: {{ $post->created_at }}</small></p>
                            <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn btn-primary">View Details</a>
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
