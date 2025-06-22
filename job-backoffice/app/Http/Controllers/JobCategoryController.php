<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobCategoryUpdateRequest;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use App\Http\Requests\JobCategoryCreateRequest;

class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query=JobCategory::latest(); //

        if($request->has("archived")){
            $query->onlyTrashed();
        }

        $jobCategories=$query->paginate(10)->onEachSide(1);
        return view('categories.index',compact('jobCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobCategoryCreateRequest $request)
    {
        //
        $validated=$request->validated(); // return array of validated data
        JobCategory::create($validated);
        return redirect()->route('categories.index')->with('success','Job category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return "show";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $jobCategory=JobCategory::find($id);

        return view('categories.edit',compact('jobCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobCategoryUpdateRequest $request, string $id)
    {
        //
        $validated=$request->validated();
        $jobCategory = JobCategory::findOrFail($id);
        $jobCategory->update($validated);
        return redirect()->route('categories.index')->with('success','Job Category Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $jobCategory=JobCategory::findOrFail($id);
        $jobCategory->delete();
        return redirect()->route('categories.index')->with('success','Job Category Archived Successfully!');
        
    }

    public function restore(string $id)
    {
        //
        $jobCategory=JobCategory::onlyTrashed()->findOrFail($id);
        $jobCategory->restore();
        return redirect()->route('categories.index',['archived',true])->with('success','Job Category Restored Successfully!');
    }
}
