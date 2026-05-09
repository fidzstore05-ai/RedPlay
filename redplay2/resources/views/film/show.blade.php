@extends('layouts.app')

@section('content')
<div class="film-detail" style="display: flex; gap: 3rem; flex-wrap: wrap;">
    <div class="poster" style="flex: 1; min-width: 300px; max-width: 400px;">
        <div style="aspect-ratio: 2/3; background: #333; border-radius: 16px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.5);">
            @if($film->thumbnail)
                <img src="{{ $film->thumbnail }}" alt="{{ $film->judul }}" style="width: 100%; height: 100%; object-fit: cover;">
            @endif
        </div>
        <div style="margin-top: 2rem; display: flex; gap: 1rem;">
            <a href="{{ route('films.watch', $film->id_film) }}" class="btn btn-primary" style="flex: 1; padding: 1rem; text-align:center;">▶ Watch Now</a>
            <button class="btn btn-outline" style="flex: 1; padding: 1rem;">Trailer</button>
        </div>
    </div>

    <div class="info" style="flex: 2; min-width: 300px;">
        <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 1rem;">
            <span style="background: var(--primary); padding: 0.2rem 0.8rem; border-radius: 4px; font-weight: 700;">★ {{ $film->rating ?? 'N/A' }}</span>
            <span style="color: var(--gray);">{{ \Carbon\Carbon::parse($film->tahun)->year }}</span>
            <span style="color: var(--gray);">{{ $film->subtitle ?? 'No Subtitle' }}</span>
        </div>
        
        <h1 style="font-size: 3.5rem; margin: 0 0 1rem 0; font-weight: 700; line-height: 1.1;">{{ $film->judul }}</h1>
        
        <div class="genres" style="margin-bottom: 2rem; display: flex; gap: 0.8rem;">
            @foreach($film->genres as $genre)
                <span style="border: 1px solid var(--gray); padding: 0.3rem 1rem; border-radius: 20px; font-size: 0.9rem;">{{ $genre->genre }}</span>
            @endforeach
        </div>

        <p style="font-size: 1.1rem; color: #ccc; margin-bottom: 2.5rem; line-height: 1.8;">{{ $film->deskripsi }}</p>

        <h3 style="margin-bottom: 1rem; border-bottom: 1px solid #333; padding-bottom: 0.5rem;">Actors</h3>
        <div class="actors" style="display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 3rem;">
            @foreach($film->actors as $actor)
                <div style="background: var(--secondary); padding: 0.5rem 1rem; border-radius: 8px;">{{ $actor->nama }}</div>
            @endforeach
        </div>
    </div>
</div>

<!-- Rekomendasi Film -->
<div class="recommendations" style="margin-top: 5rem;">
    <h2 style="margin-bottom: 2rem;">Rekomendasi Film Serupa</h2>
    <div class="film-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 1.5rem;">
        @forelse($recommendations as $rec)
            <div class="film-card" style="background: var(--secondary); border-radius: 12px; overflow: hidden; transition: 0.3s;">
                <a href="{{ route('films.show', $rec->id_film) }}">
                    <div style="aspect-ratio: 2/3; background: #333;">
                        @if($rec->thumbnail)
                            <img src="{{ $rec->thumbnail }}" alt="{{ $rec->judul }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @endif
                    </div>
                    <div style="padding: 0.8rem;">
                        <h4 style="margin: 0; font-size: 0.95rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $rec->judul }}</h4>
                    </div>
                </a>
            </div>
        @empty
            <p style="color: var(--gray);">Tidak ada rekomendasi saat ini.</p>
        @endforelse
    </div>
</div>

<style>
    .film-card:hover { transform: scale(1.03); }
</style>
@endsection
