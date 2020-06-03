@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header font-weight-bold">Total Posts: {{ $totalPosts }}</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($lastPosts as $post)
                            <li class="list-group-item">
                                <h5 class="card-title font-weight-bold">{{ $post->title }}</h5>
                                <h6 class="card-subtitle mb-2">{{ $post->getCommentsCount() }} comments</h6>
                                <div class="card-text">
                                    <div class="row small text-muted">
                                        <div class="col">
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ $post->getPublishedAtFormatted() }}
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{ route('posts.show', ['slug'=>$post->slug]) }}"
                                               class="card-link">Go to Post</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="card-footer">
                        <a href="{{ route('admin.posts') }}" class="stretched-link">See all</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header font-weight-bold">Total Users: {{ $totalUsers }}</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($lastUsers as $user)
                            <li class="list-group-item">
                                <div class="card-title">
                                    <div class="row">
                                        <h5 class="col font-weight-bold">
                                            {{ $user->name }}
                                        </h5>
                                        <div class="col-auto small text-muted">
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ $user->created_at }}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-text">
                                    {{ $user->summary }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="card-footer">
                        <a href="{{ route('admin.users') }}" class="card-link">See all</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header font-weight-bold">Total Comments: {{ $totalComments }}</h5>
            <ul class="list-group list-group-flush">
                @foreach($lastComments as $comment)
                    <li class="list-group-item">
                        <h5 class="card-title font-weight-bold">Post: {{ $comment->post->title }}</h5>
                        <h6 class="card-subtitle mb-2">{{ $comment->content }}</h6>
                        <div class="card-text">
                            <div class="row small text-muted">
                                <div class="col">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $comment->created_at }}
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('posts.show', ['slug'=>$comment->post->slug]) }}"
                                       class="card-link">Go
                                        to Post</a>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="card-footer">
                <a href="{{ route('admin.comments') }}" class="card-link">See all</a>
            </div>
        </div>
    </div>

@endsection
