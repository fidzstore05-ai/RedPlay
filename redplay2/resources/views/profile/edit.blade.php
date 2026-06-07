@extends('layouts.app')

@push('styles')
<style>
    /* Profile page custom styles */
    .profile-banner {
        background: linear-gradient(135deg, rgba(229, 9, 20, 0.15) 0%, rgba(31, 31, 31, 0.8) 100%);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 16px;
        padding: 2rem 2.2rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    }
    .profile-banner h1 {
        margin: 0;
        font-size: 1.7rem;
        font-weight: 700;
        color: #fff;
    }
    .profile-banner p {
        margin: 0.3rem 0 0 0;
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.45);
    }

    .profile-card {
        background: #1a1a1a;
        border: 1px solid rgba(255, 255, 255, 0.07);
        border-radius: 16px;
        padding: 2.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
    }

    .profile-header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin-bottom: 2.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        padding-bottom: 1.8rem;
    }

    .profile-user-info {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .avatar-wrapper {
        position: relative;
        width: 90px;
        height: 90px;
        border-radius: 50%;
        cursor: pointer;
        overflow: hidden;
        border: 3px solid rgba(229, 9, 20, 0.4);
        transition: all 0.3s;
    }

    .avatar-wrapper:hover {
        border-color: var(--primary);
        transform: scale(1.02);
    }

    .avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-fallback {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #e50914, #ff6b6b);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        font-weight: 700;
        color: white;
    }

    .avatar-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.25s;
        color: #fff;
        font-size: 0.68rem;
        font-weight: 600;
        gap: 0.2rem;
    }

    .avatar-wrapper:hover .avatar-overlay {
        opacity: 1;
    }

    .user-text-details h2 {
        margin: 0;
        font-size: 1.4rem;
        font-weight: 700;
        color: #fff;
    }

    .user-text-details p {
        margin: 0.2rem 0 0 0;
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.5);
    }

    .btn-update-profile {
        background: linear-gradient(135deg, #e50914, #c8000f);
        color: #fff;
        border: none;
        padding: 0.7rem 1.8rem;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.88rem;
        cursor: pointer;
        font-family: 'Outfit', sans-serif;
        transition: all 0.2s;
        box-shadow: 0 4px 15px rgba(229, 9, 20, 0.3);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-update-profile:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(229, 9, 20, 0.45);
        background: linear-gradient(135deg, #ff1f2c, #e50914);
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        .profile-header-section {
            flex-direction: column;
            align-items: flex-start;
        }
        .btn-update-profile {
            width: 100%;
            justify-content: center;
        }
    }

    .fg {
        margin-bottom: 1.5rem;
    }

    .fg label {
        display: block;
        font-size: 0.78rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.45);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.6rem;
    }

    .fg input, .fg select {
        width: 100%;
        background: #111;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 9px;
        color: #fff;
        font-family: 'Outfit', sans-serif;
        font-size: 0.9rem;
        padding: 0.8rem 1.1rem;
        outline: none;
        transition: border-color 0.2s, background 0.2s;
        box-sizing: border-box;
    }

    .fg input:focus, .fg select:focus {
        border-color: rgba(229, 9, 20, 0.5);
        background: #150808;
    }

    .fg input::placeholder {
        color: #444;
    }

    .fg select option {
        background: #1a1a1a;
    }

    /* Email badge card */
    .email-status-card {
        background: rgba(59, 130, 246, 0.06);
        border: 1px solid rgba(59, 130, 246, 0.2);
        border-radius: 10px;
        padding: 1rem 1.2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 0.5rem;
    }

    .email-status-icon {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        background: rgba(59, 130, 246, 0.15);
        color: #60a5fa;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .email-status-details {
        display: flex;
        flex-direction: column;
    }

    .email-status-address {
        font-weight: 600;
        font-size: 0.92rem;
        color: #fff;
    }

    .email-status-time {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.4);
        margin-top: 0.1rem;
    }

    .password-section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #fff;
        margin-top: 1.5rem;
        margin-bottom: 1.2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.06);
        padding-top: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
</style>
@endpush

@section('content')

{{-- Welcome Banner --}}
<div class="profile-banner">
    <h1>Welcome, {{ $user->nama }}</h1>
    <p>{{ now()->translatedFormat('l, d F Y') }}</p>
