<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobVacancy;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        //Last 30 days active users (job-seeker role)
        $activeUsers=User::where('last_login_at','>=',now()->subDays(30))
            ->where('role','job-seeker')->count();

        //Total Jobs (not deleted)   
        $totalJobs=JobVacancy::whereNull('deleted_at')->count();

        //total applications (not deleted)
        $totalApplications=JobApplication::whereNull('deleted_at')->count();

        $analytics=[
          'activeUsers'=>$activeUsers,
          'totalJobs'=>$totalJobs,
          'totalApplications'=>$totalApplications
        ];


        //Most Applied Jobs 
        $mostAppliedJobs=JobVacancy::withCount('jobApplications as totalCount')
        ->whereNull('deleted_at')  // handeled by laravel but type it for you
        ->orderByDesc('totalCount')
        ->limit(5)
        ->get();

        //conversion rates 
        $conversionRates=JobVacancy::withCount('jobApplications as totalCount')
        ->having('totalCount','>',0)
        ->limit(5)
        ->orderByDesc('totalCount')
        ->get()
        ->map(function($job){
            if($job->view_count>0)   //@MAGIC
                $job->conversionRate=round( $job->totalCount/$job->view_count *100,2);
            else
                $job->conversionRate=0;
            return $job;
        });
        return view('dashboard.index',compact('analytics','mostAppliedJobs','conversionRates'));
    }
}
