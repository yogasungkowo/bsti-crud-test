<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = $user->student;
        
        // Auto-create student profile with user data
        if (!$student) {
            $student = Student::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'nisn' => null, 
                'gender' => null, 
                'date_of_birth' => null, 
                'address' => null, 
                'profile_picture' => null
            ]);
            
            return redirect()->route('student.edit', $student)
                ->with('info', 'Profil dasar telah dibuat. Silakan lengkapi data Anda.');
        }
        
        return view('pages.student.index', compact('student'));
    }

    public function create()
    {
        return view('pages.student.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nisn' => 'required|string|unique:students,nisn|max:255',
            'gender' => 'required|in:laki-laki,perempuan',
            'email' => 'required|email|unique:students,email',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],
        [
            'name.required' => 'Nama harus diisi.',
            'nisn.unique' => 'NISN sudah terdaftar.',
            'email.unique' => 'Email sudah terdaftar.',
            'gender.in' => 'Jenis kelamin harus laki-laki atau perempuan.',
            'nisn.required' => 'NISN harus diisi.',
            'email.required' => 'Email harus diisi.',
            'date_of_birth.required' => 'Tanggal lahir harus diisi.',
            'address.required' => 'Alamat harus diisi.',
            'profile_picture.image' => 'File harus berupa gambar.',
            'profile_picture.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'profile_picture.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')
                ->store('profile-pictures', 'public');
        }

        Student::create($validated);

        return redirect()->route('student.index')
            ->with('success', 'Profil berhasil dibuat!');
    }

    public function edit(Student $student)
    {
        // Validate that user can only edit their own profile
        if ($student->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('pages.student.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        // Validate that user can only update their own profile
        if ($student->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nisn' => 'required|string|max:255|unique:students,nisn,' . $student->id,
            'gender' => 'required|in:laki-laki,perempuan',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]
        ,
        [
            'name.required' => 'Nama harus diisi.',
            'nisn.unique' => 'NISN sudah terdaftar.',
            'email.unique' => 'Email sudah terdaftar.',
            'gender.in' => 'Jenis kelamin harus laki-laki atau perempuan.',
            'nisn.required' => 'NISN harus diisi.',
            'email.required' => 'Email harus diisi.',
            'date_of_birth.required' => 'Tanggal lahir harus diisi.',
            'address.required' => 'Alamat harus diisi.',
            'profile_picture.image' => 'File harus berupa gambar.',
            'profile_picture.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'profile_picture.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Delete old profile picture if exists
        if ($request->hasFile('profile_picture')) {
            if ($student->profile_picture) {
                Storage::disk('public')->delete($student->profile_picture);
            }

            $validated['profile_picture'] = $request->file('profile_picture')
                ->store('profile-pictures', 'public');
        }

        $student->update($validated);

        return redirect()->route('student.index')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    public function destroy(Student $student)
    {
        // Validate that user can only delete their own profile
        if ($student->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($student->profile_picture) {
            Storage::disk('public')->delete($student->profile_picture);
        }

        // Reset student data to basic user data, keeping name and email from user
        $user = Auth::user();
        $student->update([
            'name' => $user->name,
            'email' => $user->email,
            'nisn' => null,
            'gender' => null,
            'date_of_birth' => null,
            'address' => null,
            'profile_picture' => null
        ]);

        return redirect()->route('student.edit', $student)
            ->with('success', 'Profil berhasil direset! Data dasar (nama dan email) tetap tersimpan.');
    }
}
