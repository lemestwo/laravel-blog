@extends('layouts.app')

@section('content')

    <div class="container">
        <h4 class="font-weight-bold">All Posts</h4>
        <div> {{ $posts->links() }}</div>
        <div class="list-group mb-3">
            @foreach($posts as $post)
                <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 font-weight-bold">@if($post->is_featured) <span class="badge badge-secondary">Featured</span> @endif {{ $post->title }}
                        </h5>
                        <small>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="post"
                                  style="display: none;"
                                  id="delete-form-{{$post->id}}">
                                @method('DELETE')
                                @csrf
                            </form>
                            <button class="btn btn-secondary btn-sm mr-2"
                                    onclick="event.preventDefault(); if(confirm('Are you sure you want to delete?')) { document.getElementById('delete-form-{{$post->id}}').submit(); }">
                                Delete
                            </button>
                            <i class="fas fa-calendar-alt"></i>
                            {{ $post->getPublishedAtFormatted() }}
                        </small>
                    </div>
                    <small>{{ $post->getCommentsCount() }} comments</small>
                    <p class="mb-1">{{ $post->summary }}</p>
                </div>
            @endforeach
        </div>
        <div> {{ $posts->links() }}</div>
    </div>

@endsection
