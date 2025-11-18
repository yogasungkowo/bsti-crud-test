<x-layout.app :title="'Tambah Siswa Baru'">
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

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-links {
            display: flex;
            gap: 20px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-links a:hover,
        .nav-links a.active {
            background: rgba(255, 255, 255, 0.2);
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 8px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 0 40px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
        }

        .page-header p {
            color: #666;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 40px;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 20px;
            color: #333;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group label .required {
            color: #dc3545;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-group .error {
            border-color: #dc3545;
        }

        .error-message {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-danger {
            background: #fee;
            color: #c33;
            border-left: 4px solid #dc3545;
        }

        .profile-picture-upload {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .preview-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #e0e0e0;
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
        }

        .file-input-wrapper input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-input-label {
            display: inline-block;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-input-label:hover {
            background: #5568d3;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #f0f0f0;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
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

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 20px;
            }

            .card {
                padding: 30px 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .navbar-content {
                flex-direction: column;
                gap: 15px;
            }

            .nav-links {
                flex-direction: column;
                width: 100%;
            }

            .nav-links a {
                text-align: center;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
    @endpush

    <nav class="navbar">
        <div class="navbar-content">
            <h1>➕ Tambah Siswa Baru</h1>
            <div class="navbar-right">
                <div class="nav-links">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <a href="{{ route('admin.users') }}">Kelola User</a>
                    <a href="{{ route('admin.students') }}" class="active">Daftar Siswa</a>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <a href="{{ route('admin.students') }}" class="btn-back">
            ← Kembali ke Daftar Siswa
        </a>

        <div class="page-header">
            <h2>Tambah Siswa Baru</h2>
            <p>Isi form di bawah untuk menambahkan siswa baru beserta akun usernya</p>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul style="margin-left: 20px; margin-top: 8px;">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- User Account Section -->
            <div class="card">
                <div class="section-title">
                    🔐 Informasi Akun User
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="user_name">Nama Lengkap User <span class="required">*</span></label>
                        <input type="text" id="user_name" name="user_name" value="{{ old('user_name') }}"
                            placeholder="Nama untuk login" class="{{ $errors->has('user_name') ? 'error' : '' }}"
                            required>
                        @error('user_name')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="user_email">Email User <span class="required">*</span></label>
                        <input type="email" id="user_email" name="user_email" value="{{ old('user_email') }}"
                            placeholder="email@example.com" class="{{ $errors->has('user_email') ? 'error' : '' }}"
                            required>
                        @error('user_email')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="user_password">Password <span class="required">*</span></label>
                        <x-password-input id="user_password" name="user_password" placeholder="Minimal 8 karakter"
                            :error="$errors->has('user_password')" required />
                        @error('user_password')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="user_password_confirmation">Konfirmasi Password <span
                                class="required">*</span></label>
                        <x-password-input id="user_password_confirmation" name="user_password_confirmation"
                            placeholder="Ulangi password" required />
                    </div>
                </div>
            </div>

            <!-- Student Profile Section -->
            <div class="card">
                <div class="section-title">
                    👤 Informasi Profil Siswa
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="nisn">NISN <span class="required">*</span></label>
                        <input type="text" id="nisn" name="nisn" value="{{ old('nisn') }}"
                            placeholder="Nomor Induk Siswa Nasional" class="{{ $errors->has('nisn') ? 'error' : '' }}"
                            required>
                        @error('nisn')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="gender">Jenis Kelamin <span class="required">*</span></label>
                        <select id="gender" name="gender" class="{{ $errors->has('gender') ? 'error' : '' }}" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="laki-laki" {{ old('gender') == 'laki-laki' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="perempuan" {{ old('gender') == 'perempuan' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>
                        @error('gender')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group full-width">
                        <label for="date_of_birth">Tanggal Lahir <span class="required">*</span></label>
                        <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}"
                            class="{{ $errors->has('date_of_birth') ? 'error' : '' }}" required>
                        @error('date_of_birth')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group full-width">
                        <label for="address">Alamat Lengkap <span class="required">*</span></label>
                        <textarea id="address" name="address" placeholder="Alamat lengkap siswa"
                            class="{{ $errors->has('address') ? 'error' : '' }}" required>{{ old('address') }}</textarea>
                        @error('address')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Profile Picture Upload -->
                <div class="form-group full-width">
                    <label>Foto Profil (Opsional)</label>
                    <div class="profile-picture-upload">
                        <img src="https://ui-avatars.com/api/?name=Student&size=150&background=667eea&color=fff"
                            alt="Preview" class="preview-image" id="imagePreview">

                        <div class="file-input-wrapper">
                            <input type="file" id="profile_picture" name="profile_picture" accept="image/*"
                                onchange="previewImage(event)">
                            <label for="profile_picture" class="file-input-label">
                                📷 Pilih Foto Profil
                            </label>
                        </div>
                        <small style="color: #666;">Format: JPG, PNG, GIF (Max: 2MB)</small>
                        @error('profile_picture')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('admin.students') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">💾 Simpan Data Siswa</button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
    @endpush
</x-layout.app>
