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
    public function index(Request $request) {
        $query=JobVacancy::query();

        if($request->has('search') && $request->has('filter')) {
              $query->where('type',$request->filter)

              ->where(function($q)use($request){
                $q->where('title','like','%'.$request->search.'%')
                ->orWhere('location','like','%'.$request->search.'%')
                ->orWhereHas('company',function($q2) use($request){
                $q2->where('name','like','%'.$request->search.'%');
                }); 
              });
             
        }



        if($request->has('search') && $request->filter==null) {
            $query->where('title','like','%'.$request->search.'%')
            ->orWhere('location','like','%'.$request->search.'%')
            ->orWhereHas('company',function($query) use($request){
                $query->where('name','like','%'.$request->search.'%');
            });
        }

        if($request->has('filter') && $request->search==null) {
            $query->where('type',$request->filter);
        }

        $jobs=$query->latest()->paginate(10)->withQueryString();
        return view('dashboard',compact('jobs'));
    }
}
