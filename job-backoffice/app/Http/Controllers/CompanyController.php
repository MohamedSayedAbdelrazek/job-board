<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
          $query=Company::latest(); //

        if($request->has("archived")){
            $query->onlyTrashed();
        }

        $companies=$query->paginate(10)->onEachSide(1);
        return view('companies.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("companies.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        return "bla";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $company = Company::findOrFail($id);
        //$jobApplications=JobApplication::with('user')->whereIn('jobVacancyId',$company->jobVacancies()->pluck('id'))->get();
        return view('companies.show',compact('company'));
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




