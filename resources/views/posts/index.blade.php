@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                @if($featured != null)
                    <div class="card mb-3 border-secondary">
                        <h5 class="card-header text-white bg-secondary">Featured</h5>
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">{{ $featured->title }}</h5>
                            <h6 class="card-subtitle mb-2">by {{ $featured->user->name }}</h6>
                            <p class="card-text">{{ $featured->summary  }}</p>
                            <ul class="card-subtitle mb-2 text-muted meta-data small">
                                <li>
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $featured->getPublishedAtFormatted() }}
                                </li>
                                <li>
                                    <i class="fas fa-comments"></i>
                                    {{ $featured->comment_count }} comments
                                </li>
                            </ul>
                            <div class="text-right">
                                <a href="{{ route('posts.show', ['slug'=>$featured->slug]) }}"
                                   class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                @endif

                @if($isSearch)
                    <div class="alert alert-light" role="alert">
                        Searching for "{{ request()->get('search') }}"
                    </div>
                @endif

                <div class="row row-cols-1 row-cols-md-2">
                    @foreach($posts as $post)
                        <div class="col mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold">{{ $post->title }}</h5>
                                    <h6 class="card-subtitle mb-2">by {{ $post->user->name }}</h6>
                                    <p class="card-text">{{ $post->summary  }}</p>
                                    <div class="text-right">
                                        <a href="{{ route('posts.show', ['slug'=>$post->slug]) }}"
                                           class="btn btn-primary">Read More</a>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row small text-muted">
                                        <div class="col">
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ $post->getPublishedAtFormatted() }}
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments"></i>
                                            {{ $post->comment_count }} comments
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="row">
                    <div class="col-12"> {{ $posts->links() }}</div>
                </div>
            </div>

            <div class="col-md-4">

                <div class="card mb-3">
                    <div class="card-body">
                        <form class="input-group" method="get" action="{{ route('posts.index') }}">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search"
                                   name="search" id="search">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mb-3">
                    <h6 class="card-header text-white bg-secondary">Popular Posts</h6>
                    <ul class="list-group list-group-flush">

                        @foreach($topPosts as $post)
                            <li class="list-group-item">
                                <h5 class="card-title font-weight-bold">{{ $post->title }}</h5>
                                <h6 class="card-subtitle mb-2">by {{ $post->user->name }}</h6>
                                <div class="card-text">
                                    <div class="row small text-muted">
                                        <div class="col">
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ $post->getPublishedAtFormatted() }}
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{ route('posts.show', ['slug'=>$post->slug]) }}"
                                               class="card-link">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>

            </div>

        </div>
    </div>
@endsection
