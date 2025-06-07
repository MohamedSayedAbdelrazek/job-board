<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //

    public function index()
    {
        $posts = Post::all();
        return view('posts.index',['posts'=>$posts,'pageTitle'=>'blog']);
    }

    public function create()
    {
        Post::create([
            'title'=>'Second Post',
            'body'=>'Second body',
            'author'=>'Mohamed',
            'published'=>true
        ]);

        return redirect()->route('posts.index');
    }
}
