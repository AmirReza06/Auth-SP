<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index' , compact('posts'));
    }

    public function create()
    {
        Gate::authorize('create', Post::class);
        dd('Create Post');
    }
}
