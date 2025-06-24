<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyCreateRequest;
use App\Models\Company;
use App\Models\JobApplication;
use App\Models\User;
use Hash;
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
        $industries=['Technology','Finance','Healthcare','Education','Manufacturing','Retail','Other'];
        return view("companies.create",compact('industries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyCreateRequest $request)
    {
        //
        $validated= $request->validated();
        
        //Create User
        $owner=User::create([
            'name'=> $validated['owner_name'],
            'email'=> $validated['owner_email'],
            'password'=>Hash::make($validated['owner_password']),
            'role'=>'company-owner'
        ]);

        //Return error if owner creation fails
        if(!$owner) {
                return redirect()->route('companeis.index')->with('error','Failed to create owner.');
        }


        //Create Company
        Company::create([
            'name'=> $validated['name'],
            'address'=>$validated['address'],
            'industry'=>$validated['industry'],
            'website'=>$validated['website'],
            'ownerId'=>$owner->id
        ]);

        return redirect()->route('companies.index')->with('success','Company Created Successfully.');
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




