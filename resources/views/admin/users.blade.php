@extends('layouts.app')

@section('content')

    <div class="container">
        <h4 class="font-weight-bold">All Users</h4>
        <div> {{ $users->links() }}</div>
        <form class="input-group mb-3" method="get" action="{{ route('admin.users') }}">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search"
                   name="search" id="search">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
        <div class="list-group mb-3">
            @foreach($users as $user)
                <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 font-weight-bold">
                            @if($user->level == 1)
                                <span class="badge badge-success">Author</span>
                            @elseif($user->level >= 2)
                                <span class="badge badge-danger">Admin</span>
                            @endif
                            {{ $user->name }}
                        </h5>
                        <small>
                            @if($user->level < 2)
                                <form action="{{ route('admin.users.destroy', $user) }}" method="post"
                                      style="display: none;"
                                      id="delete-form-{{ $user->id }}">
                                    @method('DELETE')
                                    @csrf
                                </form>
                                <button class="btn btn-secondary btn-sm mr-2"
                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete?')) { document.getElementById('delete-form-{{$user->id}}').submit(); }">
                                    Delete
                                </button>
                            @endif

                            @if($user->level == 0)
                                <form action="{{ route('admin.users.update', $user) }}" method="post"
                                      style="display: none;"
                                      id="update-form-{{ $user->id }}">
                                    @method('PATCH')
                                    @csrf
                                    <input type="text" name="level" hidden value="1">
                                </form>
                                <button class="btn btn-secondary btn-sm mr-2"
                                        onclick="event.preventDefault(); if(confirm('Are you sure?')) { document.getElementById('update-form-{{$user->id}}').submit(); }">
                                    Make Author
                                </button>
                            @elseif($user->level == 1)
                                <form action="{{ route('admin.users.update', $user) }}" method="post"
                                      style="display: none;"
                                      id="update-form-{{ $user->id }}">
                                    @method('PATCH')
                                    @csrf
                                    <input type="text" name="level" hidden value="0">
                                </form>
                                <button class="btn btn-secondary btn-sm mr-2"
                                        onclick="event.preventDefault(); if(confirm('Are you sure?')) { document.getElementById('update-form-{{$user->id}}').submit(); }">
                                    Remove Author
                                </button>
                                <form action="{{ route('admin.users.update', $user) }}" method="post"
                                      style="display: none;"
                                      id="update-form2-{{ $user->id }}">
                                    @method('PATCH')
                                    @csrf
                                    <input type="text" name="level" hidden value="2">
                                </form>
                                <button class="btn btn-secondary btn-sm mr-2"
                                        onclick="event.preventDefault(); if(confirm('Are you sure?')) { document.getElementById('update-form2-{{$user->id}}').submit(); }">
                                    Make Admin
                                </button>

                            @elseif($user->level >= 2)

                                <form action="{{ route('admin.users.update', $user) }}" method="post"
                                      style="display: none;"
                                      id="update-form-{{ $user->id }}">
                                    @method('PATCH')
                                    @csrf
                                    <input type="text" name="level" hidden value="0">
                                </form>
                                <button class="btn btn-secondary btn-sm mr-2"
                                        onclick="event.preventDefault(); if(confirm('Are you sure?')) { document.getElementById('update-form-{{$user->id}}').submit(); }">
                                    Remove Admin
                                </button>
                            @endif

                            <i class="fas fa-calendar-alt"></i>
                            {{ $user->created_at }}
                        </small>
                    </div>
                    <p class="mb-1">{{ $user->summary }}</p>
                </div>
            @endforeach
        </div>
        <div> {{ $users->links() }}</div>
    </div>

@endsection
