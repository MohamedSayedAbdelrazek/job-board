<?php

namespace App\Http\Controllers;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function index()
    {
        //
        // $posts = Post::paginate(3);
        //$posts = Post::simplePaginate(3); // show next & previous
        $posts=Post::latest()->cursorPaginate(3); // not show the id of the page in the browser but show something complicate to follow 
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

    public function store(PostRequest $request)
    {
        $post=new Post();
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->author=$request->input('author');
        $post->published=$request->has('published');

        $post->save();

        return redirect()->route('posts.index')->with('success','Post Created Successfully.');
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
        $post=Post::findOrFail($id);
        
        return view('posts.edit',['pageTitle'=>"Edit Post: ".$post->title,'post'=>$post]);
    }

  
    public function update(PostRequest $request, string $id)
    {
        //
        $post=Post::findOrFail($id);

        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->author=$request->input('author');
        $post->published=$request->has('published');

        $post->save();

        return redirect()->route('posts.index')->with('success','Post Updated Successfully.');
    }

    public function destroy(string $id)
    {
        Post::destroy($id);

        return redirect()->back()->with('success','Post Deleted Successfully.');
    }
}
