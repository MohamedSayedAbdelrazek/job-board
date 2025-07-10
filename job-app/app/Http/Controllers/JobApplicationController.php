<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\JobApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class JobApplicationController extends Controller
{
    //
    public function index () 
    {
        $statusCounts=[];
        $statusCounts['Pending']=JobApplication::where('userId',auth()->user()->id)
                                                ->where('status','Pending')->count();

        $statusCounts['Accepted']=JobApplication::where('userId',auth()->user()->id)
                                                ->where('status','Accepted')->count();

        $statusCounts['Rejected']=JobApplication::where('userId',auth()->user()->id)
                                                ->where('status','Rejected')->count();

        $jobApplications=JobApplication::where('userId',auth()->user()->id)->latest()->paginate(10);
        
        return view('job-applications.index',compact('jobApplications','statusCounts'));
    }
}
