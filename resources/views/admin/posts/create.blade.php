@extends('layouts.dashboard')

@section('content')
    <h1>Create a new Post</h1>

    <form action=" {{ route('admin.posts.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
        </div>
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="6">{{ old('content') }}</textarea>
        </div>
        @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="actions-form">
            <input type="submit" class="btn btn-primary" value="Save Post">
            <a class="btn btn-primary mx-3" href="{{ route('admin.posts.index') }}"> Back </a>
        </div>
    </form>
@endsection
