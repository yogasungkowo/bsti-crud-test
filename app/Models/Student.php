<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        if ($this->profile_picture) {
            // Cek apakah menggunakan Spaces
            $awsUrl = config('filesystems.disks.spaces.url');
            if ($awsUrl) {
                // Generate URL dari Spaces
                return $awsUrl . '/' . $this->profile_picture;
            }
            
            // Fallback ke storage lokal jika ada
            if (Storage::disk('public')->exists($this->profile_picture)) {
                return asset('storage/' . $this->profile_picture);
            }
        }
        
        // Default avatar jika tidak ada gambar
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&size=200&background=667eea&color=fff';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
