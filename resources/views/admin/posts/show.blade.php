@extends('layouts.dashboard')

@section('content')
    <h1> {{ $post->title }} </h1>

    <div> <strong> Created at: </strong>{{ $post->created_at }}</div>
    <div> <strong> Updated at: </strong>{{ $post->updated_at }}</div>
    <div> <strong> Slug: </strong>{{ $post->slug }}</div>

    <h3 class="mt-4"> Content:</h3>
    <p>{{ $post->content }}</p>
@endsection
