@extends('layouts.app')

@push('styles')
<style>
    /* ===== WATCH PAGE ===== */
    .watch-layout {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 2rem;
        align-items: start;
    }

    /* ===== VIDEO PLAYER ===== */
    .player-wrap {
        background: #000;
        border-radius: 14px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 20px 60px rgba(0,0,0,0.7);
    }

    .player-wrap video,
    .player-wrap iframe {
        width: 100%;
        aspect-ratio: 16/9;
        display: block;
        border: none;
    }

    .player-no-video {
        aspect-ratio: 16/9;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #0d0d0d, #1a1a2e, #0f3460);
        gap: 1rem;
        color: rgba(255,255,255,0.4);
    }

    .player-no-video .no-video-icon { font-size: 5rem; opacity: 0.3; }
    .player-no-video p { font-size: 1rem; }

    /* ===== FILM INFO BELOW PLAYER ===== */
    .film-info-bar {
        margin-top: 1.5rem;
    }

    .film-info-bar h1 {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0 0 0.8rem;
        line-height: 1.2;
    }

    .film-meta-row {
        display: flex;
        align-items: center;
        gap: 1.2rem;
        flex-wrap: wrap;
        margin-bottom: 1rem;
        font-size: 0.9rem;
        color: rgba(255,255,255,0.6);
    }

    .meta-rating {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        background: rgba(245,197,24,0.15);
        border: 1px solid rgba(245,197,24,0.3);
        color: #f5c518;
        font-weight: 700;
        padding: 0.25rem 0.7rem;
        border-radius: 6px;
        font-size: 0.9rem;
    }

    .genre-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1.2rem;
    }

    .genre-tag {
        background: rgba(229,9,20,0.15);
        border: 1px solid rgba(229,9,20,0.3);
        color: #ff6b6b;
        padding: 0.25rem 0.8rem;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s;
    }

    .genre-tag:hover {
        background: rgba(229,9,20,0.3);
        color: #ff6b6b;
    }

    .film-desc {
        font-size: 0.95rem;
        color: rgba(255,255,255,0.65);
        line-height: 1.8;
        margin-bottom: 1.5rem;
    }

    .film-desc.collapsed {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .toggle-desc {
        background: none;
        border: none;
        color: #e50914;
        font-size: 0.85rem;
        cursor: pointer;
        padding: 0;
        font-family: 'Outfit', sans-serif;
        margin-bottom: 1.5rem;
    }

    /* Actors */
    .actors-section { margin-bottom: 2rem; }
    .actors-section h3 {
        font-size: 1rem;
        font-weight: 600;
        color: rgba(255,255,255,0.5);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.8rem;
    }

    .actors-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .actor-chip {
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.1);
        padding: 0.3rem 0.9rem;
        border-radius: 20px;
        font-size: 0.82rem;
        color: rgba(255,255,255,0.8);
    }

    /* ===== COMMENTS ===== */
    .comments-section { margin-top: 2.5rem; }

    .comments-section h2 {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .comments-section h2::before {
        content: '';
        width: 4px;
        height: 1.2rem;
        background: #e50914;
        border-radius: 2px;
        display: inline-block;
    }

    .comment-form {
        background: rgba(31,31,31,0.8);
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 12px;
        padding: 1.2rem;
        margin-bottom: 1.5rem;
    }

    .comment-form textarea {
        width: 100%;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 8px;
        color: white;
        font-family: 'Outfit', sans-serif;
        font-size: 0.9rem;
        padding: 0.8rem;
        resize: vertical;
        min-height: 80px;
        box-sizing: border-box;
        outline: none;
        transition: border-color 0.2s;
    }

    .comment-form textarea:focus {
        border-color: rgba(229,9,20,0.5);
    }

    .comment-form textarea::placeholder { color: #555; }

    .comment-submit {
        margin-top: 0.8rem;
        background: #e50914;
        color: white;
        border: none;
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        font-family: 'Outfit', sans-serif;
        font-size: 0.88rem;
        cursor: pointer;
        transition: background 0.2s;
    }

    .comment-submit:hover { background: #ff1f2c; }

    .comment-login-prompt {
        background: rgba(31,31,31,0.8);
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 12px;
        padding: 1.2rem;
        margin-bottom: 1.5rem;
        text-align: center;
        color: rgba(255,255,255,0.5);
        font-size: 0.9rem;
    }

    .comment-login-prompt a { color: #e50914; }

    .comment-list { display: flex; flex-direction: column; gap: 1rem; }

    .comment-item {
        background: rgba(31,31,31,0.6);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 10px;
        padding: 1rem 1.2rem;
    }

    .comment-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }

    .comment-author {
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .comment-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #e50914, #ff6b6b);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        font-weight: 700;
        color: white;
        flex-shrink: 0;
    }

    .comment-name {
        font-weight: 600;
        font-size: 0.88rem;
    }

    .comment-delete {
        background: none;
        border: none;
        color: rgba(255,255,255,0.25);
        cursor: pointer;
        font-size: 0.75rem;
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
        transition: all 0.2s;
        font-family: 'Outfit', sans-serif;
    }

    .comment-delete:hover { color: #e50914; background: rgba(229,9,20,0.1); }

    .comment-text {
        font-size: 0.9rem;
        color: rgba(255,255,255,0.75);
        line-height: 1.6;
    }

    .no-comments {
        text-align: center;
        padding: 2rem;
        color: rgba(255,255,255,0.3);
        font-size: 0.9rem;
    }

    /* ===== LIKE BUTTON ===== */
    .comment-footer {
        margin-top: 0.6rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .like-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: none;
        border: 1px solid rgba(255,255,255,0.1);
        color: rgba(255,255,255,0.4);
        font-size: 0.78rem;
        font-family: 'Outfit', sans-serif;
        padding: 0.3rem 0.7rem;
        border-radius: 20px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .like-btn:hover {
        border-color: rgba(229,9,20,0.4);
        color: #ff6b6b;
        background: rgba(229,9,20,0.08);
    }

    .like-btn.liked {
        border-color: rgba(229,9,20,0.5);
        color: #e50914;
        background: rgba(229,9,20,0.12);
    }

    .like-btn.liked svg { fill: #e50914; stroke: #e50914; }

    .like-btn-static {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        color: rgba(255,255,255,0.25);
        font-size: 0.78rem;
    }

    /* ===== SIDEBAR ===== */
    .sidebar { position: sticky; top: 80px; }

    .sidebar-title {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: rgba(255,255,255,0.8);
    }

    .sidebar-title::before {
        content: '';
        width: 3px;
        height: 1rem;
        background: #e50914;
        border-radius: 2px;
        display: inline-block;
    }

    .rec-list { display: flex; flex-direction: column; gap: 0.8rem; }

    .rec-card {
        display: flex;
        gap: 0.8rem;
        background: rgba(31,31,31,0.7);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 10px;
        overflow: hidden;
        text-decoration: none;
        transition: all 0.25s;
    }

    .rec-card:hover {
        background: rgba(50,50,50,0.9);
        border-color: rgba(229,9,20,0.3);
        transform: translateX(3px);
    }

    .rec-thumb {
        width: 80px;
        flex-shrink: 0;
        aspect-ratio: 2/3;
        object-fit: cover;
        background: #1a1a2e;
    }

    .rec-thumb-placeholder {
        width: 80px;
        flex-shrink: 0;
        aspect-ratio: 2/3;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #1a1a2e, #0f3460);
        font-size: 1.5rem;
    }

    .rec-info {
        padding: 0.7rem 0.8rem 0.7rem 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 0.3rem;
        min-width: 0;
    }

    .rec-title {
        font-size: 0.85rem;
        font-weight: 600;
        color: white;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .rec-meta {
        font-size: 0.75rem;
        color: rgba(255,255,255,0.4);
        display: flex;
        gap: 0.5rem;
    }

    .rec-rating { color: #f5c518; font-weight: 600; }

    /* ===== BACK BUTTON ===== */
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: rgba(255,255,255,0.5);
        font-size: 0.85rem;
        margin-bottom: 1.5rem;
        transition: color 0.2s;
        text-decoration: none;
    }

    .back-btn:hover { color: white; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 900px) {
        .watch-layout {
            grid-template-columns: 1fr;
        }
        .sidebar { position: static; }
    }
</style>
@endpush

@section('content')

<a href="{{ route('films.show', $film->id_film) }}" class="back-btn">
    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M19 12H5M12 5l-7 7 7 7"/>
    </svg>
    Kembali ke Detail Film
</a>

<div class="watch-layout">

    {{-- ===== MAIN COLUMN ===== --}}
    <div class="main-col">

        {{-- VIDEO PLAYER --}}
        <div class="player-wrap">
            @if($film->video)
                @php
                    $videoUrl = $film->video;
                    // Detect YouTube
                    $isYoutube = str_contains($videoUrl, 'youtube.com') || str_contains($videoUrl, 'youtu.be');
                    if ($isYoutube) {
                        preg_match('/(?:v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $videoUrl, $m);
                        $ytId = $m[1] ?? null;
                    }
                    // Detect Google Drive
                    $isDrive = str_contains($videoUrl, 'drive.google.com');
                    if ($isDrive) {
                        preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $videoUrl, $dm);
                        $driveId = $dm[1] ?? null;
                    }
                @endphp

                @if($isYoutube && isset($ytId))
                    <iframe src="https://www.youtube.com/embed/{{ $ytId }}?autoplay=1&rel=0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                @elseif($isDrive && isset($driveId))
                    <iframe src="https://drive.google.com/file/d/{{ $driveId }}/preview"
                            allow="autoplay" allowfullscreen></iframe>
                @else
                    <video controls autoplay>
                        <source src="{{ $videoUrl }}" type="video/mp4">
                        @if($film->subtitle)
                            <track kind="subtitles" src="{{ $film->subtitle }}" srclang="id" label="Indonesia" default>
                        @endif
                        Browser kamu tidak mendukung video player.
                    </video>
                @endif
            @else
                <div class="player-no-video">
                    <div class="no-video-icon">🎬</div>
                    <p>Video belum tersedia untuk film ini</p>
                </div>
            @endif
        </div>

        {{-- FILM INFO --}}
        <div class="film-info-bar">
            <h1>{{ $film->judul }}</h1>

            <div class="film-meta-row">
                @if($film->rating)
                    <span class="meta-rating">★ {{ number_format($film->rating, 1) }}</span>
                @endif
                @if($film->tahun)
                    <span>{{ \Carbon\Carbon::parse($film->tahun)->year }}</span>
                @endif
                @if($film->subtitle)
                    <span>🗒 Subtitle tersedia</span>
                @endif
            </div>

            @if($film->genres->isNotEmpty())
                <div class="genre-tags">
                    @foreach($film->genres as $g)
                        <a href="{{ route('films.index', ['genre' => $g->id_genre]) }}" class="genre-tag">{{ $g->genre }}</a>
                    @endforeach
                </div>
            @endif

            @if($film->deskripsi)
                <p class="film-desc collapsed" id="film-desc">{{ $film->deskripsi }}</p>
                <button class="toggle-desc" id="toggle-desc" onclick="toggleDesc()">Selengkapnya ▾</button>
            @endif

            @if($film->actors->isNotEmpty())
                <div class="actors-section">
                    <h3>Pemeran</h3>
                    <div class="actors-list">
                        @foreach($film->actors as $actor)
                            <span class="actor-chip">{{ $actor->namaaktor }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- COMMENTS --}}
        <div class="comments-section">
            <h2>Komentar ({{ $film->comments->count() }})</h2>

            @auth
                <form class="comment-form" action="{{ route('comments.store', $film->id_film) }}" method="POST">
                    @csrf
                    <textarea name="isi_komentar" placeholder="Tulis komentarmu tentang film ini..." required>{{ old('isi_komentar') }}</textarea>
                    <button type="submit" class="comment-submit">Kirim Komentar</button>
                </form>
            @else
                <div class="comment-login-prompt">
                    <a href="{{ route('login') }}">Login</a> untuk meninggalkan komentar.
                </div>
            @endauth

            <div class="comment-list">
                @forelse($film->comments as $comment)
                    <div class="comment-item" id="comment-{{ $comment->id_comment }}">
                        <div class="comment-header">
                            <div class="comment-author">
                                <div class="comment-avatar">
                                    {{ strtoupper(substr($comment->user->nama ?? 'U', 0, 1)) }}
                                </div>
                                <span class="comment-name">{{ $comment->user->nama ?? 'Pengguna' }}</span>
                            </div>
                            @auth
                                @if(Auth::id() === $comment->user_id_user || Auth::user()->role === 'admin')
                                    <form action="{{ route('comments.destroy', $comment->id_comment) }}" method="POST" style="display:inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="comment-delete" onclick="return confirm('Hapus komentar ini?')">✕ Hapus</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                        <p class="comment-text">{{ $comment->isi_komentar }}</p>
                        {{-- LIKE BUTTON --}}
                        <div class="comment-footer">
                            @auth
                                <button class="like-btn {{ $comment->isLikedBy(Auth::id()) ? 'liked' : '' }}"
                                        data-id="{{ $comment->id_comment }}"
                                        data-url="{{ route('comments.like', $comment->id_comment) }}">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="{{ $comment->isLikedBy(Auth::id()) ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                    </svg>
                                    <span class="like-count">{{ $comment->likes->count() }}</span>
                                </button>
                            @else
                                <span class="like-btn-static">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                    </svg>
                                    {{ $comment->likes->count() }}
                                </span>
                            @endauth
                        </div>
                    </div>
                @empty
                    <div class="no-comments">💬 Belum ada komentar. Jadilah yang pertama!</div>
                @endforelse
            </div>
        </div>

    </div>

    {{-- ===== SIDEBAR ===== --}}
    <aside class="sidebar">
        <div class="sidebar-title">Rekomendasi Untukmu</div>
        <div class="rec-list">
            @forelse($recommendations as $rec)
                <a href="{{ route('films.watch', $rec->id_film) }}" class="rec-card">
                    @if($rec->thumbnail)
                        <img src="{{ $rec->thumbnail }}" alt="{{ $rec->judul }}" class="rec-thumb">
                    @else
                        <div class="rec-thumb-placeholder">🎬</div>
                    @endif
                    <div class="rec-info">
                        <span class="rec-title">{{ $rec->judul }}</span>
                        <div class="rec-meta">
                            @if($rec->rating)
                                <span class="rec-rating">★ {{ $rec->rating }}</span>
                            @endif
                            @if($rec->tahun)
                                <span>{{ \Carbon\Carbon::parse($rec->tahun)->year }}</span>
                            @endif
                        </div>
                    </div>
                </a>
            @empty
                <p style="color:rgba(255,255,255,0.3);font-size:0.85rem;">Tidak ada rekomendasi.</p>
            @endforelse
        </div>
    </aside>

</div>

@endsection

@push('scripts')
<script>
    function toggleDesc() {
        const desc = document.getElementById('film-desc');
        const btn  = document.getElementById('toggle-desc');
        if (desc.classList.contains('collapsed')) {
            desc.classList.remove('collapsed');
            btn.textContent = 'Lebih sedikit ▴';
        } else {
            desc.classList.add('collapsed');
            btn.textContent = 'Selengkapnya ▾';
        }
    }

    // Like button AJAX
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.like-btn[data-url]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const url = btn.dataset.url;

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                })
                .then(res => res.json())
                .then(data => {
                    const svg = btn.querySelector('svg');
                    const count = btn.querySelector('.like-count');

                    count.textContent = data.count;

                    if (data.liked) {
                        btn.classList.add('liked');
                        svg.setAttribute('fill', 'currentColor');
                    } else {
                        btn.classList.remove('liked');
                        svg.setAttribute('fill', 'none');
                    }

                    // Bounce animation
                    btn.style.transform = 'scale(1.2)';
                    setTimeout(() => btn.style.transform = 'scale(1)', 150);
                })
                .catch(() => {});
            });
        });
    });
</script>
@endpush
