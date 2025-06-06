<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    //universal unique identifier
    use HasUuids;

    protected $primaryKey='id';
    protected $keyType='string';
    public $incrementing=false;

 protected $fillable=['title','body','published','author'];
}
