@extends('layouts.dashboard')

@section('content')
    <h1>Edit this Post</h1>

    <form action=" {{ route('admin.posts.update', ['post' => $post->id]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label"><strong> Title </strong></label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
        </div>
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="category_id">Category</label>
            <select class="form-select" id="category_id" name="category_id">
                <option value="">None</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="content" class="form-label"><strong> Content </strong></label>
            <textarea class="form-control" id="content" name="content" rows="6">{{ old('content', $post->content) }}</textarea>
        </div>
        @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="actions-form">
            <input type="submit" class="btn btn-primary" value="Save Changes">
            <a class="btn btn-primary mx-3" href="{{ route('admin.posts.show', ['post' => $post->id]) }}"> Back </a>
        </div>
    </form>
@endsection
