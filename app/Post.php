<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = []; // don't guard anything

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(postImage::class); // not in use right now
    }

    public function toggle()
    {
        $this->ispublic = !$this->ispublic;
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
