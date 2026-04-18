<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — {{ config('app.name', 'FilmApp') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Outfit', sans-serif;
            background: #0a0a0a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .card {
            display: flex;
            width: 100%;
            max-width: 860px;
            min-height: 520px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 40px 100px rgba(0,0,0,0.7), 0 0 0 1px rgba(255,255,255,0.05);
        }

        /* ===== LEFT PANEL ===== */
        .left-panel {
            position: relative;
            width: 42%;
            background: linear-gradient(160deg, #1a0a0b 0%, #2d0b0e 40%, #1a0a0b 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2.5rem;
            text-align: center;
            overflow: hidden;
        }

        /* Decorative red glow */
        .left-panel::before {
            content: '';
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(229,9,20,0.25) 0%, transparent 70%);
            pointer-events: none;
        }

        /* Curved white shape on the right edge */
        .left-panel::after {
            content: '';
            position: absolute;
            top: -10%;
            right: -60px;
            width: 200px;
            height: 120%;
            background: #111;
            border-radius: 50%;
        }

        .left-logo {
            position: relative;
            z-index: 1;
            font-size: 1.6rem;
            font-weight: 700;
            color: #e50914;
            letter-spacing: -1px;
            margin-bottom: 2.5rem;
        }

        .left-logo span { color: #fff; }

        .left-panel h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.6rem;
            position: relative;
            z-index: 1;
        }

        .left-panel p {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.45);
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
        }

        .btn-register {
            position: relative;
            z-index: 1;
            background: transparent;
            border: 1.5px solid rgba(229,9,20,0.6);
            color: #ff6b6b;
            padding: 0.65rem 2rem;
            border-radius: 30px;
            font-size: 0.88rem;
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
            cursor: pointer;
            transition: all 0.25s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-register:hover {
            background: rgba(229,9,20,0.15);
            border-color: #e50914;
            color: #fff;
            box-shadow: 0 0 20px rgba(229,9,20,0.2);
        }

        /* ===== RIGHT PANEL ===== */
        .right-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem 3.5rem;
            background: #111;
        }

        .right-panel h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.4rem;
            text-align: center;
        }

        .right-panel .subtitle {
            text-align: center;
            font-size: 0.82rem;
            color: rgba(255,255,255,0.3);
            margin-bottom: 2rem;
        }

        /* Alerts */
        .alert {
            padding: 0.75rem 1rem;
            border-radius: 10px;
            margin-bottom: 1.2rem;
            font-size: 0.85rem;
        }
        .alert-danger {
            background: rgba(229,9,20,0.12);
            color: #ff6b6b;
            border: 1px solid rgba(229,9,20,0.3);
        }

        /* Input group */
        .input-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .input-group input {
            width: 100%;
            padding: 0.85rem 3rem 0.85rem 1.1rem;
            background: #1a1a1a;
            border: 1.5px solid #2a2a2a;
            border-radius: 10px;
            font-size: 0.9rem;
            font-family: 'Outfit', sans-serif;
            color: #fff;
            outline: none;
            transition: border-color 0.2s, background 0.2s;
        }

        .input-group input::placeholder { color: #555; }

        .input-group input:focus {
            border-color: rgba(229,9,20,0.5);
            background: #1f1010;
            box-shadow: 0 0 0 3px rgba(229,9,20,0.08);
        }

        .input-group .input-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #444;
            pointer-events: none;
            transition: color 0.2s;
        }

        .input-group:focus-within .input-icon { color: #e50914; }

        .forgot {
            font-size: 0.82rem;
            color: rgba(255,255,255,0.3);
            margin-bottom: 1.5rem;
            display: inline-block;
            cursor: pointer;
            transition: color 0.2s;
        }
        .forgot:hover { color: #e50914; }

        .btn-login {
            width: 100%;
            padding: 0.9rem;
            background: linear-gradient(135deg, #e50914, #c8000f);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 700;
            font-family: 'Outfit', sans-serif;
            cursor: pointer;
            transition: all 0.25s;
            margin-bottom: 1.5rem;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 20px rgba(229,9,20,0.35);
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #ff1f2c, #e50914);
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(229,9,20,0.5);
        }

        .btn-login:active { transform: translateY(0); }

        .social-label {
            text-align: center;
            font-size: 0.78rem;
            color: rgba(255,255,255,0.25);
            margin-bottom: 1rem;
            position: relative;
        }

        .social-label::before,
        .social-label::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 28%;
            height: 1px;
            background: rgba(255,255,255,0.08);
        }
        .social-label::before { left: 0; }
        .social-label::after  { right: 0; }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 0.8rem;
        }

        .social-btn {
            width: 40px;
            height: 40px;
            border: 1.5px solid #2a2a2a;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            background: #1a1a1a;
            font-size: 0.85rem;
            font-weight: 700;
            color: #666;
            text-decoration: none;
        }

        .social-btn:hover {
            border-color: rgba(229,9,20,0.4);
            background: rgba(229,9,20,0.08);
            color: #ff6b6b;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .left-panel { display: none; }
            .right-panel { padding: 2.5rem 2rem; }
        }
    </style>
</head>
<body>

<div class="card">

    {{-- LEFT PANEL --}}
    <div class="left-panel">
        <div class="left-logo">FILM<span>APP</span></div>
        <h2>Hello, Welcome!</h2>
        <p>Don't have an account?</p>
        <a href="{{ route('register') }}" class="btn-register">Registration</a>
    </div>

    {{-- RIGHT PANEL --}}
    <div class="right-panel">
        <h1>Login</h1>
        <p class="subtitle">Masuk untuk melanjutkan menonton</p>

        {{-- Admin hint --}}
        <div style="background:rgba(229,9,20,0.08);border:1px solid rgba(229,9,20,0.2);border-radius:10px;padding:.7rem 1rem;margin-bottom:1.5rem;font-size:.8rem;color:rgba(255,255,255,.5);text-align:center;">
            🔐 Admin: <span style="color:#ff6b6b;font-weight:600;">admin@filmapp.com</span> / <span style="color:#ff6b6b;font-weight:600;">admin123</span>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="input-group">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                <span class="input-icon">
                    <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                    </svg>
                </span>
            </div>

            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
                <span class="input-icon">
                    <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </span>
            </div>

            <span class="forgot">Forgot Password?</span>

            <button type="submit" class="btn-login">Login</button>
        </form>

        <p class="social-label">Or login with social platforms</p>
        <div class="social-icons">
            <a href="#" class="social-btn">f</a>
            <a href="#" class="social-btn">G</a>
            <a href="#" class="social-btn">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.69a8.18 8.18 0 0 0 4.78 1.52V6.76a4.85 4.85 0 0 1-1.01-.07z"/>
                </svg>
            </a>
        </div>
    </div>

</div>

</body>
</html>
