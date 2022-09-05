@extends('layouts.dashboard')

@section('content')
    <h1>Posts List</h1>

    <div class="row row-cols-3">
        @foreach ($posts as $post)
            {{-- Single-post --}}
            <div class="col mt-4">
                <div class="card h-100">
                    {{-- <img class="card-img-top" src="" alt=""> --}}
                    <div class="card-body">
                        <h3 class="card-tile"> {{ $post->title }} </h3>
                        {{-- <p class="card-text">text </p> --}}
                        <a href=" {{ route('admin.posts.show', ['post' => $post->id]) }} " class="btn btn-primary">Posts
                            Details</a>
                    </div>
                </div>
            </div>
            {{-- End-Single-post --}}
        @endforeach
    </div>
@endsection
