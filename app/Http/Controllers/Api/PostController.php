<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with("category", "tags", "comments")->get();
        return response()->json($posts);
    }

    public function show($slug){

        $post = Post::where("slug", $slug)->with("category", "tags", "comments")->first();
        return response()->json($post);
    }
}

