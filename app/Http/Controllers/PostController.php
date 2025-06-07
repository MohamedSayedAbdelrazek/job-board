<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //

    public function index()
    {
        // $posts = Post::paginate(3);
        //$posts = Post::simplePaginate(3); // show next & previous
        $posts=Post::cursorPaginate(3);  // not show the id of the page in the browser but show something complicate to follow 
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
