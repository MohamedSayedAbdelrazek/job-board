<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\JobVacancy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DashboardController extends Controller
{
    //
    public function index() {
        $jobs=JobVacancy::query()->latest()->paginate(10)->withQueryString();
        return view('dashboard',compact('jobs'));
    }
}
