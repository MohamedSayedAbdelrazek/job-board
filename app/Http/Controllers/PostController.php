<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function index()
    {
        //
        // $posts = Post::paginate(3);
        //$posts = Post::simplePaginate(3); // show next & previous
        $posts=Post::cursorPaginate(3);  // not show the id of the page in the browser but show something complicate to follow 
        return view('posts.index',['posts'=>$posts,'pageTitle'=>'blog']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
           // Post::create([
        //     'title'=>'Second Post',
        //     'body'=>'Second body',
        //     'author'=>'Mohamed',
        //     'published'=>true
        // ]);

        // Post::factory(100)->create();

            return view("posts.create",["pageTitle"=>"Create Post"]);
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'title'=>'required',
            'body'=>'required',
            'author'=>'required',
        ],[ // for the error message to save field's names in DB
            'title.required'=>'Mandatory Field',
            'body.required'=>'Mandatory Field',
            'author.required'=>'Mandatory Field'
        ]);
print_r($request->all());


        // @TODO:
        // @FIXME
        // @NOTE
        // @TODO
        // @LARAVEL
        // @MAGIC


    }

   
    public function show(string $id)
    {
       $post= Post::findOrFail($id);
       return view('posts.show',['post'=>$post,'pageTitle'=>$post->title]);
    }

   
    public function edit(string $id)
    {
        //
    }

  
    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
