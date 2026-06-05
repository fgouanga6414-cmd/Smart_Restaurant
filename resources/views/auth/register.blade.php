<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background-image: url('{{ asset("back.jpg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .register-container {
            width: 100%;
            max-width: 480px;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #fff;
            font-size: 2.2rem;
            font-weight: 300;
            letter-spacing: 2px;
            margin-bottom: 6px;
            text-shadow: 0 1px 6px rgba(0,0,0,0.3);
        }

        .subtitle {
            color: #fff;
            font-size: 0.95rem;
            font-weight: 300;
            margin-bottom: 28px;
            text-shadow: 0 1px 4px rgba(0,0,0,0.3);
        }

        .input-field {
            width: 100%;
            padding: 16px 22px;
            margin-bottom: 14px;
            border: none;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            font-size: 0.95rem;
            color: #333;
            outline: none;
            transition: background 0.2s;
        }

        .input-field::placeholder {
            color: #666;
        }

        .input-field:focus {
            background: rgba(255, 255, 255, 0.75);
        }

        .password-wrapper {
            position: relative;
            margin-bottom: 14px;
        }

        .password-wrapper .input-field {
            margin-bottom: 0;
            padding-right: 52px;
        }

        .toggle-password {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #888;
            font-size: 1.1rem;
            padding: 0;
        }

        .btn-signin {
            width: 100%;
            padding: 16px;
            margin-top: 4px;
            border: none;
            border-radius: 50px;
            background: rgba(210, 160, 130, 0.75);
            backdrop-filter: blur(6px);
            color: #fff;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-signin:hover {
            background: rgba(210, 150, 115, 0.9);
        }

        .bottom-links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 16px;
            padding: 0 4px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #fff;
            font-size: 0.85rem;
            text-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }

        .remember-me input[type="checkbox"] {
            width: 14px;
            height: 14px;
            accent-color: #d09070;
        }

        .terms-link {
            color: #fff;
            font-size: 0.85rem;
            text-decoration: none;
            text-shadow: 0 1px 3px rgba(0,0,0,0.3);
            transition: opacity 0.2s;
        }

        .terms-link:hover {
            opacity: 0.8;
        }

        .divider {
            display: flex;
            align-items: center;
            color: #fff;
            font-size: 0.85rem;
            margin: 20px 0 16px;
            text-shadow: 0 1px 3px rgba(0,0,0,0.3);
            gap: 12px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,0.45);
        }

        .social-buttons {
            display: flex;
            gap: 14px;
        }

        .btn-social {
            flex: 1;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(8px);
            color: #333;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-social:hover {
            background: rgba(255, 255, 255, 0.75);
        }

        .login-link {
            margin-top: 22px;
            color: #fff;
            font-size: 0.85rem;
            text-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }

        .login-link a {
            color: #fff;
            font-weight: 600;
            text-decoration: underline;
        }

        .error-messages {
            background: rgba(220, 80, 80, 0.3);
            backdrop-filter: blur(6px);
            border-radius: 12px;
            padding: 12px 18px;
            margin-bottom: 16px;
            text-align: left;
        }

        .error-messages p {
            color: #fff;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

    <div class="register-container">

        <h1>Register</h1>
        <p class="subtitle">Create your account</p>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="error-messages">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Name --}}
            <input
                id="name"
                class="input-field"
                type="text"
                name="name"
                value="{{ old('name') }}"
                placeholder="Full Name"
                required
                autofocus
                autocomplete="name"
            />

            {{-- Email --}}
            <input
                id="email"
                class="input-field"
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Email address"
                required
                autocomplete="username"
            />

            {{-- Password --}}
            <div class="password-wrapper">
                <input
                    id="password"
                    class="input-field"
                    type="password"
                    name="password"
                    placeholder="Password"
                    required
                    autocomplete="new-password"
                />
                <button type="button" class="toggle-password" onclick="togglePassword('password', this)">
                    👁
                </button>
            </div>

            {{-- Confirm Password --}}
            <div class="password-wrapper">
                <input
                    id="password_confirmation"
                    class="input-field"
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm Password"
                    required
                    autocomplete="new-password"
                />
                <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation', this)">
                    👁
                </button>
            </div>

            {{-- Terms --}}
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="bottom-links">
                    <label class="remember-me">
                        <input type="checkbox" name="terms" id="terms" required />
                        I agree to the
                        <a href="{{ route('terms.show') }}" target="_blank" class="terms-link" style="text-decoration:underline;">Terms</a>
                        &amp;
                        <a href="{{ route('policy.show') }}" target="_blank" class="terms-link" style="text-decoration:underline;">Privacy</a>
                    </label>
                </div>
            @endif

            <button type="submit" class="btn-signin">Create Account</button>

        </form>

        {{-- Login link --}}
        <p class="login-link">
            Already have an account? <a href="{{ route('login') }}">Sign In</a>
        </p>

    </div>

    <script>
        function togglePassword(fieldId, btn) {
            const field = document.getElementById(fieldId);
            if (field.type === 'password') {
                field.type = 'text';
                btn.style.opacity = '1';
            } else {
                field.type = 'password';
                btn.style.opacity = '0.5';
            }
        }
    </script>

</body>
</html>
