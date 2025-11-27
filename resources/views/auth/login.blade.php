<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Kependudukan Raka</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 15px 30px rgba(0,0,0,.15);
            animation: fadeIn .5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h1 {
            font-size: 26px;
            color: #333;
        }

        .login-header p {
            color: #666;
            font-size: 14px;
        }

        .alert {
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-danger { background: #f8d7da; color: #721c24; }
        .alert-success { background: #d4edda; color: #155724; }

        label {
            font-size: 14px;
            color: #333;
            margin-bottom: 6px;
            display: block;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 7px;
            font-size: 14px;
            transition: .3s;
        }

        input:focus {
            border-color: #667eea;
            box-shadow: 0 0 6px rgba(102,126,234,.4);
            outline: none;
        }

        .form-error {
            font-size: 13px;
            color: #e74c3c;
            margin-top: 5px;
        }

        .btn-login {
            width: 100%;
            margin-top: 10px;
            padding: 12px;
            border: none;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            font-size: 15px;
            border-radius: 7px;
            cursor: pointer;
            font-weight: 600;
            transition: .25s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(118,75,162,.3);
        }

        .login-footer {
            text-align: center;
            margin-top: 18px;
            font-size: 14px;
        }

        .login-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .login-footer a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .divider {
            margin: 18px 0;
            text-align: center;
            font-size: 13px;
            color: #888;
        }

    </style>
</head>

<body>

    <div class="login-container">

        <div class="login-header">
            <h1>🏠 Kependudukan Raka</h1>
            <p>Sistem Manajemen Data Penduduk</p>
        </div>

        {{-- Error Validation --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi Kesalahan:</strong>
                <ul style="margin-top: 5px; margin-left: 18px;">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Flash Success --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Flash Error --}}
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        {{-- Login Form --}}
        <form method="POST" action="{{ route('auth.login') }}">
            @csrf

            <div class="form-group">
                <label for="email">📧 Email</label>
                <input type="email" name="email" id="email"
                       value="{{ old('email') }}"
                       placeholder="Masukkan email Anda" required>
                @error('email') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password">🔐 Password</label>
                <input type="password" name="password" id="password"
                       placeholder="Masukkan password Anda" required>
                {{-- password TIDAK BOLEH punya value --}}
                @error('password') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn-login">🔓 Masuk</button>
        </form>

        <div class="divider">Belum punya akun?</div>

        <div class="login-footer">
            <a href="{{ route('auth.register') }}">👤 Daftar Sekarang</a>
        </div>

    </div>

</body>
</html>
