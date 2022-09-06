@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1> {{ $post->title }} </h1>
        <div class="row post-details">
            <div class="col-12 info">
                <div class="border-bottom border-top border-dark py-3">
                    <div> <strong> Created at: </strong>{{ $post->created_at->format('j F Y') }}</div>
                    @if ($created_on > 0)
                        <div> <strong> Created on: </strong>{{ $created_on }} day{{ $created_on > 1 ? 's' : '' }} ago
                        </div>
                    @else
                        <div><strong> Created on: </strong>Today</div>
                    @endif
                    <div> <strong> Updated at: </strong>{{ $post->updated_at->format('j F Y') }}</div>
                    <div> <strong> Slug: </strong>{{ $post->slug }}</div>
                </div>
            </div>
            <div class="col-12 content">
                <h2 class="mt-4"> Content:</h2>
                <p class="border-bottom border-top border-dark py-3">{{ $post->content }}</p>
            </div>
        </div>
        <div class="row actions">
            <div class="col-4">
                <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit Post</a>
            </div>
            <div class="col-4">
                <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="Delete Post"
                        onClick="return confirm('Are you sure to delete this post')">
                </form>
            </div>
            <div class="col-4">
                <a class="btn btn-primary" href="{{ route('admin.posts.index') }}"> Back </a>
            </div>
        </div>
    </div>
@endsection
