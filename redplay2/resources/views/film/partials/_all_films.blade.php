{{-- ===== SEMUA FILM (GRID) ===== --}}
<div class="film-section">
    <div class="section-header">
        <h2 class="section-title">🎬 Semua Film</h2>
        <span class="section-link">{{ $films->total() }} film</span>
    </div>
    <div class="film-row">
        @forelse($films as $film)
        <div class="film-card">
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
                @if($film->rating)
                    <div class="rating-badge">⭐ {{ $film->rating }}</div>
                @endif
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
                    @if($film->rating)
                        <span class="film-card-rating">★ {{ $film->rating }}</span>
                    @else
                        <span class="film-card-rating" style="color:#444;">★ N/A</span>
                    @endif
                    <span class="film-card-year">
                        {{ $film->tahun ? \Carbon\Carbon::parse($film->tahun)->year : '—' }}
                    </span>
                </div>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="empty-icon">🎬</div>
            <h3>Belum ada film</h3>
            <p>Film akan muncul di sini setelah ditambahkan</p>
        </div>
        @endforelse
    </div>

    <div class="pagination-wrapper">
        {{ $films->links() }}
    </div>
</div>
