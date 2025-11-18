<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Dashboard Admin
    public function index()
    {
        $totalUsers = User::count();
        $totalStudents = Student::count();
        $recentUsers = User::latest()->take(5)->get();
        $recentStudents = Student::with('user')->latest()->take(5)->get();

        return view('pages.admin.index', compact('totalUsers', 'totalStudents', 'recentUsers', 'recentStudents'));
    }

    // User Management
    public function users()
    {
        $users = User::with('student')->latest()->paginate(10);

        return view('pages.admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('pages.admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,student',
        ], [
            'role.in' => 'Peran harus berupa admin atau student.',
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'email_verified_at' => now(),
        ]);

        $user->assignRole($validated['role']);

        // Auto-create student profile if role is student
        if ($validated['role'] === 'student') {
            Student::create([
                'user_id' => $user->id,
                'nisn' => null,
                'gender' => null,
                'date_of_birth' => null,
                'address' => null,
                'profile_picture' => null,
            ]);
        }

        return redirect()->route('admin.users')
            ->with('success', 'User berhasil ditambahkan!');
    }

    public function editUser(User $user)
    {
        return view('pages.admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|in:admin,student',
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'role.in' => 'Peran harus berupa admin atau student.',
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $oldRole = $user->roles->first()?->name;

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (! empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        $user->syncRoles([$validated['role']]);

        // Handle role change
        if ($oldRole !== $validated['role']) {
            if ($validated['role'] === 'student' && ! $user->student) {
                Student::create([
                    'user_id' => $user->id,
                    'nisn' => null,
                    'gender' => null,
                    'date_of_birth' => null,
                    'address' => null,
                    'profile_picture' => null,
                ]);
            } elseif ($validated['role'] === 'admin' && $user->student) {
                $user->student->delete();
            }
        }

        return redirect()->route('admin.users')
            ->with('success', 'User berhasil diperbarui!');
    }

    public function destroyUser(User $user)
    {
        // Prevent admin from deleting themselves
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users')
                ->with('error', 'Anda tidak dapat menghapus akun sendiri!');
        }

        $user->delete();

        return redirect()->route('admin.users')
            ->with('success', 'User berhasil dihapus!');
    }

    // Student Management
    public function students()
    {
        $students = Student::with('user')->latest()->paginate(10);

        return view('pages.admin.students.index', compact('students'));
    }

    public function createStudent()
    {
        return view('pages.admin.students.create');
    }

    public function storeStudent(Request $request)
    {
        $validated = $request->validate([
            // User data
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:users,email',
            'user_password' => 'required|string|min:8|confirmed',

            // Student data
            'nisn' => 'required|string|max:255|unique:students,nisn',
            'gender' => 'required|in:laki-laki,perempuan',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'user_name.required' => 'Nama user harus diisi.',
            'user_email.required' => 'Email user harus diisi.',
            'user_email.unique' => 'Email user sudah terdaftar.',
            'user_password.required' => 'Password harus diisi.',
            'user_password.min' => 'Password minimal 8 karakter.',
            'user_password.confirmed' => 'Konfirmasi password tidak cocok.',
            'nisn.required' => 'NISN harus diisi.',
            'nisn.unique' => 'NISN sudah terdaftar.',
            'gender.required' => 'Jenis kelamin harus diisi.',
            'gender.in' => 'Jenis kelamin harus laki-laki atau perempuan.',
            'date_of_birth.required' => 'Tanggal lahir harus diisi.',
            'address.required' => 'Alamat harus diisi.',
            'profile_picture.image' => 'File harus berupa gambar.',
            'profile_picture.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'profile_picture.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Create user first
        $user = User::create([
            'name' => $validated['user_name'],
            'email' => $validated['user_email'],
            'password' => Hash::make($validated['user_password']),
            'email_verified_at' => now(),
        ]);

        // Assign student role
        $user->assignRole('student');

        // Prepare student data
        $studentData = [
            'user_id' => $user->id,
            'nisn' => $validated['nisn'],
            'gender' => $validated['gender'],
            'date_of_birth' => $validated['date_of_birth'],
            'address' => $validated['address'],
        ];

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time().'_'.$file->hashName();

            // Upload to Spaces
            $path = Storage::disk('spaces')->putFileAs(
                'profile-pictures',
                $file,
                $filename,
                'public'
            );

            $studentData['profile_picture'] = $path;
        }

        // Create student
        Student::create($studentData);

        return redirect()->route('admin.students')
            ->with('success', 'Data siswa dan user berhasil ditambahkan!');
    }

    public function showStudent(Student $student)
    {
        $student->load('user');

        return view('pages.admin.students.show', compact('student'));
    }

    public function editStudent(Student $student)
    {
        $student->load('user');

        return view('pages.admin.students.edit', compact('student'));
    }

    public function updateStudent(Request $request, Student $student)
    {
        $validated = $request->validate([
            'nisn' => 'required|string|max:255|unique:students,nisn,'.$student->id,
            'gender' => 'required|in:laki-laki,perempuan',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nisn.required' => 'NISN harus diisi.',
            'nisn.unique' => 'NISN sudah terdaftar.',
            'gender.required' => 'Jenis kelamin harus diisi.',
            'gender.in' => 'Jenis kelamin harus laki-laki atau perempuan.',
            'date_of_birth.required' => 'Tanggal lahir harus diisi.',
            'address.required' => 'Alamat harus diisi.',
            'profile_picture.image' => 'File harus berupa gambar.',
            'profile_picture.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
        ]);

        if ($request->hasFile('profile_picture')) {
            // Delete old file
            if ($student->profile_picture) {
                Storage::disk('spaces')->delete($student->profile_picture);
            }

            $file = $request->file('profile_picture');
            $filename = time().'_'.$file->hashName();

            // Upload ke folder profile-pictures
            $path = Storage::disk('spaces')->putFileAs(
                'profile-pictures',
                $file,
                $filename,
                'public'
            );

            $validated['profile_picture'] = $path;
        }

        $student->update($validated);

        return redirect()->route('admin.students')
            ->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroyStudent(Student $student)
    {
        // Delete profile picture from Spaces if exists
        if ($student->profile_picture) {
            Storage::disk('spaces')->delete($student->profile_picture);
        }

        $student->delete();

        return redirect()->route('admin.students')
            ->with('success', 'Data siswa berhasil dihapus!');
    }
}
