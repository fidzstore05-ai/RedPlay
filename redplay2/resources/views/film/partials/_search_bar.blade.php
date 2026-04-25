{{-- ===== SEARCH BAR ===== --}}
<div class="search-bar-wrapper">
    <form action="{{ route('films.index') }}" method="GET" class="search-bar">
        <span class="search-icon">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
            </svg>
        </span>
        <input type="text" name="q"
               placeholder="{{ $placeholder ?? 'Cari film, genre, aktor...' }}"
               value="{{ request('q') }}"
               {{ isset($autofocus) && $autofocus ? 'autofocus' : '' }}>
        <select name="genre">
            <option value="">Semua Genre</option>
            @foreach($genres as $genre)
                <option value="{{ $genre->id_genre }}"
                    {{ request('genre') == $genre->id_genre ? 'selected' : '' }}>
                    {{ $genre->genre }}
                </option>
            @endforeach
        </select>
        <select name="rating">
            <option value="">Rating</option>
            <option value="9" {{ request('rating') == '9' ? 'selected' : '' }}>★ 9+</option>
            <option value="8" {{ request('rating') == '8' ? 'selected' : '' }}>★ 8+</option>
            <option value="7" {{ request('rating') == '7' ? 'selected' : '' }}>★ 7+</option>
        </select>
        <button type="submit" class="btn-search">
            {{ $btnLabel ?? 'Cari Film' }}
        </button>
    </form>
</div>
