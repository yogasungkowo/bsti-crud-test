<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Assign role menggunakan Spatie
        $user->assignRole($validated['role']);

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
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,student',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // Sync role menggunakan Spatie (hapus role lama, assign role baru)
        $user->syncRoles([$validated['role']]);

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
            'name' => 'required|string|max:255',
            'nisn' => 'required|string|max:255|unique:students,nisn,' . $student->id,
            'gender' => 'required|in:laki-laki,perempuan',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            if ($student->profile_picture) {
                Storage::disk('public')->delete($student->profile_picture);
            }

            $validated['profile_picture'] = $request->file('profile_picture')
                ->store('profile-pictures', 'public');
        }

        $student->update($validated);

        return redirect()->route('admin.students')
            ->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroyStudent(Student $student)
    {
        if ($student->profile_picture) {
            Storage::disk('public')->delete($student->profile_picture);
        }

        $student->delete();

        return redirect()->route('admin.students')
            ->with('success', 'Data siswa berhasil dihapus!');
    }
}
