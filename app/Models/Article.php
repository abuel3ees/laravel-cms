<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    use SoftDeletes;
 protected $fillable = ['title', 'body', 'user_id','media_id'];   //
}
