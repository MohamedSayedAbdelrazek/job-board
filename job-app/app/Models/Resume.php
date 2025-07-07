<?php

namespace App\Models;

use App\Models\User;
use App\Models\JobApplication;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resume extends Model
{
    //

    use HasFactory,HasUuids,SoftDeletes;
    protected $table='resumes';

    protected $primaryKey='id';
    protected $keyType='string';
    public $incrementing=false;

    protected $fillable=[
        'fileName',
        'fileUri',
        'contactDetails',
        'summary',
        'skills',
        'experience',
        'education',
        'userId'
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

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class,'resumeId','id');
    }
}
