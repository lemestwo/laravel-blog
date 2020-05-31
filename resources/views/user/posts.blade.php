@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row pb-2">
            <div class="col">
                <h5 class="font-weight-bold">Posts List</h5>
            </div>
            <div class="col-auto">
                <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">New Post</a>
            </div>
        </div>
        <div class="list-group">
            @foreach($posts as $post)
                <a href="{{ route('posts.edit', $post) }}"
                   class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 font-weight-bold">{{ $post->title }}</h5>
                        <small>
                            <i class="fas fa-calendar-alt"></i>
                            {{ $post->getPublishedAtFormatted() }}
                        </small>
                    </div>
                    <small>{{ $post->getCommentsCount() }} comments</small>
                    <p class="mb-1">{{ $post->summary }}</p>
                </a>
            @endforeach
        </div>
    </div>

@endsection
