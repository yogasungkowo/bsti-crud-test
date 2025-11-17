<x-layout.app :title="'Edit Profil Siswa'">
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

        .btn-back {
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

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 0 40px;
        }

        .form-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
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

        .form-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .form-header h2 {
            color: #333;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group label .required {
            color: #f44;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper input,
        .input-wrapper select,
        .input-wrapper textarea {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .input-wrapper textarea {
            min-height: 100px;
            resize: vertical;
        }

        .input-wrapper input:focus,
        .input-wrapper select:focus,
        .input-wrapper textarea:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .input-wrapper input.error,
        .input-wrapper select.error,
        .input-wrapper textarea.error {
            border-color: #f44;
        }

        .input-error {
            color: #f44;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .profile-picture-preview {
            text-align: center;
            margin-bottom: 25px;
        }

        .preview-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #667eea;
            margin-bottom: 15px;
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
            background: #f0f0f0;
            border: 2px dashed #ccc;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-input-label:hover {
            background: #e0e0e0;
            border-color: #667eea;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 14px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #f44;
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 20px;
            }

            .form-card {
                padding: 30px 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }
        }
    </style>
    @endpush

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-content">
            <h1>Edit Profil Siswa</h1>
            <a href="{{ route('student.index') }}" class="btn-back">← Kembali</a>
        </div>
    </nav>

    <div class="container">
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

        <div class="form-card">
            <div class="form-header">
                <h2>Edit Profil</h2>
                <p>Perbarui informasi profil Anda</p>
            </div>

            <form action="{{ route('student.update', $student) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Profile Picture Preview -->
                <div class="profile-picture-preview">
                    @if($student->profile_picture)
                        <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="Profile" class="preview-image" id="imagePreview">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($student->name) }}&size=150&background=random" alt="Profile" class="preview-image" id="imagePreview">
                    @endif
                    
                    <div class="file-input-wrapper">
                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewImage(event)">
                        <label for="profile_picture" class="file-input-label">
                            📷 Ubah Foto Profil
                        </label>
                    </div>
                    <div style="margin-top: 10px; font-size: 12px; color: #666;">
                        Format: JPG, PNG, GIF (Max: 2MB)
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Nama Lengkap <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', $student->name) }}"
                                class="{{ $errors->has('name') ? 'error' : '' }}"
                                required
                            >
                        </div>
                        @error('name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nisn">NISN <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <input 
                                type="text" 
                                id="nisn" 
                                name="nisn" 
                                value="{{ old('nisn', $student->nisn) }}"
                                class="{{ $errors->has('nisn') ? 'error' : '' }}"
                                required
                            >
                        </div>
                        @error('nisn')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="gender">Jenis Kelamin <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <select 
                                id="gender" 
                                name="gender" 
                                class="{{ $errors->has('gender') ? 'error' : '' }}"
                                required
                            >
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="laki-laki" {{ old('gender', $student->gender) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="perempuan" {{ old('gender', $student->gender) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        @error('gender')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date_of_birth">Tanggal Lahir <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <input 
                                type="date" 
                                id="date_of_birth" 
                                name="date_of_birth" 
                                value="{{ old('date_of_birth', $student->date_of_birth) }}"
                                class="{{ $errors->has('date_of_birth') ? 'error' : '' }}"
                                required
                            >
                        </div>
                        @error('date_of_birth')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email', $student->email) }}"
                            class="{{ $errors->has('email') ? 'error' : '' }}"
                            required
                        >
                    </div>
                    @error('email')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Alamat <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <textarea 
                            id="address" 
                            name="address" 
                            class="{{ $errors->has('address') ? 'error' : '' }}"
                            required
                        >{{ old('address', $student->address) }}</textarea>
                    </div>
                    @error('address')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('student.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('imagePreview');
                preview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    @endpush
</x-layout.app>
