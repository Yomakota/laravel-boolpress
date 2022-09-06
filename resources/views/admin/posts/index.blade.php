@extends('layouts.dashboard')

@section('content')
    <h1>Posts List</h1>
    @if ($deleted === 'yes')
        <div class="alert alert-primary" role="alert">
            Post Successfully deleted!
        </div>
    @endif

    <div class="row row-cols-2">
        @foreach ($posts as $post)
            {{-- Single-post --}}
            <div class="col mt-4">
                <div class="card h-100">
                    {{-- <img class="card-img-top" src="" alt=""> --}}
                    <div class="card-body">
                        <h3 class="card-title h-50"> {{ $post->title }} </h3>
                        {{-- <p class="card-text">text </p> --}}
                        <div class="mt-3">
                            <a href=" {{ route('admin.posts.show', ['post' => $post->id]) }} " class="btn btn-primary">Post
                                Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End-Single-post --}}
        @endforeach
    </div>
@endsection
