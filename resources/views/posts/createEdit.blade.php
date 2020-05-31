@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title font-weight-bold">Create new post</h5>
                <form action="#" method="post">
                    @if(isset($post))
                        @method('PATCH')
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                               aria-label="Post title."
                               value="{{ old('name') ? old('name') : (isset($post) ? $post->title : '') }}">

                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="summary">Summary</label>
                        <input type="text" class="form-control @error('summary') is-invalid @enderror" id="summary"
                               aria-label="Post summary."
                               value="{{ old('summary') ? old('summary') : (isset($post) ? $post->summary : '') }}">

                        @error('summary')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" name="content"
                                  id="content" cols="30"
                                  rows="30">{{ old('content') ? old('content') : (isset($post) ? $post->content : '') }}</textarea>

                        @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="publish">Publish Date</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control @error('publish') is-invalid @enderror" id="publish"
                                   aria-label="Amount (to the nearest dollar)"
                                   value="{{ old('publish') ? old('publish') : (isset($post) ? $post->getPublishedAtEdit() : '') }}"
                                   aria-describedby="publishHelp">
                        </div>
                        <small id="publishHelp" class="form-text text-muted">
                            Format: dd/mm/yyyy hh:mm <br/>
                            Example: 25/12/2020 23:47
                        </small>
                        @error('publish')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>

                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <button type="submit"
                                    class="btn btn-primary">{{ isset($post) ? 'Update' : 'Submit' }}</button>
                        </div>
                        <div class="col-auto ml-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="featured">
                                <label class="form-check-label" for="featured">
                                    Featured Post?
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection
