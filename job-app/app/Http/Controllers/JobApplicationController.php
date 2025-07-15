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
    public function index(Request $request)
    {
        $query = JobApplication::where('userId', auth()->id());

        if ($request->status) {
            $query->where('status', $request->status);
        }
        $jobApplications = $query->latest()->paginate(10);

        if ($request->has('status') && $request->status !== null) {
            if ($request->status == "Pending") {
                $statusCounts = [
                    'Pending' => $jobApplications->count(),
                    'Accepted' => 0,
                    'Rejected' => 0,
                ];
            } else if ($request->status == "Accepted") {
                $statusCounts = [
                    'Pending' => 0,
                    'Accepted' => $jobApplications->count(),
                    'Rejected' => 0,
                ];
            } else {
                $statusCounts = [
                    'Pending' => 0,
                    'Accepted' => 0,
                    'Rejected' => $jobApplications->count(),
                ];
            }

        } else {
            //@MAGIC
            $statusCounts = JobApplication::where('userId', auth()->id())
                ->select('status', \DB::raw('count(*) as count'))
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();

            $statusCounts = array_merge([
                'Pending' => 0,
                'Accepted' => 0,
                'Rejected' => 0,
            ], $statusCounts);
        }





        return view('job-applications.index', compact('jobApplications', 'statusCounts'));
    }
}
