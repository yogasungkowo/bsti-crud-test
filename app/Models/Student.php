<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'nisn',
        'gender',
        'email',
        'date_of_birth',
        'address',
        'profile_picture',
    ];

    public function getProfilePictureUrlAttribute()
    {
        return $this->profile_picture ? asset('storage/' . $this->profile_picture) : asset('images/default-profile.png');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
