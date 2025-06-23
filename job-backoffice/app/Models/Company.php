<?php

namespace App\Models;

use App\Models\User;
use App\Models\JobVacancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    //
    protected $table='companies';


    
    use HasFactory,HasUuids,SoftDeletes;

    protected $primaryKey='id';
    protected $keyType='string';
    public $incrementing=false;


    protected $fillable=['name','address','industry','website','ownerId'];


     protected function casts(): array
    {
        return [
            'deleted_at'=>'datetime'
        ];
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'ownerId','id');
    }

    public function jobVacancies()
    {
        return $this->hasMany(JobVacancy::class,'companyId','id');
    }

    public function jobApplications()
    {
        return $this->hasManyThrough(
            JobApplication::class,
            JobVacancy::class,
            'companyId',
            'jobVacancyId',
            'id',
            'id'
        );
    }
}
