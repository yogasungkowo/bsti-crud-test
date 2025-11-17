@php
    use Carbon\Carbon;
@endphp
<x-layout.app :title="'Dashboard - Profil Siswa'">
    @push('styles')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            font-size: 24px;
            font-weight: 700;
        }

        .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 8px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 40px;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            animation: slideDown 0.3s ease-out;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border-left: 4px solid #17a2b8;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .profile-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 50px 40px;
            text-align: center;
            color: white;
        }

        .profile-picture-wrapper {
            width: 150px;
            height: 150px;
            margin: 0 auto 20px;
            border-radius: 50%;
            overflow: hidden;
            border: 5px solid white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .profile-picture {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-header h2 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .profile-header .nisn {
            font-size: 16px;
            opacity: 0.9;
        }

        .profile-body {
            padding: 50px;
        }

        .profile-section {
            margin-bottom: 30px;
        }

        .profile-section h3 {
            color: #333;
            font-size: 18px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .profile-item {
            display: flex;
            flex-direction: column;
        }

        .profile-item label {
            font-size: 13px;
            color: #666;
            margin-bottom: 5px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .profile-item .value {
            font-size: 16px;
            color: #333;
            padding: 10px 0;
        }

        .profile-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid #f0f0f0;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 20px;
            }

            .navbar-content {
                flex-direction: column;
                gap: 15px;
            }

            .profile-header {
                padding: 30px 20px;
            }

            .profile-body {
                padding: 30px 20px;
            }

            .profile-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
    @endpush

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-content">
            <h1>Dashboard Siswa</h1>
            <div class="user-info">
                <span>{{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
        @endif

        <div class="profile-card">
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="profile-picture-wrapper">
                    @if($student->profile_picture)
                    <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="Profile Picture"
                        class="profile-picture">
                    @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($student->name) }}&size=150&background=random"
                        alt="Profile Picture" class="profile-picture">
                    @endif
                </div>
                <h2>{{ $student->name }}</h2>
                <p class="nisn">NISN: {{ $student->nisn }}</p>
            </div>

            <!-- Profile Body -->
            <div class="profile-body">
                <div class="profile-section">
                    <h3>Informasi Pribadi</h3>
                    <div class="profile-grid">
                        <div class="profile-item">
                            <label>Nama Lengkap</label>
                            <div class="value">{{ $student->name }}</div>
                        </div>
                        <div class="profile-item">
                            <label>NISN</label>
                            <div class="value">{{ $student->nisn }}</div>
                        </div>
                        <div class="profile-item">
                            <label>Jenis Kelamin</label>
                            <div class="value">{{ ucfirst($student->gender) }}</div>
                        </div>
                        <div class="profile-item">
                            <label>Tanggal Lahir</label>
                            <div class="value">{{ Carbon::parse($student->date_of_birth)->format('d F Y') }}</div>
                        </div>
                        <div class="profile-item">
                            <label>Email</label>
                            <div class="value">{{ $student->email }}</div>
                        </div>
                        <div class="profile-item">
                            <label>Umur</label>
                            <div class="value">{{ Carbon::parse($student->date_of_birth)->age }} tahun</div>
                        </div>
                    </div>
                </div>

                <div class="profile-section">
                    <h3>Alamat</h3>
                    <div class="profile-item">
                        <div class="value">{{ $student->address }}</div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="profile-actions">
                    <a href="{{ route('student.edit', $student) }}" class="btn btn-primary">
                        ✏️ Edit Profil
                    </a>
                    <form action="{{ route('student.destroy', $student) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus profil ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">🗑️ Hapus Profil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>