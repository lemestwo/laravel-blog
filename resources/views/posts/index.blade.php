@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                @if($featured != null)
                    <div class="card mb-3 border-secondary">
                        <h5 class="card-header text-white bg-secondary">Featured</h5>
                        <div class="card-body">
                            <h5 class="card-title">{{ $featured->title }}</h5>
                            <ul class="card-subtitle mb-2 text-muted meta-data small">
                                <li>
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ date('M d, Y', strtotime($featured->published_at)) }}
                                </li>
                                <li>
                                    <i class="fas fa-tags"></i>
                                    <a href="#">Test, </a>
                                    <a href="#">Test, </a>
                                    <a href="#">Test</a>
                                </li>
                                <li>
                                    <i class="fas fa-comments"></i>
                                    {{ $featured->comment_count }} comments
                                </li>
                            </ul>
                            <p class="card-text">{{ $featured->summary  }}</p>
                            <div class="text-right">
                                <a href="{{ route('posts.show', ['slug'=>$featured->slug]) }}"
                                   class="card-link text-right">Read More</a>
                            </div>
                        </div>
                    </div>
                @endif

                @if($isSearchOrTag)
                    <div class="alert alert-light" role="alert">
                        @if(request()->get('search') != null)
                            Searching for "{{ request()->get('search') }}"
                        @else
                            Tag "{{ request()->get('tag') }}"
                        @endif
                    </div>
                @endif

                <div class="row row-cols-1 row-cols-md-2">
                    @foreach($posts as $post)
                        <div class="col mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">{{ $post->summary  }}</p>
                                    <ul class="mb-2 text-muted meta-data small">
                                        <li>
                                            <i class="fas fa-tags"></i>
                                            @foreach($post->tags as $tag)
                                                <a href="{{ route('posts.index', ['tag'=>$tag->name]) }}">{{ $tag->name }}  @if (!$loop->last)
                                                        ,@endif</a>
                                            @endforeach
                                        </li>
                                    </ul>
                                    <div class="text-right">
                                        <a href="{{ route('posts.show', ['slug'=>$post->slug]) }}"
                                           class="btn btn-primary">Read More</a>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row small text-muted">
                                        <div class="col">
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ date('M d, Y', strtotime($post->published_at)) }}
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

                @include('posts.sidebar')

            </div>

        </div>
    </div>
@endsection
