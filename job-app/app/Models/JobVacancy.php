<?php

namespace App\Models;

use App\Models\Company;
use App\Models\JobCategory;
use App\Models\JobApplication;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobVacancy extends Model
{
    //
    use HasFactory,HasUuids,SoftDeletes;

    protected $table='job_vacancies';

    protected $primaryKey='id';
    protected $keyType='string';
    public $incrementing=false;

    protected $fillable=[
        'title',
        'description',
        'location',
        'salary',
        'type',
        'required_skills',
        'view_count',
        'companyId',
        'jobCategoryId',
    ];

      protected function casts(): array
    {
        return [
            'deleted_at'=>'datetime'
        ];
    }

    public function company()
    {
        return $this->belongsTo(Company::class,'companyId','id');
    }

    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class,'jobCategoryId','id');
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class,'jobVacancyId','id');
    }

    
}
