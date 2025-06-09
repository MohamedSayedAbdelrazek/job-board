<?php

namespace App\Http\Controllers\api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data=Post::paginate(25);

       return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post=Post::create($request->all());
        return response()->json($post,200);
        // @TODO return response after Creating (201 created)
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $data=Post::find($id);

        if(!$data) {
            return response(["message"=>"Post Not Found!",404]);
        }
       return response()->json($data,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data=Post::find($id);
        
        if(!$data) {
            return response(["message"=>"Post Not Found!",404]);
        }

        $data->update($request->all());
        return response($data,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data=Post::find($id);
        
        if(!$data) {
            return response(["message"=>"Post Not Found!",404]);
        }
        
        $data->delete();
        return response(null,204);
    }
}
