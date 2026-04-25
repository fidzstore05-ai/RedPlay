{{-- ===== HERO SLIDER ===== --}}
@if($heroFilms->isNotEmpty())
<div class="hero" id="hero-main">

    {{-- Ambient blurred background --}}
    <div class="hero-ambient" id="hero-ambient"
        @if($heroFilms->first()->thumbnail)
            style="background-image: url('{{ $heroFilms->first()->thumbnail }}')"
        @endif
    ></div>

    {{-- Bottom fade --}}
    <div class="hero-gradient"></div>

    <div class="hero-slides">
        @foreach($heroFilms as $i => $hFilm)
        <div class="hero-slide {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}">

            {{-- Left overlay --}}
            <div class="hero-overlay"></div>

            {{-- Poster (kanan) --}}
            <div class="hero-poster-wrap">
                @if($hFilm->thumbnail)
                    <img src="{{ $hFilm->thumbnail }}"
                         alt="{{ $hFilm->judul }}"
                         class="hero-poster-img"
                         data-thumb="{{ $hFilm->thumbnail }}">
                @else
                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:8rem;background:linear-gradient(135deg,#1a1a2e,#0f3460);">🎬</div>
                @endif
                <div class="hero-poster-fade"></div>
            </div>

            {{-- Teks (kiri) --}}
            <div class="hero-content" style="position:relative;z-index:10;">
                <div class="hero-badge">🔥 Featured Now</div>
                <h1 class="hero-title">{{ $hFilm->judul }}</h1>
                <div class="hero-meta">
                    @if($hFilm->rating)
                        <span class="hero-rating">★ {{ number_format($hFilm->rating, 1) }}</span>
                    @endif
                    @if($hFilm->tahun)
                        <span>{{ \Carbon\Carbon::parse($hFilm->tahun)->year }}</span>
                    @endif
                </div>
                @if($hFilm->genres->isNotEmpty())
                <div class="hero-genres">
                    @foreach($hFilm->genres->take(3) as $g)
                        <span class="genre-pill">{{ $g->genre }}</span>
                    @endforeach
                </div>
                @endif
                @if($hFilm->deskripsi)
                <p class="hero-desc">{{ $hFilm->deskripsi }}</p>
                @endif
                <div class="hero-actions">
                    <a href="{{ route('films.show', $hFilm->id_film) }}" class="btn-hero-play">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                        Play Now
                    </a>
                    <a href="{{ route('films.show', $hFilm->id_film) }}" class="btn-hero-info">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
                        More Info
                    </a>
                </div>
            </div>

        </div>
        @endforeach
    </div>

    {{-- Dots --}}
    <div class="hero-dots">
        @foreach($heroFilms as $i => $hFilm)
            <button class="hero-dot {{ $i === 0 ? 'active' : '' }}"
                    data-slide="{{ $i }}"
                    data-thumb="{{ $hFilm->thumbnail }}"></button>
        @endforeach
    </div>

</div>
@endif
