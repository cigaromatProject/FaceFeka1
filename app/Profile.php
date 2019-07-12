<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = []; // disable mass-assignment protection

    public function profileImage()
    {
        // Set the profile image selected by the user. Otherwise set a default image
        $imagePath = ($this->image) ? $this->image : 'profile/default.png';
        return '/storage/' . $imagePath;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
