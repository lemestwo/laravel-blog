@extends('layouts.app')

@section('content')

    <div class="container">
        <h4 class="font-weight-bold">All Comments</h4>
        <div> {{ $comments->links() }}</div>
        <div class="list-group mb-3">
            @foreach($comments as $comment)
                <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 font-weight-bold">Post: {{ $comment->post->title }}</h5>
                        <small>
                            <form action="{{ route('admin.comments.destroy', $comment) }}" method="post"
                                  style="display: none;"
                                  id="delete-form-{{ $comment->id }}">
                                @method('DELETE')
                                @csrf
                            </form>
                            <button class="btn btn-secondary btn-sm mr-2"
                                    onclick="event.preventDefault(); if(confirm('Are you sure you want to delete?')) { document.getElementById('delete-form-{{$comment->id}}').submit(); }">
                                Delete
                            </button>
                            <i class="fas fa-calendar-alt"></i>
                            {{ $comment->created_at }}
                        </small>
                    </div>
                    <p class="mb-1">{{ $comment->content }}</p>
                </div>
            @endforeach
        </div>
        <div> {{ $comments->links() }}</div>
    </div>

@endsection
