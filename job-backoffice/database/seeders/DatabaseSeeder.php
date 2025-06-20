<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\JobApplication;
use App\Models\JobCategory;
use App\Models\JobVacancy;
use App\Models\Resume;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //seed the root admin
        User::firstOrCreate([
            'email'=>'admin@admin.com'
        ], [
            'name'=>"admin",
            'password'=>Hash::make('12345678'),
            'role'=>'admin',
            'email_verified_at'=>now()
        ]);

        //seed data to test with
        $jobData=json_decode(file_get_contents(database_path('data/job_data.json')),true);
        $jobApplications=json_decode(file_get_contents(database_path('data/job_applications.json')),true);

        //create job categories
        foreach($jobData['jobCategories'] as $category) {
            JobCategory::firstOrCreate([
                'name'=>$category
            ]);
        }

        //create companies

        foreach($jobData['companies'] as $company) {
       $companyOwner= User::firstOrCreate([
            'email'=>fake()->unique()->safeEmail()
        ], [
            'name'=>fake()->name(),
            'password'=>Hash::make('12345678'),
            'role'=>'company-owner',
            'email_verified_at'=>now()
        ]);

            Company::firstOrCreate([
                "name"=>$company['name'],
            ],[
                "address"=>$company['address'],
                "industry"=>$company['industry'],
                "website"=>$company['website'],
                "ownerId"=>$companyOwner->id
            ]);
        }

        foreach($jobData['jobVacancies'] as $job) {

            //get the created company 
           $company=Company::where('name',$job['company'])->firstOrFail();

            //get the created category 
           $category=JobCategory::where('name',$job['category'])->firstOrFail();

            JobVacancy::firstOrCreate([
                "title"=>$job['title'],
                "companyId"=>$company->id,
            ],[
            "description"=>$job['description'],
            "location"=>$job['location'],
            "type"=>$job['type'],
            "salary"=>$job['salary'],
            "required_skills"=>json_encode($job['technologies']),
            "view_count"=>1,
            "jobCategoryId"=>$category->id,
          
            ]);
            
        }

        foreach($jobApplications['jobApplications'] as $jobApplication) {
            $jobVacancy=JobVacancy::inRandomOrder()->first();

            $applicant= User::firstOrCreate([
                'email'=>fake()->unique()->safeEmail()
                ], 
                [
            'name'=>fake()->name(),
            'password'=>Hash::make('12345678'),
            'role'=>'job-seeker',
            'email_verified_at'=>now()
        ]);

        $resume=Resume::firstOrCreate([
            'fileName'=>$jobApplication['resume']['filename'],
            'fileUri'=>$jobApplication['resume']['fileUri'],
            'contactDetails'=>$jobApplication['resume']['contactDetails'],
            'summary'=>$jobApplication['resume']['summary'],
            'skills'=>$jobApplication['resume']['skills'],
            'experience'=>$jobApplication['resume']['experience'],
            'education'=>$jobApplication['resume']['education'],
            'userId'=>$applicant->id
        ]);

            JobApplication::firstOrCreate([
                'status'=>$jobApplication['status'],
                'aiGeneratedScore'=>$jobApplication['aiGeneratedScore'],
                'aiGeneratedFeedback'=>$jobApplication['aiGeneratedFeedback'],
                'userId'=>$applicant->id,
                'resumeId'=>$resume->id,
                'jobVacancyId'=>$jobVacancy->id
            ]);

        }
    }
}
