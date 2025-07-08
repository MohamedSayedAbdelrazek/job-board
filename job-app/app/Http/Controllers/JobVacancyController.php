<?php

namespace App\Http\Controllers;
use App\Http\Requests\ApplyJobRequest;
use App\Models\JobApplication;
use App\Models\JobVacancy;
use App\Models\Resume;
class JobVacancyController extends Controller
{
    //
    public function show(string $id)
    {
        $jobVacancy = JobVacancy::findOrFail($id);

        return view('job-vacancies.show', compact('jobVacancy'));
    }

    public function apply(string $id)
    {
        $jobVacancy = JobVacancy::findOrFail($id);
        $resumes=auth()->user()->resumes;
        return view('job-vacancies.apply', compact('jobVacancy','resumes'));
    }

    public function processApplication(ApplyJobRequest $request, string $id)
    {
        $extractedInfo=null;
        $resumeId=null;
        if($request->input('resume_option')==='new_resume') 
        {
        $file=$request->file('resume_file');
        $extension=$file->getClientOriginalExtension();
        $originalFileName=$file->getClientOriginalName();
        $fileName='resume_'.time().'.'.$extension;

        //Store in laravel cloud
        $path=$file->storeAs('resumes',$fileName,'cloud');

        //$fileUrl=config('filesystems.disks.cloud.url').'/'.$path;

        //TODO Extract information from the resume
        $extractedInfo=[
            'summary'=>'',
            'skills'=>'',
            'experience'=>'',
            'education'=>''
        ];

        
        $resume=Resume::create([
            'fileName'=>$originalFileName,
            'fileUri'=>$path,
            'userId'=>auth()->user()->id,
            //@MAGIC
            'contactDetails'=>json_encode([
                'name'=>auth()->user()->name,
                'email'=>auth()->user()->email
            ]),
            'summary'=>$extractedInfo['summary'],
            'skills'=>$extractedInfo['skills'],
            'experience'=>$extractedInfo['experience'],
            'education'=>$extractedInfo['education']
        ]);
        $resumeId=$resume->id;
      
        }
        else 
        {
            $resumeId=$request->input('resume_option');
            $resume=Resume::findOrFail($resumeId);

            $extractedInfo=[
            'summary'=>$request->summary,
            'skills'=>$request->skills,
            'experience'=>$request->experience,
            'education'=>$request->education
            ];

        }

        //TODO Evaluate Job Application


          JobApplication::create([
            'status'=>'pending',
            'jobVacancyId'=>$id,
            'resumeId'=>$resumeId,
            'userId'=>auth()->id(),
            'aiGeneratedScore'=>0,
            'aiGeneratedFeedback'=>0
        ]);
        return redirect()->route('job-applications.index')->with('success','Application Submitted Successfully.');
    }

}
