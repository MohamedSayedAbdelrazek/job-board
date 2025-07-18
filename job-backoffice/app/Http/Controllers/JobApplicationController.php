<?php

namespace App\Http\Controllers;

use App\Events\ApplicationStatusUpdated;
use App\Http\Requests\JobApplicationUpdateRequest;
use App\Models\JobApplication;
use App\Models\JobVacancy;
use App\Notifications\JobApplicationStatusUpdated;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query=JobApplication::latest();
        
        if(auth()->user()->role=='company-owner') {
            $query->whereHas('jobVacancy',function($query){
                $query->where('companyId',auth()->user()->company->id);
            });
        }
        if($request->has("archived")){
            $query->onlyTrashed();
        }
        $jobApplications=$query->paginate(10)->onEachSide(1);
        return view('job-applications.index',compact('jobApplications'));
    }

    public function show(string $id)
    {
        //
        $jobApplication=JobApplication::findOrFail($id);
        return view('job-applications.show',compact('jobApplication'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $jobApplication=JobApplication::findOrFail($id);
        return view('job-applications.edit',compact('jobApplication'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobApplicationUpdateRequest $request, string $id)
    {
        //
       $jobApplication=JobApplication::findOrFail($id);
       $jobApplication->update([
        'status'=> $request->input('status')
       ]);
       
       if(in_array($jobApplication->status,['Accepted','Rejected'])) {
          $jobApplication->user->notify(new JobApplicationStatusUpdated($jobApplication->status,$jobApplication->jobVacancy->title));
          event(new ApplicationStatusUpdated($jobApplication));
       }
       
        if($request->query('redirectToList')==true) {
                return redirect()->route('job-applications.show',$id)->with('success','Company Updated Successfully!');
        }

       return redirect()->route('job-applications.index')->with('success','Applicant Status Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $jobApplication=JobApplication::findOrFail($id);
        $jobApplication->delete();
        return redirect()->route('job-applications.index')->with('success','Job Application Archived Successfully.');
    }

    public function restore($id) {
        $jobVacancy=JobApplication::onlyTrashed()->findOrFail($id);
        $jobVacancy->restore();
        return redirect()->route('job-vacancies.index',['archived'=>true])->with('success','Job Vacancy Restored Successfully.');
    }
}
