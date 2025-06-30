<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;
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
    public $industries=['Technology','Finance','Healthcare','Education','Manufacturing','Retail','Other'];

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
        $industries=$this->industries;
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
    public function show(string $id=null)
    {
        //
       $company=$this->getCompany($id);
        
        return view('companies.show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id=null)
    {
        //
        $company=$this->getCompany($id);
    
        $owner=$company->owner;
        $industries=$this->industries;
        return view('companies.edit',compact('company','owner','industries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyUpdateRequest $request, string $id=null)
    {
        //
        $validated= $request->validated();

        $company=$this->getCompany($id);

        $company->update([
            'name'=> $validated['name'],
            'address'=>$validated['address'],
            'industry'=>$validated['industry'],
            'website'=>$validated['website']
        ]);

        //Update Owner
        
        //Do this because the password might be empty-> that mean owner need to keep it the same 
        $ownerData=[];

        $ownerData['name']= $validated['owner_name'];

        if($validated['owner_password']) {
            $ownerData['password']=Hash::make(  $validated['owner_password']);
        }
        $company->owner->update($ownerData);
    
        if(auth()->user()->role=='company-owner'){
            return redirect()->route('my-company.show')->with('success','Company Updated Successfully!');
        }

        if($request->query('redirectToList')==true) {
                return redirect()->route('companies.show',$id)->with('success','Company Updated Successfully!');
        }

        return redirect()->route('companies.index')->with('success','Company Updated Successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $company=Company::findOrFail($id);
        $company->delete();
        return redirect()->route('companies.index')->with('success','Company Archived Successfully!');
    }

    public function restore($id) {
        $company=Company::onlyTrashed()->findOrFail($id);
        $company->restore();
        return redirect()->route('companies.index',['archived'=>true])->with('success','Company Restored Successfully!');
    }

    private function getCompany($id) {
          if($id)
            return Company::findOrFail($id);
        
            return Company::where('ownerId',auth()->user()->id)->first();
    }
}




