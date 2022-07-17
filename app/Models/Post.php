<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
        'title',
        'slug',
        'content',
        'scheduled',
        'user_id',
    ];

    public function user()  // nel ajout
    {
        return $this->belongsTo(User::class);
    }
}
