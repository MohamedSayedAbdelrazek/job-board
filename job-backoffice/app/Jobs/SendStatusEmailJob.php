<?php

namespace App\Jobs;

use App\Mail\ApplicationStatusMail;
use App\Models\JobApplication;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
class SendStatusEmailJob implements ShouldQueue
{
    use Queueable,SerializesModels;

    /**
     * Create a new job instance.
     */
    public $jobApplication;
    public function __construct(JobApplication $jobApplication)
    {
        //
        $this->jobApplication = $jobApplication;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
           Mail::to($this->jobApplication->user->email)
            ->send(new ApplicationStatusMail($this->jobApplication));
    }
}
