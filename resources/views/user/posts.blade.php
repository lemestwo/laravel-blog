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
                        <h5 class="mb-1 font-weight-bold">@if($post->is_featured) <span class="badge badge-secondary">Featured</span> @endif {{ $post->title }}
                        </h5>
                        <small>
                            <form action="{{ route('posts.destroy', $post) }}" method="post" style="display: none;"
                                  id="delete-form-{{$post->id}}">
                                @method('DELETE')
                                @csrf
                            </form>
                            <button class="btn btn-secondary btn-sm mr-2" href="{{ route('posts.destroy', $post) }}"
                                    onclick="event.preventDefault(); if(confirm('Are you sure you want to delete?')) { document.getElementById('delete-form-{{$post->id}}').submit(); }">
                                Delete
                            </button>
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
