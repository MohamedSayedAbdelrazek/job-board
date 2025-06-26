<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobVacanyCreateRequest;
use App\Models\JobCategory;
use App\Models\Company;
use App\Models\JobVacancy;
use Illuminate\Http\Request;

class JobVacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query=JobVacancy::latest();
        
        if( $request->has("archived") ) {
            $query->onlyTrashed();
        }

        $jobVacancies=$query->paginate(10)->onEachSide(1);
        return view('job-vacancies.index', compact('jobVacancies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $types=['Full-Time','Part-Time','Remote','Hybrid','Contract'];
        $companies=Company::all();
        $categories=JobCategory::all();
        return view('job-vacancies.create',compact('types','companies','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobVacanyCreateRequest $request)
    {
        //
        $validated=$request->validated();
        //@TODO => Add those fields in the Create-job page, instead of fill it manually
        $validated['required_skills']='';
        $validated['view_count']=1;
        JobVacancy::create($validated);
        return redirect()->route('job-vacancies.index')->with('success','Job Vacancy Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $jobVacancy = JobVacancy::findOrFail($id);
        return view('job-vacancies.show', compact('jobVacancy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
