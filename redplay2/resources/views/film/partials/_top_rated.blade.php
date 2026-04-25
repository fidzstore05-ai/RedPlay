{{-- ===== TOP RATED (SCROLL ROW) ===== --}}
@if($topRatedFilms->isNotEmpty())
<div class="film-section">
    <div class="section-header">
        <h2 class="section-title">⭐ Top Rated</h2>
        <a href="{{ route('films.index') }}?rating=8" class="section-link">
            Lihat Semua
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path d="M9 18l6-6-6-6"/>
            </svg>
        </a>
    </div>
    <div class="film-scroll-row">
        @foreach($topRatedFilms as $film)
        <div class="film-scroll-card">
            <a href="{{ route('films.show', $film->id_film) }}">
                @if($film->thumbnail)
                    <img src="{{ $film->thumbnail }}"
                         alt="{{ $film->judul }}"
                         class="film-poster"
                         style="aspect-ratio:2/3; object-fit:cover; width:100%; display:block;">
                @else
                    <div class="film-poster-placeholder">
                        🎬<span>{{ $film->judul }}</span>
                    </div>
                @endif
                <div class="rating-badge">⭐ {{ number_format($film->rating, 1) }}</div>
                <div class="film-card-overlay">
                    <div class="film-card-actions">
                        <span class="card-btn">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                            Tonton
                        </span>
                    </div>
                </div>
            </a>
            <div class="film-card-info">
                <h3 class="film-card-title">{{ $film->judul }}</h3>
                <div class="film-card-meta">
                    <span class="film-card-rating">★ {{ $film->rating }}</span>
                    <span class="film-card-year">
                        {{ $film->tahun ? \Carbon\Carbon::parse($film->tahun)->year : '' }}
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
