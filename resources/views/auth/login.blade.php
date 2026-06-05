<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Raleway', sans-serif;
            background-image: url('back.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .login-wrapper {
            text-align: center;
            width: 100%;
            max-width: 420px;
            padding: 0 20px;
        }

        .login-title {
            color: #ffffff;
            font-size: 2rem;
            font-weight: 400;
            letter-spacing: 1px;
            margin-bottom: 10px;
            text-shadow: 0 1px 4px rgba(0,0,0,0.3);
        }

        .login-subtitle {
            color: rgba(255,255,255,0.85);
            font-size: 1.05rem;
            font-weight: 300;
            margin-bottom: 30px;
            letter-spacing: 0.5px;
        }

        /* Validation errors */
        .validation-errors {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,100,100,0.5);
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 16px;
            color: #fff;
            font-size: 0.85rem;
            text-align: left;
        }

        /* Session status */
        .session-status {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(100,200,100,0.5);
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 16px;
            color: #d4edda;
            font-size: 0.85rem;
        }

        /* Input fields */
        .input-group {
            position: relative;
            margin-bottom: 14px;
        }

        .input-group input {
            width: 100%;
            padding: 16px 20px;
            background: rgba(255,255,255,0.30);
            border: 1px solid rgba(255,255,255,0.50);
            border-radius: 50px;
            color: #1a1a1a;
            font-size: 0.95rem;
            font-family: 'Raleway', sans-serif;
            font-weight: 600;
            letter-spacing: 0.4px;
            outline: none;
            transition: background 0.25s, border-color 0.25s;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .input-group input::placeholder {
            color: rgba(50,50,50,0.70);
            font-weight: 400;
        }

        .input-group input:focus {
            background: rgba(255,255,255,0.42);
            border-color: rgba(255,255,255,0.75);
        }

        /* Password toggle */
        .input-group .toggle-password {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: rgba(30,30,30,0.60);
            background: none;
            border: none;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .input-group .toggle-password svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* Sign in button */
        .btn-signin {
            width: 100%;
            padding: 16px;
            background: #f4b89a;
            border: none;
            border-radius: 50px;
            color: #fff;
            font-size: 0.9rem;
            font-family: 'Raleway', sans-serif;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            margin-top: 6px;
            transition: background 0.25s, transform 0.15s;
        }

        .btn-signin:hover {
            background: #e8a484;
            transform: translateY(-1px);
        }

        /* Remember me + Forgot password row */
        .row-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 16px;
            padding: 0 4px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(255,255,255,0.85);
            font-size: 0.88rem;
            cursor: pointer;
        }

        .remember-label input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #f4b89a;
            cursor: pointer;
        }

        .forgot-link {
            color: rgba(255,255,255,0.85);
            font-size: 0.88rem;
            text-decoration: none;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: #ffffff;
        }

        /* Register link */
        .register-row {
            margin-top: 24px;
            color: #ffffff;
            font-size: 0.9rem;
            font-weight: 500;
            display: inline-block;
            padding: 8px 22px;
            border-radius: 50px;
            background: rgba(0,0,0,0.30);
            backdrop-filter: blur(6px);
            border: 1px solid rgba(255,255,255,0.18);
            text-shadow: 0 1px 6px rgba(0,0,0,0.7);
        }

        .register-row a {
            color: #f4b89a;
            text-decoration: none;
            font-weight: 700;
            margin-left: 6px;
            text-shadow: 0 1px 6px rgba(0,0,0,0.8);
            transition: color 0.2s;
        }

        .register-row a:hover {
            color: #ffd4b8;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-wrapper">

        <h1 class="login-title">Login</h1>
        <p class="login-subtitle">Have an account?</p>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="validation-errors">
                <ul style="list-style:none; padding:0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Session Status --}}
        @session('status')
            <div class="session-status">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Username / Email --}}
            <div class="input-group">
                <input
                    id="email"
                    type="email"
                    name="email"
                    placeholder="Username"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                />
            </div>

            {{-- Password --}}
            <div class="input-group">
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Password"
                    required
                    autocomplete="current-password"
                />
                <button type="button" class="toggle-password" onclick="togglePassword()">
                    <svg id="eye-icon" viewBox="0 0 24 24">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </button>
            </div>

            {{-- Sign In --}}
            <button type="submit" class="btn-signin">Sign In</button>

            {{-- Remember Me + Forgot Password --}}
            <div class="row-options">
                <label class="remember-label">
                    <input type="checkbox" name="remember" id="remember_me" {{ old('remember') ? 'checked' : '' }}>
                    Remember Me
                </label>

                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">
                        Forgot Password
                    </a>
                @endif
            </div>
        </form>



        {{-- Register Link --}}
        @if (Route::has('register'))
            <div class="register-row">
                Pas encore de compte ?
                <a href="{{ route('register') }}">S'inscrire</a>
            </div>
        @endif

    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `
                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                    <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                    <line x1="1" y1="1" x2="23" y2="23"/>
                `;
            } else {
                input.type = 'password';
                icon.innerHTML = `
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
                `;
            }
        }
    </script>

</body>
</html>