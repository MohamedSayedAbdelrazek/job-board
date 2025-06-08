<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    //universal unique identifier
    use HasUuids,HasFactory;

    protected $primaryKey='id';
    protected $keyType='string';
    public $incrementing=false;

 protected $fillable=['title','body','published','author'];
}
