<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'nisn',
        'gender',
        'date_of_birth',
        'address',
        'profile_picture',
    ];

    // Accessor untuk name (dari user)
    public function getNameAttribute()
    {
        return $this->user ? $this->user->name : 'Unknown';
    }

    // Accessor untuk email (dari user)
    public function getEmailAttribute()
    {
        return $this->user ? $this->user->email : null;
    }

    public function getProfilePictureUrlAttribute()
    {
        if ($this->profile_picture) {
            $awsUrl = config('filesystems.disks.spaces.url');
            if ($awsUrl) {
                return $awsUrl . '/' . $this->profile_picture;
            }
            
            // Fallback to local storage if available
            if (Storage::disk('public')->exists($this->profile_picture)) {
                return asset('storage/' . $this->profile_picture);
            }
        }
        
        // Default avatar if no profile picture - use user name
        $userName = $this->user ? $this->user->name : 'Student';
        return 'https://ui-avatars.com/api/?name=' . urlencode($userName) . '&size=200&background=667eea&color=fff';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
