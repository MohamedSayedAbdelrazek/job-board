<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\JobVacancy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class JobVacancyController extends Controller
{
    //
    public function show (string $id) 
    {
        $jobVacancy=JobVacancy::findOrFail($id);
        
        return view('job-vacancies.show',compact('jobVacancy'));
    }

    public function apply(string $id) 
    {
        $jobVacancy=JobVacancy::findOrFail($id);
        return view('job-vacancies.apply',compact('jobVacancy'));
    }

    public function processApplication(Request $request,string $id) 
    {
        return "bla";
    }

}
