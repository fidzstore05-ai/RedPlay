@extends('layouts.app')

@section('content')
@section('content')
<div class="ambient-backdrop"
     @if($film->thumbnail)
        style="background-image: url('{{ $film->thumbnail_url }}')"
     @endif
></div>
<div class="ambient-overlay"></div>

<div class="film-detail">
    <div class="poster">
        <div class="poster-card">
            @if($film->thumbnail)
                <img src="{{ $film->thumbnail_url }}" alt="{{ $film->judul }}">
            @endif
        </div>
        <div class="action-buttons">
            @guest
                <a href="{{ route('films.watch', $film->id_film) }}" class="btn btn-primary btn-watch-now">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg>
                    Watch Now (Login)
                </a>
            @else
                <a href="{{ route('films.watch', $film->id_film) }}" class="btn btn-primary btn-watch-now">▶ Watch Now</a>
            @endguest
        </div>
    </div>

    <div class="detail-info-card">
        <div class="meta-row">
            <span class="rating-pill">⭐ {{ $film->rating ?? 'N/A' }}</span>
            <span class="meta-text">{{ $film->tahun ? \Carbon\Carbon::parse($film->tahun)->year : '—' }}</span>
            <span class="meta-divider">|</span>
            <span class="meta-text">{{ $film->subtitle ?? 'No Subtitle' }}</span>
            @if($film->durasi)
                <span class="meta-divider">|</span>
                <span class="meta-text">{{ $film->durasi }}</span>
            @endif
        </div>
        
        <h1 class="movie-title">{{ $film->judul }}</h1>
        
        <div class="genres">
            @foreach($film->genres as $genre)
                <a href="{{ route('films.index', ['genre' => $genre->id_genre]) }}" class="genre-badge">{{ $genre->genre }}</a>
            @endforeach
        </div>

        <p class="synopsis">{{ $film->deskripsi }}</p>

        @if($film->sutradara)
            <div style="margin-bottom: 2rem;">
                <span style="font-size: 0.8rem; text-transform: uppercase; color: rgba(255,255,255,0.4); letter-spacing: 0.5px; display: block; margin-bottom: 0.3rem;">Sutradara</span>
                <span style="font-size: 1rem; color: white; font-weight: 500;">{{ $film->sutradara }}</span>
            </div>
        @endif

        @if($film->actors->isNotEmpty())
            <h3 class="actors-title">Pemeran Utama</h3>
            <div class="actors">
                @foreach($film->actors as $actor)
                    <div class="actor-chip">{{ $actor->namaaktor }}</div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<!-- Rekomendasi Film -->
<div class="recommendations" style="margin-top: 5rem;">
    <h2 style="margin-bottom: 2rem; font-size: 1.4rem; font-weight: 700; display: flex; align-items: center; gap: 0.6rem;">
        <span style="width: 4px; height: 1.4rem; background: #e50914; border-radius: 2px; display: inline-block;"></span>
        Rekomendasi Film Serupa
    </h2>
    <div class="rec-film-grid">
        @forelse($recommendations as $rec)
            <div class="film-card">
                <a href="{{ route('films.show', $rec->id_film) }}">
                    <div style="aspect-ratio: 2/3; background: #333; position: relative;">
                        @if($rec->thumbnail)
                            <img src="{{ $rec->thumbnail_url }}" alt="{{ $rec->judul }}" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                        @endif
                        @if($rec->rating)
                            <div class="rating-badge">⭐ {{ number_format($rec->rating, 1) }}</div>
                        @endif
                    </div>
                    <div style="padding: 0.8rem;">
                        <h4 style="margin: 0; font-size: 0.88rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: white;">{{ $rec->judul }}</h4>
                    </div>
                </a>
            </div>
        @empty
            <p style="color: var(--gray);">Tidak ada rekomendasi saat ini.</p>
        @endforelse
    </div>
</div>

