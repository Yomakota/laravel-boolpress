<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(6);

        foreach ($posts as $post) {
            if ($post->cover) {
                $post->cover = asset('storage/' . $post->cover);
            }
        }

        $data = [
            'success' => true,
            'results' => $posts
        ];

        return response()->json($data);
    }

    public function show($slug)
    {
        //query per colonna slug = $slug con join per colonne tags e category
        $post = Post::where('slug', '=', $slug)->with(['tags', 'category'])->first();

        if ($post->cover) {
            $post->cover = asset('storage/' . $post->cover);
        } else {
            $post->cover = asset('img/laravel-image.png');
        }

        if ($post) {
            $data = [
                'success' => true,
                'results' => $post,
            ];
        } else {
            $data = [
                'success' => false,
            ];
        }
        return response()->json($data);
    }
}