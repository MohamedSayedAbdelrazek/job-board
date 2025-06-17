<?php

namespace App\Models;

use App\Models\JobVacancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobCategory extends Model
{
    //

    protected $table='job_categories';

    use HasFactory,HasUuids,SoftDeletes;

    protected $primaryKey='id';
    protected $keyType='string';
    public $incrementing=false;

    protected $fillable = [
        'name',
    ];

     protected function casts(): array
    {
        return [
            'deleted_at'=>'datetime'
        ];
    }

    public function jobVacancies()
    {
        return $this->hasMany(JobVacancy::class,'categoryId','id');
    }
}
