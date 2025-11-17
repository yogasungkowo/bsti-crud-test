<x-layout.appLogin :title="'Register Page'">
    @push('styles')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 50px 40px;
            width: 100%;
            max-width: 480px;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .register-header h1 {
            color: #333;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .register-header p {
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 22px;
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

        .input-wrapper input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .input-wrapper input:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .input-wrapper input::placeholder {
            color: #aaa;
        }

        .input-wrapper input.error {
            border-color: #f44;
        }

        .input-error {
            color: #f44;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        .btn-register {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .error-message {
            background: #fee;
            border-left: 4px solid #f44;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            color: #c33;
            font-size: 14px;
        }

        .success-message {
            background: #efe;
            border-left: 4px solid #4a4;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            color: #363;
            font-size: 14px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .password-strength {
            margin-top: 8px;
        }

        .strength-bar {
            height: 4px;
            background: #e0e0e0;
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .strength-bar-fill {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
        }

        .strength-bar-fill.weak {
            width: 33%;
            background: #f44;
        }

        .strength-bar-fill.medium {
            width: 66%;
            background: #fa0;
        }

        .strength-bar-fill.strong {
            width: 100%;
            background: #4a4;
        }

        .strength-text {
            font-size: 12px;
            color: #666;
        }

        .checkbox-group {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .checkbox-group input[type="checkbox"] {
            margin-right: 10px;
            margin-top: 3px;
            cursor: pointer;
        }

        .checkbox-group label {
            font-size: 14px;
            color: #666;
            cursor: pointer;
            margin-bottom: 0;
            font-weight: 400;
        }

        .checkbox-group label a {
            color: #667eea;
            text-decoration: none;
        }

        .checkbox-group label a:hover {
            text-decoration: underline;
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e0e0e0;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            color: #999;
            font-size: 14px;
            position: relative;
            z-index: 1;
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            color: #666;
            font-size: 14px;
        }

        .login-link a {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #764ba2;
        }

        @media (max-width: 580px) {
            .register-container {
                padding: 40px 30px;
            }

            .register-header h1 {
                font-size: 28px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
    @endpush

    <div class="register-container">
        <div class="register-header">
            <h1>Buat Akun Baru</h1>
            <p>Daftar untuk memulai perjalanan Anda</p>
        </div>

        @if ($errors->any())
        <div class="error-message">
            <strong>Terjadi kesalahan:</strong>
            <ul style="margin-left: 20px; margin-top: 8px;">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="first_name">Nama Depan <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <input type="text" id="first_name" name="first_name" placeholder="John"
                            value="{{ old('first_name') }}" class="{{ $errors->has('first_name') ? 'error' : '' }}"
                            required autofocus>
                    </div>
                    @error('first_name')
                    <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="last_name">Nama Belakang <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <input type="text" id="last_name" name="last_name" placeholder="Doe"
                            value="{{ old('last_name') }}" class="{{ $errors->has('last_name') ? 'error' : '' }}"
                            required>
                    </div>
                    @error('last_name')
                    <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email <span class="required">*</span></label>
                <div class="input-wrapper">
                    <input type="email" id="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}"
                        class="{{ $errors->has('email') ? 'error' : '' }}" required>
                </div>
                @error('email')
                <span class="input-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password <span class="required">*</span></label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" placeholder="Minimal 8 karakter"
                        class="{{ $errors->has('password') ? 'error' : '' }}" required>
                </div>
                <div class="password-strength" id="passwordStrength" style="display: none;">
                    <div class="strength-bar">
                        <div class="strength-bar-fill" id="strengthBar"></div>
                    </div>
                    <div class="strength-text" id="strengthText"></div>
                </div>
                @error('password')
                <span class="input-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password <span class="required">*</span></label>
                <div class="input-wrapper">
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Masukkan ulang password" required>
                </div>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">
                    Saya setuju dengan <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a>
                </label>
            </div>

            <button type="submit" class="btn-register">Daftar Sekarang</button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </div>
    </div>

    @push('scripts')
    <script>
        // Password strength checker menggunakan Validator.js
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('strengthText');
        const passwordStrength = document.getElementById('passwordStrength');

        passwordInput.addEventListener('input', function() {
            const password = this.value;
            
            if (password.length === 0) {
                passwordStrength.style.display = 'none';
                return;
            }

            passwordStrength.style.display = 'block';
            
            // Remove previous classes first
            strengthBar.classList.remove('weak', 'medium', 'strong');
            
            // Using Validator.js to check password strength
            const isStrongPassword = validator.isStrongPassword(password, {
                minLength: 8,
                minLowercase: 1,
                minUppercase: 1,
                minNumbers: 1,
                minSymbols: 1
            });

            const isMediumPassword = validator.isStrongPassword(password, {
                minLength: 8,
                minLowercase: 1,
                minUppercase: 0,
                minNumbers: 1,
                minSymbols: 0
            });
            
            if (isStrongPassword) {
                strengthBar.classList.add('strong');
                strengthText.textContent = 'Password kuat - Sangat aman!';
                strengthText.style.color = '#4a4';
            } else if (isMediumPassword) {
                strengthBar.classList.add('medium');
                strengthText.textContent = 'Password sedang - Tambahkan huruf besar dan simbol';
                strengthText.style.color = '#fa0';
            } else {
                strengthBar.classList.add('weak');
                if (password.length < 8) {
                    strengthText.textContent = 'Password lemah - Minimal 8 karakter';
                } else {
                    strengthText.textContent = 'Password lemah - Tambahkan huruf, angka, dan simbol';
                }
                strengthText.style.color = '#f44';
            }
        });

        // Form validation using Validator.js
        const form = document.getElementById('registerForm');
        form.addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const passwordConfirm = document.getElementById('password_confirmation').value;
            const firstName = document.getElementById('first_name').value;
            const lastName = document.getElementById('last_name').value;

            // Email validation using Validator.js
            if (!validator.isEmail(email)) {
                e.preventDefault();
                alert('Format email tidak valid!');
                return false;
            }

            // Name validation - cannot be empty and cannot contain numbers
            if (validator.isEmpty(firstName.trim()) || validator.isEmpty(lastName.trim())) {
                e.preventDefault();
                alert('Nama depan dan nama belakang harus diisi!');
                return false;
            }

            if (!validator.isAlpha(firstName.replace(/\s/g, ''), 'en-US', {ignore: ' '}) || 
                !validator.isAlpha(lastName.replace(/\s/g, ''), 'en-US', {ignore: ' '})) {
                e.preventDefault();
                alert('Nama hanya boleh mengandung huruf!');
                return false;
            }

            // Password length validation
            if (!validator.isLength(password, { min: 8 })) {
                e.preventDefault();
                alert('Password minimal 8 karakter!');
                return false;
            }

            // Password match validation
            if (!validator.equals(password, passwordConfirm)) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak sama!');
                return false;
            }

            return true;
        });
    </script>
    @endpush
</x-layout.appLogin>