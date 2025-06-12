<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    //
    //universal unique identifier
    use HasUuids,HasFactory;

    protected $primaryKey='id';
    protected $keyType='string';
    public $incrementing=false;

 protected $fillable=['title','body','published','user_id'];

 public function user()
 {
    return $this->belongsTo(User::class);
 }
}
