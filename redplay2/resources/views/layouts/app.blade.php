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

        html, body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--dark);
            color: var(--light);
            margin: 0;
            padding: 0;
            line-height: 1.6;
            overflow-x: hidden;
            width: 100%;
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
            cursor: pointer;
            gap: 0.8rem;
        }

        .nav-user:hover .nav-user-name {
            color: var(--primary) !important;
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
            overflow: hidden;
        }

        .nav-user-name {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.75);
            max-width: 100px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            transition: color 0.2s;
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

        /* ===== RESPONSIVE WEB DESIGN ===== */
        .mobile-search { display: none; }
        .nav-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            z-index: 998;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        .nav-backdrop.show {
            opacity: 1;
            pointer-events: auto;
        }

        .nav-icon-wrapper { display: none; }
        .mobile-user-profile { display: none; }
        .mobile-guest-auth { display: none; }

        @media (max-width: 900px) {
            header {
                padding: 0 4%;
                gap: 1rem;
                justify-content: space-between;
                background: rgba(10, 10, 10, 0.8) !important;
                backdrop-filter: blur(16px) !important;
                -webkit-backdrop-filter: blur(16px) !important;
                border-bottom: 1px solid rgba(255,255,255,0.08) !important;
            }
            .logo {
                font-size: 1.3rem;
            }
            .nav-search, .nav-divider {
                display: none;
            }
            .nav-toggle {
                display: block !important;
            }
            .nav-auth {
                display: none !important; /* Hide header auth entirely, moved to drawer footer */
            }
            .btn {
                padding: 0.4rem 0.8rem;
                font-size: 0.78rem;
            }
            
            /* Responsive Drawer Menu */
            nav {
                display: flex !important; /* Force display for transitions */
                position: fixed;
                top: 62px;
                right: 0;
                width: 320px;
                max-width: 85%;
                height: calc(100vh - 62px);
                background: rgba(15, 15, 15, 0.96);
                backdrop-filter: blur(24px);
                -webkit-backdrop-filter: blur(24px);
                flex-direction: column;
                align-items: stretch;
                padding: 2rem 1.5rem !important;
                z-index: 999;
                overflow-y: auto;
                border-left: 1px solid rgba(255,255,255,0.08);
                border-top: 1px solid rgba(255,255,255,0.05);
                transform: translateX(100%);
                visibility: hidden;
                transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            }
            nav.open {
                transform: translateX(0);
                visibility: visible;
            }
            nav ul {
                flex-direction: column;
                gap: 0.5rem;
                width: 100%;
                margin-bottom: 2rem;
            }
            nav ul li {
                width: 100%;
            }
            nav ul li a {
                font-size: 1rem;
                padding: 0.75rem 1rem;
                display: flex;
                align-items: center;
                justify-content: flex-start;
                width: 100%;
                box-sizing: border-box;
                border-radius: 8px;
            }

            .nav-icon-wrapper {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                color: rgba(255,255,255,0.4);
                margin-right: 0.8rem;
                transition: color 0.2s;
            }
            nav ul li a:hover .nav-icon-wrapper,
            nav ul li a.active .nav-icon-wrapper {
                color: #ff6b6b;
            }

            /* Disable hover menu on mobile */
            .nav-dropdown:hover .nav-dropdown-menu {
                display: none;
            }
            /* Show menu when clicked/toggled */
            .nav-dropdown.active-toggle .nav-dropdown-menu {
                display: block;
            }

            .nav-dropdown-menu {
                position: static;
                background: rgba(255,255,255,0.03);
                box-shadow: none;
                margin-top: 0.3rem;
                padding: 0.3rem;
                width: 100%;
                box-sizing: border-box;
                border-radius: 8px;
                border: 1px solid rgba(255,255,255,0.05);
            }
            
            .mobile-search {
                display: block;
                margin-bottom: 1.5rem;
                position: relative;
                width: 100%;
            }
            .mobile-search form {
                display: flex;
                align-items: center;
            }
            .mobile-search input {
                width: 100%;
                background: rgba(255,255,255,0.05);
                border: 1px solid rgba(255,255,255,0.08);
                border-radius: 9px;
                color: white;
                font-family: 'Outfit', sans-serif;
                font-size: 0.92rem;
                padding: 0.65rem 2.5rem 0.65rem 1rem;
                outline: none;
                box-sizing: border-box;
            }
            .mobile-search .search-submit {
                position: absolute;
                right: 0.8rem;
                top: 50%;
                transform: translateY(-50%);
                background: none;
                border: none;
                color: #8c8c8c;
                cursor: pointer;
            }

            /* Mobile User Profile inside drawer */
            .mobile-user-profile {
                display: flex;
                flex-direction: column;
                margin-bottom: 1.5rem;
                padding-bottom: 1.5rem;
                border-bottom: 1px solid rgba(255,255,255,0.06);
            }
            .m-user-info-link {
                display: block;
                text-decoration: none;
                padding: 0.6rem;
                margin: -0.6rem;
                border-radius: 12px;
                transition: all 0.2s ease;
            }
            .m-user-info-link:hover {
                background: rgba(255, 255, 255, 0.05);
            }
            .m-user-info-link:hover .m-user-edit-icon {
                color: #e50914;
                transform: translateX(2px);
            }
            .m-user-info {
                display: flex;
                align-items: center;
                gap: 0.8rem;
            }
            .m-user-avatar {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: linear-gradient(135deg, #e50914, #ff6b6b);
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 700;
                color: white;
                font-size: 1rem;
                overflow: hidden;
                box-shadow: 0 0 10px rgba(229,9,20,0.25);
                border: 2px solid rgba(255,255,255,0.1);
            }
            .m-user-avatar img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
            .m-user-text {
                display: flex;
                flex-direction: column;
            }
            .m-user-name {
                font-size: 0.9rem;
                font-weight: 600;
                color: white;
            }
            .m-user-role {
                font-size: 0.7rem;
                color: rgba(255,255,255,0.45);
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }
            .m-user-role.admin {
                color: #f5c518;
                font-weight: 600;
            }
            .m-user-edit-icon {
                margin-left: auto;
                color: rgba(255,255,255,0.25);
                display: flex;
                align-items: center;
                transition: all 0.2s ease;
            }

            /* Mobile Guest panel inside drawer */
            .mobile-guest-auth {
                display: flex;
                flex-direction: column;
                margin-bottom: 1.5rem;
                padding-bottom: 1.5rem;
                border-bottom: 1px solid rgba(255,255,255,0.06);
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    {{-- Navigation Backdrop --}}
    <div class="nav-backdrop" id="navBackdrop"></div>

    <header>
        {{-- Logo --}}
        <a href="{{ url('/') }}" class="logo">FILM<span>APP</span></a>

        {{-- Hamburger Menu Button --}}
        <button class="nav-toggle" id="navToggle" aria-label="Toggle Navigation" style="display: none; background: none; border: none; color: white; cursor: pointer; padding: 0.5rem; z-index: 1001; transition: transform 0.2s ease;">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M4 6h16M4 12h16M4 18h16" class="menu-open-icon"/>
            </svg>
        </button>

        {{-- Nav Links --}}
        <nav id="navMenu">
            {{-- Mobile User/Guest Panel (Visible inside drawer only) --}}
            @auth
                <div class="mobile-user-profile">
                    <a href="{{ route('profile.edit') }}" class="m-user-info-link" title="Edit Profil">
                        <div class="m-user-info">
                            <div class="m-user-avatar">
                                @if(Auth::user()->foto_profile)
                                    <img src="{{ asset(Auth::user()->foto_profile) }}" alt="Avatar">
                                @else
                                    {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                                @endif
                            </div>
                            <div class="m-user-text">
                                <span class="m-user-name">{{ Auth::user()->nama }}</span>
                                <span class="m-user-role {{ Auth::user()->role === 'admin' ? 'admin' : '' }}">
                                    {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Member' }}
                                </span>
                            </div>
                            <div class="m-user-edit-icon">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                    <path d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" style="width: 100%">
                        @csrf
                        <button type="submit" class="btn btn-outline" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-top: 1.2rem; border-color: rgba(255,255,255,0.15); color: rgba(255,255,255,0.7); padding: 0.6rem;">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/>
                            </svg>
                            Log Out
                        </button>
                    </form>
                </div>
            @else
                <div class="mobile-guest-auth">
                    <p style="font-size: 0.82rem; color: rgba(255,255,255,0.35); text-align: center; margin-bottom: 1.2rem;">Masuk untuk mulai menonton film favoritmu</p>
                    <div style="display: flex; gap: 0.6rem; width: 100%;">
                        <a href="{{ route('register') }}" class="btn btn-outline" style="flex: 1; text-align: center; padding: 0.6rem;">Register</a>
                        <a href="{{ route('login') }}" class="btn btn-primary" style="flex: 1; text-align: center; padding: 0.6rem;">Login</a>
                    </div>
                </div>
            @endauth

            {{-- Mobile Search --}}
            <div class="mobile-search">
                <form action="{{ route('films.index') }}" method="GET">
                    <input type="text" name="q" placeholder="Cari film, genre..." value="{{ request('q') }}">
                    <button type="submit" class="search-submit">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                        </svg>
                    </button>
                </form>
            </div>
            <ul>
                <li>
                    <a href="{{ route('films.index') }}"
                       class="{{ request()->routeIs('films.index') && !request()->hasAny(['genre','rating','q']) ? 'active' : '' }}">
                        <span class="nav-icon-wrapper">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                        </span>
                        Home
                    </a>
                </li>

                {{-- Genre Dropdown --}}
                <li class="nav-dropdown">
                    <a href="#" class="{{ request('genre') ? 'active' : '' }}">
                        <span class="nav-icon-wrapper">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                        </span>
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
                        <span class="nav-icon-wrapper">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        </span>
                        Populer
                    </a>
                </li>

                {{-- Tahun Dropdown --}}
                <li class="nav-dropdown">
                    <a href="#">
                        <span class="nav-icon-wrapper">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </span>
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
                        <li>
                            <a href="{{ route('films.manage') }}">
                                <span class="nav-icon-wrapper">
                                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                                </span>
                                Manage
                            </a>
                        </li>
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
                <a href="{{ route('profile.edit') }}" class="nav-user" title="Edit Profil">
                    <div class="nav-user-avatar">
                        @if(Auth::user()->foto_profile)
                            <img src="{{ asset(Auth::user()->foto_profile) }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                        @endif
                    </div>
                    <span class="nav-user-name">{{ Auth::user()->nama }}</span>
                </a>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('navToggle');
            const menu = document.getElementById('navMenu');
            const backdrop = document.getElementById('navBackdrop');

            function toggleMenu() {
                menu.classList.toggle('open');
                backdrop.classList.toggle('show');
                const isOpen = menu.classList.contains('open');
                
                // Rotasi/animasi tombol hamburger
                if (isOpen) {
                    toggle.classList.add('open');
                    toggle.style.transform = 'rotate(90deg)';
                    toggle.innerHTML = `<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>`;
                    document.body.style.overflow = 'hidden'; // Lock scroll
                } else {
                    toggle.classList.remove('open');
                    toggle.style.transform = 'rotate(0)';
                    toggle.innerHTML = `<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>`;
                    document.body.style.overflow = '';
                }
            }

            if (toggle && menu && backdrop) {
                toggle.addEventListener('click', toggleMenu);
                backdrop.addEventListener('click', toggleMenu);
            }

            // Mobile dropdown click-to-toggle
            const dropdowns = document.querySelectorAll('.nav-dropdown');
            dropdowns.forEach(function(dd) {
                const link = dd.querySelector('a');
                if (link) {
                    link.addEventListener('click', function(e) {
                        if (window.innerWidth <= 900) {
                            e.preventDefault();
                            const isActive = dd.classList.contains('active-toggle');
                            // Close other dropdowns
                            dropdowns.forEach(function(otherDd) {
                                otherDd.classList.remove('active-toggle');
                            });
                            if (!isActive) {
                                dd.classList.add('active-toggle');
                            }
                        }
                    });
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
