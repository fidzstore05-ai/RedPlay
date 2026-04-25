<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Film Streaming') }}</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #e50914;
            --secondary: #1f1f1f;
            --dark: #121212;
            --light: #ffffff;
            --gray: #8c8c8c;
            --accent: #ff4d4d;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--dark);
            color: var(--light);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: 0.3s;
        }

        /* ===== NAVBAR ===== */
        header {
            background: rgba(10,10,10,0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding: 0 5%;
            height: 62px;
            display: flex;
            align-items: center;
            gap: 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: -1px;
            flex-shrink: 0;
        }

        .logo span { color: white; }

        /* Nav links */
        nav { display: flex; align-items: center; }

        nav ul {
            list-style: none;
            display: flex;
            gap: 0.2rem;
            margin: 0;
            padding: 0;
        }

        nav ul li a {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.4rem 0.85rem;
            border-radius: 8px;
            font-size: 0.88rem;
            font-weight: 500;
            color: rgba(255,255,255,0.6);
            transition: all 0.2s;
            white-space: nowrap;
        }

        nav ul li a:hover,
        nav ul li a.active {
            color: #fff;
            background: rgba(255,255,255,0.07);
        }

        nav ul li a.active { color: var(--primary); }

        /* Genre dropdown */
        .nav-dropdown { position: relative; }

        .nav-dropdown-menu {
            display: none;
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            background: #1a1a1a;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            padding: 0.5rem;
            min-width: 180px;
            box-shadow: 0 16px 40px rgba(0,0,0,0.6);
            z-index: 100;
        }

        .nav-dropdown:hover .nav-dropdown-menu { display: block; }

        .nav-dropdown-menu a {
            display: block;
            padding: 0.5rem 0.9rem;
            border-radius: 8px;
            font-size: 0.85rem;
            color: rgba(255,255,255,0.65);
            transition: all 0.15s;
        }

        .nav-dropdown-menu a:hover {
            background: rgba(229,9,20,0.12);
            color: #ff6b6b;
        }

        /* Navbar search */
        .nav-search {
            flex: 1;
            max-width: 260px;
            margin-left: auto;
            position: relative;
        }

        .nav-search form {
            display: flex;
            align-items: center;
        }

        .nav-search input {
            width: 100%;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            color: white;
            font-family: 'Outfit', sans-serif;
            font-size: 0.85rem;
            padding: 0.45rem 2.2rem 0.45rem 0.9rem;
            outline: none;
            transition: all 0.2s;
        }

        .nav-search input::placeholder { color: #555; }

        .nav-search input:focus {
            border-color: rgba(229,9,20,0.4);
            background: rgba(229,9,20,0.06);
        }

        .nav-search .search-submit {
            position: absolute;
            right: 0.6rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #555;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            transition: color 0.2s;
        }

        .nav-search input:focus ~ .search-submit,
        .nav-search .search-submit:hover { color: var(--primary); }

        /* Divider */
        .nav-divider {
            width: 1px;
            height: 22px;
            background: rgba(255,255,255,0.1);
            flex-shrink: 0;
        }

        /* Auth buttons */
        .nav-auth {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            flex-shrink: 0;
        }

        .nav-user {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .nav-user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e50914, #ff6b6b);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.78rem;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        .nav-user-name {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.75);
            max-width: 100px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .btn {
            padding: 0.45rem 1.1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
            display: inline-block;
            font-family: 'Outfit', sans-serif;
        }

        .btn-primary {
            background: linear-gradient(135deg, #e50914, #c8000f);
            color: white;
            box-shadow: 0 2px 10px rgba(229,9,20,0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #ff1f2c, #e50914);
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(229,9,20,0.45);
            color: white;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.75);
        }

        .btn-outline:hover {
            border-color: rgba(255,255,255,0.5);
            color: white;
            background: rgba(255,255,255,0.05);
        }

        main {
            padding: 2rem 5%;
            min-height: 80vh;
        }

        footer {
            background-color: var(--secondary);
            padding: 2rem 5%;
            text-align: center;
            color: var(--gray);
            font-size: 0.9rem;
            margin-top: 4rem;
        }

        /* Form Styles */
        .auth-card {
            background-color: var(--secondary);
            padding: 2.5rem;
            border-radius: 16px;
            max-width: 400px;
            margin: 4rem auto;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            color: var(--gray);
        }

        .form-control {
            width: 100%;
            padding: 0.8rem;
            background-color: var(--dark);
            border: 1px solid #333;
            color: white;
            border-radius: 8px;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: var(--primary);
            outline: none;
        }

        /* Notifications */
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .alert-success { background-color: #2ecc71; color: white; }
        .alert-danger { background-color: #e74c3c; color: white; }
    </style>
    @stack('styles')
</head>
<body>

    <header>
        {{-- Logo --}}
        <a href="{{ url('/') }}" class="logo">FILM<span>APP</span></a>

        {{-- Nav Links --}}
        <nav>
            <ul>
                <li>
                    <a href="{{ route('films.index') }}"
                       class="{{ request()->routeIs('films.index') && !request()->hasAny(['genre','rating','q']) ? 'active' : '' }}">
                        Home
                    </a>
                </li>

                {{-- Genre Dropdown --}}
                <li class="nav-dropdown">
                    <a href="#" class="{{ request('genre') ? 'active' : '' }}">
                        Genre
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                    </a>
                    <div class="nav-dropdown-menu">
                        @php $navGenres = \App\Models\Genre::orderBy('genre')->get(); @endphp
                        @foreach($navGenres as $g)
                            <a href="{{ route('films.index', ['genre' => $g->id_genre]) }}">{{ $g->genre }}</a>
                        @endforeach
                    </div>
                </li>

                <li>
                    <a href="{{ route('films.index', ['rating' => 8]) }}"
                       class="{{ request('rating') ? 'active' : '' }}">
                        Populer
                    </a>
                </li>

                {{-- Tahun Dropdown --}}
                <li class="nav-dropdown">
                    <a href="#">
                        Tahun
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                    </a>
                    <div class="nav-dropdown-menu">
                        @foreach(range(date('Y'), 2010, -1) as $yr)
                            <a href="{{ route('films.index', ['tahun' => $yr]) }}">{{ $yr }}</a>
                        @endforeach
                    </div>
                </li>

                @auth
                    @if(Auth::user()->role === 'admin')
                        <li><a href="{{ route('films.manage') }}">Manage</a></li>
                    @endif
                @endauth
            </ul>
        </nav>

        {{-- Search --}}
        <div class="nav-search">
            <form action="{{ route('films.index') }}" method="GET">
                <input type="text" name="q" placeholder="Search..." value="{{ request('q') }}">
                <button type="submit" class="search-submit">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                    </svg>
                </button>
            </form>
        </div>

        <div class="nav-divider"></div>

        {{-- Auth --}}
        <div class="nav-auth">
            @auth
                <div class="nav-user">
                    <div class="nav-user-avatar">{{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}</div>
                    <span class="nav-user-name">{{ Auth::user()->nama }}</span>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="btn btn-outline">Logout</button>
                </form>
            @else
                <a href="{{ route('register') }}" class="btn btn-outline">Register</a>
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            @endauth
        </div>
    </header>

    <main>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        <p>&copy; 2026 FilmApp Streaming. All rights reserved.</p>
    </footer>

    @stack('scripts')
</body>
</html>
