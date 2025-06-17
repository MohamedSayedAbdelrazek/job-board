<?php

namespace App\Models;

use App\Models\User;
use App\Models\Resume;
use App\Models\JobVacancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobApplication extends Model
{
    //

     use HasFactory,HasUuids,SoftDeletes;

     protected $table='job_applications';
    protected $primaryKey='id';
    protected $keyType='string';
    public $incrementing=false;


    protected $fillable=[
        'status',
        'aiGeneratedScore',
        'aiGeneratedFeedback',
        'userId',
        'resumeId',
        'jobVacancyId'
    ];


     protected function casts(): array
    {
        return [
            'deleted_at'=>'datetime'
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class,'userId','id');
    }

    public function resume()
    {
        return $this->belongsTo(Resume::class,'resumeId','id');
    }

    public function jobVacancy()
    {
        return $this->belongsTo(JobVacancy::class,'jobVacancyId','id');
    }
}
