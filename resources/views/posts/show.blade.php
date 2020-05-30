@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card mb-3">
            <div class="card-body">
                <h3 class="card-title font-weight-bold text-center"> {{ $post->title }}</h3>
                <hr>
                <h6 class="card-subtitle mb-3 mt-2 text-center">
                    <div class="row justify-content-md-center">
                        <div class="col col-lg-2">
                            by <span class="font-weight-bold">{{ $post->user->name }}</span>
                        </div>
                        <div class="col-md-auto"></div>
                        <div class="col col-lg-2">
                            <i class="fas fa-calendar-alt"></i>
                            {{ date('M d, Y', strtotime($post->published_at)) }}
                        </div>
                    </div>
                </h6>
                <hr>
                <p class="card-text">
                    {{ $post->content }}
                </p>
            </div>
            <div class="card-footer text-center">
                <i class="fas fa-tags"></i>
                @foreach($post->tags as $tag)
                    <a href="{{ route('posts.index', ['tag'=>$tag->name]) }}">{{ $tag->name }}</a>{{ !$loop->last ? ',' : '' }}
                @endforeach
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="media">
                    <img src="https://via.placeholder.com/150" class="align-self-start mr-3 rounded-circle"
                         alt="{{ $post->user->name }}">
                    <div class="media-body">
                        <h5 class="mt-0 font-weight-bold">{{ $post->user->name }}</h5>
                        <p class="mb-4">{{ $post->user->description }}</p>
                        <ul class="about-me text-center">
                            @if($post->user->hasFacebook())
                                <li>
                                    <a href="//{{ $post->user->facebook_link }}" target="_blank" class="text-secondary"
                                       title="Facebook">
                                        <i class="fab fa-facebook fa-2x"></i>
                                    </a>
                                </li>
                            @endif
                            @if($post->user->hasTwitter())
                                <li>
                                    <a href="//{{ $post->user->twitter_link }}" target="_blank" class="text-secondary"
                                       title="Twitter">
                                        <i class="fab fa-twitter fa-2x"></i>
                                    </a>
                                </li>
                            @endif
                            @if($post->user->hasGithub())
                                <li>
                                    <a href="//{{ $post->user->github_link }}" target="_blank" class="text-secondary"
                                       title="Github">
                                        <i class="fab fa-github fa-2x"></i>
                                    </a>
                                </li>
                            @endif
                            @if($post->user->hasYoutube())
                                <li>
                                    <a href="//{{ $post->user->youtube_link }}" target="_blank" class="text-secondary"
                                       title="Youtube">
                                        <i class="fab fa-youtube fa-2x"></i>
                                    </a>
                                </li>
                            @endif
                            @if($post->user->hasInstagram())
                                <li>
                                    <a href="//{{ $post->user->instagram_link }}" target="_blank" class="text-secondary"
                                       title="Instagram">
                                        <i class="fab fa-instagram fa-2x"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <post-comments
            :comments-data="{{ $post->comments()->with('user')->orderByDesc('created_at')->get() }}"
            :author-id="{{ $post->user->id }}"
            :post-id="{{ $post->id }}"
        >
        </post-comments>

    </div>
@endsection