</div>

<div class="profile-card">
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Header Section: Avatar, Info, and Submit --}}
        <div class="profile-header-section">
            <div class="profile-user-info">
                {{-- Avatar Upload Trigger --}}
                <div class="avatar-wrapper" onclick="document.getElementById('avatar-input').click()" title="Ubah Foto Profil">
                    @if($user->foto_profile)
                        <img id="avatar-preview" src="{{ asset($user->foto_profile) }}" alt="Avatar" class="avatar-img">
                    @else
                        <div id="avatar-fallback-placeholder" class="avatar-fallback">{{ strtoupper(substr($user->nama, 0, 1)) }}</div>
                        <img id="avatar-preview" src="" alt="Avatar" class="avatar-img" style="display:none">
                    @endif
                    <div class="avatar-overlay">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                            <circle cx="12" cy="13" r="4"/>
                        </svg>
                        <span>UBAH FOTO</span>
                    </div>
                </div>
                {{-- Hidden input for file upload --}}
                <input type="file" id="avatar-input" name="foto_profile_file" accept="image/*" style="display:none" onchange="previewAvatar(this)">

                <div class="user-text-details">
                    <h2>{{ $user->nama }}</h2>
                    <p>{{ $user->email }}</p>
                </div>
            </div>

            {{-- Submit Button (matches 'Edit' button position in mockup) --}}
            <button type="submit" class="btn-update-profile">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                    <polyline points="17 21 17 13 7 13 7 21"/>
                    <polyline points="7 3 7 8 15 8"/>
                </svg>
                Simpan Profil
            </button>
        </div>

        {{-- Form Fields Grid --}}
        <div class="form-grid">
            {{-- Left Column --}}
            <div>
                {{-- Full Name --}}
                <div class="fg">
                    <label for="nama">Full Name</label>
                    <input type="text" id="nama" name="nama" placeholder="Your First Name" value="{{ old('nama', $user->nama) }}" required>
                </div>

                {{-- Gender --}}
                <div class="fg">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender">
                        <option value="" disabled {{ is_null($user->gender) ? 'selected' : '' }}>Your gender</option>
                        <option value="Pria" {{ old('gender', $user->gender) === 'Pria' ? 'selected' : '' }}>Pria</option>
                        <option value="Wanita" {{ old('gender', $user->gender) === 'Wanita' ? 'selected' : '' }}>Wanita</option>
                        <option value="Lainnya" {{ old('gender', $user->gender) === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
            </div>

            {{-- Right Column --}}
            <div>
                {{-- Username --}}
                <div class="fg">
                    <label for="username">username</label>
                    <input type="text" id="username" name="username" placeholder="Your username" value="{{ old('username', $user->username) }}">
                </div>

                {{-- Alamat Email (Mockup card style) --}}
                <div class="fg">
                    <label>Alamat Email</label>
                    <div class="email-status-card">
                        <div class="email-status-icon">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </div>
                        <div class="email-status-details">
                            <span class="email-status-address">{{ $user->email }}</span>
                            <span class="email-status-time">
                                @if($user->create_at)
                                    Terdaftar sejak {{ \Carbon\Carbon::parse($user->create_at)->translatedFormat('d F Y') }}
                                @else
                                    Email terverifikasi
                                @endif
                            </span>
                        </div>
                    </div>
                    {{-- Hidden email input to pass validation in case they change details but keeping email same --}}
                    <input type="hidden" name="email" value="{{ $user->email }}">
                </div>
            </div>
        </div>

        {{-- Optional Password Change Section --}}
        <div>
            <div class="password-section-title">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                Ganti Password (Opsional)
            </div>

            <div class="form-grid">
                <div class="fg">
                    <label for="password">Password Baru</label>
                    <input type="password" id="password" name="password" placeholder="Kosongkan jika tidak ingin diubah">
                </div>
                <div class="fg">
                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru">
                </div>
            </div>
        </div>

    </form>
</div>

@endsection

@push('scripts')
<script>
    /**
     * Preview image locally before upload
     */
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const preview = document.getElementById('avatar-preview');
                const fallback = document.getElementById('avatar-fallback-placeholder');
                
                preview.src = e.target.result;
                preview.style.display = 'block';
                
                if (fallback) {
                    fallback.style.display = 'none';
                }
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