<style>
    /* Backdrop Ambient Blur */
    .ambient-backdrop {
        position: absolute;
        top: 62px;
        left: 0;
        right: 0;
        height: 450px;
        background-size: cover;
        background-position: center 25%;
        filter: blur(60px) brightness(0.2);
        opacity: 0.6;
        z-index: 1;
        pointer-events: none;
    }
    .ambient-overlay {
        position: absolute;
        top: 62px;
        left: 0;
        right: 0;
        height: 450px;
        background: linear-gradient(to bottom, transparent, var(--dark) 90%);
        z-index: 2;
        pointer-events: none;
    }

    .film-detail {
        position: relative;
        z-index: 10;
        display: flex;
        gap: 3rem;
        flex-wrap: wrap;
        margin-top: 1.5rem;
    }

    .film-detail .poster {
        flex: 1;
        min-width: 300px;
        max-width: 400px;
    }

    .poster-card {
        aspect-ratio: 2/3;
        background: #222;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 30px 60px rgba(0,0,0,0.8), 0 0 0 1px rgba(255,255,255,0.06);
    }
    .poster-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .action-buttons {
        margin-top: 2rem;
        display: flex;
        gap: 1rem;
    }

    .btn-watch-now {
        flex: 1;
        padding: 0.9rem !important;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        font-size: 0.95rem !important;
        font-weight: 700 !important;
        border-radius: 10px !important;
    }

    .detail-info-card {
        background: rgba(26, 26, 26, 0.45);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        padding: 2.5rem;
        border-radius: 18px;
        box-shadow: 0 16px 40px rgba(0,0,0,0.5), inset 0 1px 1px rgba(255,255,255,0.05);
        flex: 2;
        min-width: 300px;
    }

    .meta-row {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.2rem;
    }

    .rating-pill {
        background: rgba(245, 197, 24, 0.15);
        border: 1px solid rgba(245, 197, 24, 0.3);
        color: #f5c518;
        padding: 0.25rem 0.8rem;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.85rem;
    }

    .meta-text {
        color: rgba(255,255,255,0.6);
        font-size: 0.9rem;
    }

    .meta-divider {
        color: rgba(255,255,255,0.15);
        font-size: 0.9rem;
    }

    .movie-title {
        font-size: clamp(2rem, 4.5vw, 3.2rem);
        margin: 0 0 1.2rem 0;
        font-weight: 700;
        line-height: 1.1;
        color: white;
    }

    .genres {
        margin-bottom: 2rem;
        display: flex;
        flex-wrap: wrap;
        gap: 0.6rem;
    }

    .genre-badge {
        border: 1px solid rgba(255,255,255,0.12);
        background: rgba(255,255,255,0.03);
        padding: 0.35rem 1.1rem;
        border-radius: 20px;
        font-size: 0.82rem;
        color: rgba(255,255,255,0.8);
        transition: all 0.2s;
    }

    .genre-badge:hover {
        background: rgba(229, 9, 20, 0.12);
        border-color: rgba(229, 9, 20, 0.4);
        color: #ff6b6b;
    }

    .synopsis {
        font-size: 1rem;
        color: rgba(255,255,255,0.7);
        margin-bottom: 2.5rem;
        line-height: 1.8;
        white-space: pre-line;
    }

    .actors-title {
        font-size: 0.82rem;
        text-transform: uppercase;
        color: rgba(255,255,255,0.45);
        letter-spacing: 0.8px;
        margin-bottom: 0.8rem;
        border-top: 1px solid rgba(255,255,255,0.05);
        padding-top: 1.5rem;
    }

    .actors {
        display: flex;
        gap: 0.6rem;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }

    .actor-chip {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        padding: 0.45rem 1.1rem;
        border-radius: 20px;
        font-size: 0.82rem;
        color: rgba(255, 255, 255, 0.8);
        transition: all 0.2s;
    }

    .actor-chip:hover {
        background: rgba(229, 9, 20, 0.15);
        border-color: rgba(229, 9, 20, 0.4);
        color: white;
        transform: translateY(-2px);
    }

    /* Recommendations Grid */
    .rec-film-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 1.5rem;
    }

    .rec-film-grid .film-card {
        border-radius: 12px;
        overflow: hidden;
        background: rgba(20, 20, 20, 0.4);
        border: 1px solid rgba(255,255,255,0.03);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s ease, border-color 0.4s ease;
        box-shadow: 0 8px 24px rgba(0,0,0,0.3);
    }

    .rec-film-grid .film-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0,0,0,0.6), 0 0 15px rgba(229,9,20,0.15);
        border-color: rgba(229,9,20,0.3);
    }

    /* Rating badge inside grid */
    .rec-film-grid .rating-badge {
        position: absolute;
        top: 0.6rem;
        right: 0.6rem;
        background: rgba(15, 15, 15, 0.6);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 6px;
        padding: 0.25rem 0.55rem;
        font-size: 0.72rem;
        font-weight: 700;
        color: #f5c518;
        display: flex;
        align-items: center;
        gap: 0.25rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        z-index: 3;
    }

    /* ===== RESPONSIVE DETAIL FILM ===== */
    @media (max-width: 768px) {
        .film-detail {
            flex-direction: column;
            gap: 1.5rem !important;
        }
        .film-detail .poster {
            max-width: 280px !important;
            width: 100% !important;
            margin: 0 auto;
        }
        .detail-info-card {
            padding: 1.5rem;
        }
        .film-detail .info h1 {
            font-size: 2.2rem !important;
            margin-top: 1rem !important;
        }
    }
    @media (max-width: 480px) {
        .rec-film-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 0.8rem;
        }
    }
</style>
@endsection
