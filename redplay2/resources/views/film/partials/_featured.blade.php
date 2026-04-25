{{-- ===== FILM TERBARU (FEATURED) ===== --}}
@if($latestFilms->isNotEmpty())
<div class="film-section">
    <div class="section-header">
        <h2 class="section-title">Film Terbaru</h2>
        <a href="{{ route('films.index') }}" class="section-link">
            Lihat Semua
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path d="M9 18l6-6-6-6"/>
            </svg>
        </a>
    </div>
    <div class="featured-row">
        @foreach($latestFilms->take(3) as $idx => $film)
        <a href="{{ route('films.show', $film->id_film) }}"
           class="featured-card"
           style="animation-delay: {{ $idx * 0.1 }}s">
            @if($film->thumbnail)
                <img src="{{ $film->thumbnail }}" alt="{{ $film->judul }}" class="featured-card-img">
            @else
                <div class="featured-card-placeholder">🎬</div>
            @endif
            <div class="featured-card-overlay">
                <span class="featured-play-btn">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                    Tonton
                </span>
                <h3 class="featured-card-title">{{ $film->judul }}</h3>
                <div class="featured-card-meta">
                    @if($film->rating)
                        <span class="featured-card-metarating">★ {{ $film->rating }}</span> &nbsp;
                    @endif
                    {{ $film->tahun ? \Carbon\Carbon::parse($film->tahun)->year : '' }}
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endif
