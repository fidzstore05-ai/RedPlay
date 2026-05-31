@extends('layouts.app')
@push('styles')
<style>
.create-wrap{display:grid;grid-template-columns:1fr 1fr;gap:2rem;align-items:start}
.create-header{margin-bottom:2rem}
.create-header .welcome{font-size:1.5rem;font-weight:700;margin-bottom:.2rem}
.create-header .date{font-size:.82rem;color:rgba(255,255,255,.4)}
.panel{background:#1a1a1a;border:1px solid rgba(255,255,255,.07);border-radius:16px;overflow:hidden}
.panel-title{font-size:1.1rem;font-weight:700;padding:1.3rem 1.5rem;border-bottom:1px solid rgba(255,255,255,.06);display:flex;align-items:center;gap:.6rem}
.panel-body{padding:1.5rem}
.fg{margin-bottom:1.2rem}
.fg label{display:block;font-size:.78rem;font-weight:600;color:rgba(255,255,255,.45);text-transform:uppercase;letter-spacing:.5px;margin-bottom:.5rem}
.fg input,.fg textarea,.fg select{width:100%;background:#111;border:1px solid rgba(255,255,255,.1);border-radius:9px;color:#fff;font-family:Outfit,sans-serif;font-size:.9rem;padding:.75rem 1rem;outline:none;transition:border-color .2s,background .2s;box-sizing:border-box}
.fg input:focus,.fg textarea:focus,.fg select:focus{border-color:rgba(229,9,20,.5);background:#150808}
.fg input::placeholder,.fg textarea::placeholder{color:#444}
.fg textarea{resize:vertical;min-height:90px}
.fg select option{background:#1a1a1a}
.form-row-2{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
.genre-tags-input{display:flex;flex-wrap:wrap;gap:.4rem;background:#111;border:1px solid rgba(255,255,255,.1);border-radius:9px;padding:.6rem .8rem;min-height:44px;cursor:text;transition:border-color .2s}
.genre-tags-input:focus-within{border-color:rgba(229,9,20,.5)}
.genre-tag-chip{display:inline-flex;align-items:center;gap:.3rem;background:rgba(229,9,20,.2);border:1px solid rgba(229,9,20,.4);color:#ff6b6b;padding:.2rem .6rem;border-radius:20px;font-size:.78rem;font-weight:600}
.genre-tag-chip button{background:none;border:none;color:#ff6b6b;cursor:pointer;font-size:.9rem;line-height:1;padding:0}
.genre-dropdown{position:relative}
.genre-dropdown-menu{display:none;position:absolute;top:100%;left:0;right:0;background:#1f1f1f;border:1px solid rgba(255,255,255,.1);border-radius:9px;z-index:10;max-height:200px;overflow-y:auto;margin-top:.3rem}
.genre-dropdown-menu.open{display:block}
.genre-option{padding:.6rem 1rem;font-size:.85rem;cursor:pointer;transition:background .15s;display:flex;align-items:center;gap:.5rem}
.genre-option:hover{background:rgba(229,9,20,.1);color:#ff6b6b}
.genre-option.selected{color:#ff6b6b}
.upload-box{border:2px dashed rgba(255,255,255,.1);border-radius:12px;padding:1.2rem;text-align:center;cursor:pointer;transition:all .2s;position:relative;overflow:hidden}
.upload-box:hover{border-color:rgba(229,9,20,.4);background:rgba(229,9,20,.04)}
.upload-box input[type=file]{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%}
.upload-box .ub-icon{font-size:1.8rem;margin-bottom:.4rem}
.upload-box .ub-label{font-size:.82rem;color:rgba(255,255,255,.5)}
.upload-box .ub-hint{font-size:.72rem;color:rgba(255,255,255,.25);margin-top:.2rem}
.poster-preview{width:100%;aspect-ratio:2/3;object-fit:cover;border-radius:10px;display:none}
.poster-preview.show{display:block}
.poster-placeholder{width:100%;aspect-ratio:2/3;background:linear-gradient(135deg,#1a1a2e,#0f3460);border-radius:10px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:.5rem;color:rgba(255,255,255,.3);font-size:.85rem}
.poster-placeholder .ph-icon{font-size:3rem;opacity:.3}
.video-upload-box{border:1px solid rgba(255,255,255,.1);border-radius:9px;padding:1rem;background:#111;position:relative}
.video-file-info{display:flex;align-items:center;gap:.8rem;margin-bottom:.8rem}
.video-file-icon{width:36px;height:36px;background:rgba(59,130,246,.15);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#60a5fa;flex-shrink:0}
.video-file-name{font-size:.85rem;font-weight:600;color:#fff}
.video-file-size{font-size:.75rem;color:rgba(255,255,255,.4)}
.btn-upload-video{display:inline-flex;align-items:center;gap:.5rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:rgba(255,255,255,.7);padding:.5rem 1rem;border-radius:8px;font-size:.82rem;font-weight:600;cursor:pointer;font-family:Outfit,sans-serif;transition:all .2s;position:relative;overflow:hidden}
.btn-upload-video input[type=file]{position:absolute;inset:0;opacity:0;cursor:pointer}
.btn-upload-video:hover{border-color:rgba(229,9,20,.4);color:#fff}
.form-actions{display:flex;gap:.8rem;margin-top:1.5rem;padding-top:1.5rem;border-top:1px solid rgba(255,255,255,.06)}
.btn-reset{flex:1;background:transparent;border:1px solid rgba(255,255,255,.15);color:rgba(255,255,255,.6);padding:.75rem;border-radius:9px;font-weight:600;font-size:.9rem;cursor:pointer;font-family:Outfit,sans-serif;transition:all .2s;display:flex;align-items:center;justify-content:center;gap:.5rem}
.btn-reset:hover{border-color:rgba(255,255,255,.35);color:#fff}
.btn-save{flex:2;background:linear-gradient(135deg,#e50914,#c8000f);color:#fff;border:none;padding:.75rem;border-radius:9px;font-weight:700;font-size:.9rem;cursor:pointer;font-family:Outfit,sans-serif;transition:all .2s;box-shadow:0 4px 15px rgba(229,9,20,.3);display:flex;align-items:center;justify-content:center;gap:.5rem}
.btn-save:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(229,9,20,.45)}
/* PREVIEW */
.preview-poster-wrap{position:relative;border-radius:12px;overflow:hidden;aspect-ratio:16/9;background:linear-gradient(135deg,#1a1a2e,#0f3460);margin-bottom:1.2rem}
.preview-poster-img{width:100%;height:100%;object-fit:cover;display:none}
.preview-poster-img.show{display:block}
.preview-poster-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,.85) 0%,transparent 60%);display:flex;flex-direction:column;justify-content:flex-end;padding:1.2rem}
.preview-title{font-size:1.3rem;font-weight:700;color:#fff;margin-bottom:.4rem}
.preview-genres{display:flex;flex-wrap:wrap;gap:.4rem}
.preview-genre-pill{background:rgba(229,9,20,.8);color:#fff;padding:.15rem .6rem;border-radius:4px;font-size:.72rem;font-weight:600}
.preview-info{padding:1rem 1.5rem}
.preview-info-title{font-size:1.2rem;font-weight:700;margin-bottom:.5rem}
.preview-genre-row{display:flex;flex-wrap:wrap;gap:.4rem;margin-bottom:.8rem}
.preview-genre-badge{background:rgba(229,9,20,.15);border:1px solid rgba(229,9,20,.3);color:#ff6b6b;padding:.2rem .7rem;border-radius:20px;font-size:.75rem;font-weight:600}
.preview-rating-badge{background:rgba(245,197,24,.15);border:1px solid rgba(245,197,24,.3);color:#f5c518;padding:.2rem .7rem;border-radius:20px;font-size:.75rem;font-weight:700}
.preview-desc{font-size:.85rem;color:rgba(255,255,255,.6);line-height:1.7;margin-bottom:1rem;white-space:pre-line}
.preview-meta{font-size:.82rem;color:rgba(255,255,255,.5);margin-bottom:.3rem}
.preview-meta span{color:rgba(255,255,255,.8)}
.preview-actions{display:flex;gap:.6rem;padding:0 1.5rem 1.5rem}
.btn-preview-edit{flex:1;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);color:#fff;padding:.6rem;border-radius:8px;font-size:.82rem;font-weight:600;cursor:pointer;font-family:Outfit,sans-serif;display:flex;align-items:center;justify-content:center;gap:.4rem}
.btn-preview-del{flex:1;background:rgba(229,9,20,.15);border:1px solid rgba(229,9,20,.3);color:#ff6b6b;padding:.6rem;border-radius:8px;font-size:.82rem;font-weight:600;cursor:pointer;font-family:Outfit,sans-serif;display:flex;align-items:center;justify-content:center;gap:.4rem}
.video-preview-wrap{border-radius:12px;overflow:hidden;background:#000;aspect-ratio:16/9;display:flex;align-items:center;justify-content:center;margin-bottom:1.2rem;position:relative}
.video-preview-wrap video{width:100%;height:100%;object-fit:cover}
.video-preview-placeholder{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:.5rem;color:rgba(255,255,255,.2);font-size:.85rem;width:100%;height:100%;background:linear-gradient(135deg,#0d0d0d,#1a1a1a)}
.video-preview-placeholder .vp-icon{font-size:3rem;opacity:.2}
.alert{padding:.8rem 1rem;border-radius:9px;margin-bottom:1.5rem;font-size:.88rem}
.alert-danger{background:rgba(229,9,20,.12);border:1px solid rgba(229,9,20,.3);color:#ff6b6b}
@media(max-width:900px){.create-wrap{grid-template-columns:1fr}}
</style>
@endpush

@section('content')

{{-- Header --}}
<div class="create-header">
  <div class="welcome">Welcome, {{ Auth::user()->nama }}</div>
  <div class="date">{{ now()->translatedFormat('D, d F Y') }}</div>
</div>

@if($errors->any())
  <div class="alert alert-danger">
    @foreach($errors->all() as $e) <div>{{ $e }}</div> @endforeach
  </div>
@endif

<div class="create-wrap">

  {{-- ===== LEFT: FORM ===== --}}
  <div>
    <div class="panel">
      <div class="panel-title">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
        Edit Film
      </div>
      <div class="panel-body">
        <form action="{{ route('films.update', $film->id_film) }}" method="POST" id="filmForm" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          {{-- Judul --}}
          <div class="fg">
            <label>Judul Film</label>
            <input type="text" name="judul" id="inp_judul" placeholder="Pandemic 1920" value="{{ old('judul', $film->judul) }}" required>
          </div>

          {{-- Genre --}}
          <div class="fg">
            <label>Genre</label>
            <div class="genre-dropdown">
              <div class="genre-tags-input" id="genreTagsInput" onclick="toggleGenreDropdown()">
                <div id="genreChips"></div>
                <span id="genrePlaceholder" style="color:#444;font-size:.88rem;align-self:center;">Pilih genre...</span>
              </div>
              <div class="genre-dropdown-menu" id="genreDropdown">
                @foreach($genres as $g)
                  <div class="genre-option" data-id="{{ $g->id_genre }}" data-name="{{ $g->genre }}" onclick="toggleGenre(this)">
                    <span>{{ $g->genre }}</span>
                  </div>
                @endforeach
              </div>
            </div>
            <div id="genreInputs"></div>
          </div>

          {{-- Deskripsi --}}
          <div class="fg">
            <label>Deskripsi</label>
            <textarea name="deskripsi" id="inp_deskripsi" placeholder="Sinopsis film...">{{ old('deskripsi', $film->deskripsi) }}</textarea>
          </div>

          {{-- Aktor --}}
          <div class="fg">
            <label>Aktor <span style="font-size:.72rem;color:rgba(255,255,255,.3);text-transform:none;">(pisahkan dengan koma atau pilih)</span></label>
            <div class="genre-dropdown">
              <div class="genre-tags-input" id="actorTagsInput" onclick="toggleActorDropdown()">
                <div id="actorChips"></div>
                <span id="actorPlaceholder" style="color:#444;font-size:.88rem;align-self:center;">Pilih aktor...</span>
              </div>
              <div class="genre-dropdown-menu" id="actorDropdown">
                @foreach($actors as $a)
                  <div class="genre-option" data-id="{{ $a->id_aktor }}" data-name="{{ $a->namaaktor }}" onclick="toggleActor(this)">
                    <span>{{ $a->namaaktor }}</span>
                  </div>
                @endforeach
              </div>
            </div>
            <div id="actorInputs"></div>
          </div>

          {{-- Sutradara & Tahun --}}
          <div class="form-row-2">
            <div class="fg">
              <label>Sutradara</label>
              <input type="text" name="sutradara" id="inp_sutradara" placeholder="Nama sutradara" value="{{ old('sutradara', $film->sutradara) }}">
            </div>
            <div class="fg">
              <label>Tahun Rilis</label>
              <input type="date" name="tahun" id="inp_tahun" value="{{ old('tahun', $film->tahun) }}">
            </div>
          </div>

          {{-- Rating & Durasi --}}
          <div class="form-row-2">
            <div class="fg">
              <label>Rating (010)</label>
              <input type="number" name="rating" id="inp_rating" step="0.1" min="0" max="10" placeholder="8.5" value="{{ old('rating', $film->rating) }}">
            </div>
            <div class="fg">
              <label>Durasi</label>
              <input type="text" name="durasi" id="inp_durasi" placeholder="1 Jam 45 Menit" value="{{ old('durasi', $film->durasi) }}">
            </div>
          </div>

          {{-- Upload Poster --}}
          <div class="form-row-2">
            <div class="fg">
              <label>Upload Poster / URL</label>
              <input type="text" name="thumbnail" id="inp_thumbnail" placeholder="https://... atau pilih file" value="{{ old('thumbnail', $film->thumbnail ? asset($film->thumbnail) : '') }}">
              <div style="margin-top:.5rem">
                <div class="upload-box" style="padding:.8rem;text-align:left;display:flex;align-items:center;gap:.7rem">
                  <input type="file" accept="image/*" name="thumbnail_file" onchange="previewPoster(this)">
                  <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                  <span style="font-size:.82rem;color:rgba(255,255,255,.5);">Pilih Gambar</span>
                </div>
                <div class="ub-hint" style="margin-top:.3rem">JPG, PNG kurang dari 2MB</div>
              </div>
            </div>
            <div class="fg">
              <label>Upload Video / URL</label>
              <input type="text" name="video" id="inp_video" placeholder="https://youtube.com/..." value="{{ old('video', $film->video) }}">
              <div style="margin-top:.5rem">
                <div class="video-upload-box">
                  <div class="video-file-info" id="videoFileInfo" style="display:none">
                    <div class="video-file-icon">
                      <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg>
                    </div>
                    <div>
                      <div class="video-file-name" id="videoFileName"></div>
                      <div class="video-file-size" id="videoFileSize"></div>
                    </div>
                  </div>
                  <label class="btn-upload-video">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                    Unggah Video
                    <input type="file" name="video_file" accept="video/*" onchange="handleVideoFile(this)">
                  </label>
                </div>
              </div>
            </div>
          </div>

          {{-- Subtitle --}}
          <div class="fg">
            <label>Subtitle URL <span style="font-size:.72rem;color:rgba(255,255,255,.3);text-transform:none;">(opsional)</span></label>
            <input type="text" name="subtitle" placeholder="https://..." value="{{ old('subtitle', $film->subtitle) }}">
          </div>

          {{-- Actions --}}
          <div class="form-actions">
            <button type="reset" class="btn-reset" onclick="resetForm()">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.5"/></svg>
              Reset
            </button>
            <button type="submit" class="btn-save">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
              Update Film
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>

  {{-- ===== RIGHT: PREVIEW ===== --}}
  <div>
    <div class="panel" style="margin-bottom:1.5rem">
      <div class="panel-title"> Preview Film</div>

      {{-- Poster preview --}}
      <div style="position:relative">
        <div class="preview-poster-wrap" id="previewPosterWrap">
          <img id="previewPosterImg" class="preview-poster-img" src="" alt="">
          <div class="preview-poster-overlay">
            <div class="preview-title" id="prev_title">Judul Film</div>
            <div class="preview-genres" id="prev_genres_overlay"></div>
          </div>
        </div>
      </div>

      <div class="preview-info">
        <div class="preview-info-title" id="prev_title2">Judul Film</div>
        <div class="preview-genre-row" id="prev_genre_row">
          <span style="font-size:.78rem;color:rgba(255,255,255,.25);">Belum ada genre</span>
        </div>
        <p class="preview-desc" id="prev_desc">Deskripsi film akan muncul di sini...</p>
        <div class="preview-meta">Sutradara: <span id="prev_sutradara"></span></div>
        <div class="preview-meta">Aktor: <span id="prev_aktor"></span></div>
        <div class="preview-meta">Rilis: <span id="prev_tahun"></span> &nbsp;|&nbsp; Durasi: <span id="prev_durasi"></span></div>
      </div>
      <div class="preview-actions">
        <button class="btn-preview-edit" type="button"> Edit</button>
        <button class="btn-preview-del" type="button"> Hapus</button>
      </div>
    </div>

    {{-- Video preview --}}
    <div class="panel">
      <div class="panel-title"> Video Preview</div>
      <div style="padding:1rem">
        <div class="video-preview-wrap" id="videoPreviewWrap">
          <div class="video-preview-placeholder" id="videoPlaceholder">
            <div class="vp-icon"></div>
            <span>Video belum dipilih</span>
          </div>
          <video id="videoPreviewEl" style="display:none;width:100%;height:100%;object-fit:cover" controls></video>
          <iframe id="videoPreviewIframe" style="display:none;width:100%;height:100%;border:none" allowfullscreen></iframe>
        </div>
      </div>
      <div class="preview-actions">
        <button class="btn-preview-edit" type="button"> Edit</button>
        <button class="btn-preview-del" type="button"> Hapus</button>
      </div>
    </div>
  </div>

</div>
@endsection

@push('scripts')
<script>
// ===== LIVE PREVIEW =====
function liveUpdate() {
  const judul = document.getElementById('inp_judul').value || 'Judul Film';
  const desc  = document.getElementById('inp_deskripsi').value || 'Deskripsi film akan muncul di sini...';
  const sut   = document.getElementById('inp_sutradara').value || '';
  const dur   = document.getElementById('inp_durasi').value || '';
  const rat   = document.getElementById('inp_rating').value;
  const thn   = document.getElementById('inp_tahun').value;

  document.getElementById('prev_title').textContent  = judul;
  document.getElementById('prev_title2').textContent = judul;
  document.getElementById('prev_desc').textContent   = desc;
  document.getElementById('prev_sutradara').textContent = sut;
  document.getElementById('prev_durasi').textContent = dur;
  document.getElementById('prev_tahun').textContent  = thn ? new Date(thn).getFullYear() : '';

  // Rating badge
  const genreRow = document.getElementById('prev_genre_row');
  const existingRat = genreRow.querySelector('.preview-rating-badge');
  if (existingRat) existingRat.remove();
  if (rat) {
    const rb = document.createElement('span');
    rb.className = 'preview-rating-badge';
    rb.textContent = ' ' + parseFloat(rat).toFixed(1);
    genreRow.appendChild(rb);
  }
}

['inp_judul','inp_deskripsi','inp_sutradara','inp_durasi','inp_rating','inp_tahun'].forEach(function(id) {
  const el = document.getElementById(id);
  if (el) el.addEventListener('input', liveUpdate);
});

// ===== GENRE MULTI-SELECT =====
const selectedGenres = {!! $film->genres->pluck('genre', 'id_genre')->toJson() !!};
function toggleGenreDropdown() {
  document.getElementById('genreDropdown').classList.toggle('open');
}
function toggleGenre(el) {
  const id   = el.dataset.id;
  const name = el.dataset.name;
  if (selectedGenres[id]) {
    delete selectedGenres[id];
    el.classList.remove('selected');
  } else {
    selectedGenres[id] = name;
    el.classList.add('selected');
  }
  renderGenreChips();
  renderGenreInputs();
  updateGenrePreview();
}
function renderGenreChips() {
  const wrap = document.getElementById('genreChips');
  const ph   = document.getElementById('genrePlaceholder');
  wrap.innerHTML = '';
  const keys = Object.keys(selectedGenres);
  ph.style.display = keys.length ? 'none' : 'inline';
  keys.forEach(function(id) {
    const chip = document.createElement('span');
    chip.className = 'genre-tag-chip';
    chip.innerHTML = selectedGenres[id] + ' <button type="button" onclick="removeGenre(' + id + ')"></button>';
    wrap.appendChild(chip);
  });
}
function removeGenre(id) {
  delete selectedGenres[id];
  const opt = document.querySelector('.genre-option[data-id="' + id + '"]:not([data-actor])');
  if (opt) opt.classList.remove('selected');
  renderGenreChips(); renderGenreInputs(); updateGenrePreview();
}
function renderGenreInputs() {
  const wrap = document.getElementById('genreInputs');
  wrap.innerHTML = '';
  Object.keys(selectedGenres).forEach(function(id) {
    const inp = document.createElement('input');
    inp.type = 'hidden'; inp.name = 'genres[]'; inp.value = id;
    wrap.appendChild(inp);
  });
}
function updateGenrePreview() {
  const overlay = document.getElementById('prev_genres_overlay');
  const row     = document.getElementById('prev_genre_row');
  overlay.innerHTML = ''; row.innerHTML = '';
  const keys = Object.keys(selectedGenres);
  if (!keys.length) {
    row.innerHTML = '<span style="font-size:.78rem;color:rgba(255,255,255,.25);">Belum ada genre</span>';
    return;
  }
  keys.forEach(function(id) {
    const p1 = document.createElement('span');
    p1.className = 'preview-genre-pill'; p1.textContent = selectedGenres[id];
    overlay.appendChild(p1);
    const p2 = document.createElement('span');
    p2.className = 'preview-genre-badge'; p2.textContent = selectedGenres[id];
    row.appendChild(p2);
  });
  const rat = document.getElementById('inp_rating').value;
  if (rat) {
    const rb = document.createElement('span');
    rb.className = 'preview-rating-badge';
    rb.textContent = ' ' + parseFloat(rat).toFixed(1);
    row.appendChild(rb);
  }
}

// ===== ACTOR MULTI-SELECT =====
const selectedActors = {!! $film->actors->pluck('namaaktor', 'id_aktor')->toJson() !!};
function toggleActorDropdown() {
  document.getElementById('actorDropdown').classList.toggle('open');
}
function toggleActor(el) {
  const id   = el.dataset.id;
  const name = el.dataset.name;
  if (selectedActors[id]) {
    delete selectedActors[id];
    el.classList.remove('selected');
  } else {
    selectedActors[id] = name;
    el.classList.add('selected');
  }
  renderActorChips(); renderActorInputs(); updateActorPreview();
}
function renderActorChips() {
  const wrap = document.getElementById('actorChips');
  const ph   = document.getElementById('actorPlaceholder');
  wrap.innerHTML = '';
  const keys = Object.keys(selectedActors);
  ph.style.display = keys.length ? 'none' : 'inline';
  keys.forEach(function(id) {
    const chip = document.createElement('span');
    chip.className = 'genre-tag-chip';
    chip.innerHTML = selectedActors[id] + ' <button type="button" onclick="removeActor(' + id + ')"></button>';
    wrap.appendChild(chip);
  });
}
function removeActor(id) {
  delete selectedActors[id];
  const opt = document.querySelector('#actorDropdown .genre-option[data-id="' + id + '"');
  if (opt) opt.classList.remove('selected');
  renderActorChips(); renderActorInputs(); updateActorPreview();
}
function renderActorInputs() {
  const wrap = document.getElementById('actorInputs');
  wrap.innerHTML = '';
  Object.keys(selectedActors).forEach(function(id) {
    const inp = document.createElement('input');
    inp.type = 'hidden'; inp.name = 'actors[]'; inp.value = id;
    wrap.appendChild(inp);
  });
}
function updateActorPreview() {
  const names = Object.values(selectedActors).join(', ');
  document.getElementById('prev_aktor').textContent = names || '';
}

// ===== POSTER PREVIEW =====
function previewPoster(input) {
  if (!input.files || !input.files[0]) return;
  const reader = new FileReader();
  reader.onload = function(e) {
    const img = document.getElementById('previewPosterImg');
    img.src = e.target.result;
    img.classList.add('show');
    document.getElementById('inp_thumbnail').value = '';
  };
  reader.readAsDataURL(input.files[0]);
}
function convertDriveThumbnailUrl(url) {
  if (url && url.includes('drive.google.com')) {
    let driveId = '';
    const m1 = url.match(/\/d\/([a-zA-Z0-9_-]+)/);
    const m2 = url.match(/[?&]id=([a-zA-Z0-9_-]+)/);
    if (m1) driveId = m1[1];
    else if (m2) driveId = m2[1];
    if (driveId) {
      return 'https://lh3.googleusercontent.com/d/' + driveId;
    }
  }
  return url;
}
document.getElementById('inp_thumbnail').addEventListener('input', function() {
  const url = this.value.trim();
  const img = document.getElementById('previewPosterImg');
  if (url) { img.src = convertDriveThumbnailUrl(url); img.classList.add('show'); }
  else { img.classList.remove('show'); }
});

// ===== VIDEO PREVIEW =====
function handleVideoFile(input) {
  if (!input.files || !input.files[0]) return;
  const file = input.files[0];
  const size = (file.size / 1024 / 1024).toFixed(1) + ' MB';
  document.getElementById('videoFileName').textContent = file.name;
  document.getElementById('videoFileSize').textContent = size;
  document.getElementById('videoFileInfo').style.display = 'flex';
  const url = URL.createObjectURL(file);
  showVideoPreview('file', url);
}
document.getElementById('inp_video').addEventListener('input', function() {
  const url = this.value.trim();
  if (!url) { hideVideoPreview(); return; }
  if (url.includes('youtube.com') || url.includes('youtu.be')) {
    const m = url.match(/(?:v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/);
    if (m) showVideoPreview('iframe', 'https://www.youtube.com/embed/' + m[1]);
  } else if (url.includes('drive.google.com')) {
    let driveId = '';
    const m1 = url.match(/\/d\/([a-zA-Z0-9_-]+)/);
    const m2 = url.match(/[?&]id=([a-zA-Z0-9_-]+)/);
    if (m1) driveId = m1[1];
    else if (m2) driveId = m2[1];
    if (driveId) showVideoPreview('iframe', 'https://drive.google.com/file/d/' + driveId + '/preview');
    else hideVideoPreview();
  } else {
    showVideoPreview('file', url);
  }
});
function showVideoPreview(type, src) {
  document.getElementById('videoPlaceholder').style.display = 'none';
  if (type === 'iframe') {
    document.getElementById('videoPreviewEl').style.display = 'none';
    const iframe = document.getElementById('videoPreviewIframe');
    iframe.src = src; iframe.style.display = 'block';
  } else {
    document.getElementById('videoPreviewIframe').style.display = 'none';
    const vid = document.getElementById('videoPreviewEl');
    vid.src = src; vid.style.display = 'block';
  }
}
function hideVideoPreview() {
  document.getElementById('videoPlaceholder').style.display = 'flex';
  document.getElementById('videoPreviewEl').style.display = 'none';
  document.getElementById('videoPreviewIframe').style.display = 'none';
}

// ===== RESET =====
function resetForm() {
  Object.keys(selectedGenres).forEach(function(k) { delete selectedGenres[k]; });
  Object.keys(selectedActors).forEach(function(k) { delete selectedActors[k]; });
  renderGenreChips(); renderGenreInputs(); updateGenrePreview();
  renderActorChips(); renderActorInputs(); updateActorPreview();
  document.querySelectorAll('.genre-option').forEach(function(o) { o.classList.remove('selected'); });
  document.getElementById('previewPosterImg').classList.remove('show');
  hideVideoPreview();
  liveUpdate();
}

// Close dropdowns on outside click
document.addEventListener('click', function(e) {
  if (!e.target.closest('#genreTagsInput') && !e.target.closest('#genreDropdown'))
    document.getElementById('genreDropdown').classList.remove('open');
  if (!e.target.closest('#actorTagsInput') && !e.target.closest('#actorDropdown'))
    document.getElementById('actorDropdown').classList.remove('open');
});

// Initialize UI on load
window.addEventListener('DOMContentLoaded', function() {
  renderGenreChips(); renderGenreInputs(); updateGenrePreview();
  renderActorChips(); renderActorInputs(); updateActorPreview();
  
  // Highlight selected options in dropdown
  Object.keys(selectedGenres).forEach(function(id) {
    const opt = document.querySelector('.genre-dropdown-menu .genre-option[data-id="' + id + '"]:not([data-actor])');
    if (opt) opt.classList.add('selected');
  });
  Object.keys(selectedActors).forEach(function(id) {
    const opt = document.querySelector('#actorDropdown .genre-option[data-id="' + id + '"]');
    if (opt) opt.classList.add('selected');
  });

  // Trigger preview update
  liveUpdate();
  
  // Poster preview init
  const posterUrl = document.getElementById('inp_thumbnail').value;
  if (posterUrl) {
    const img = document.getElementById('previewPosterImg');
    img.src = convertDriveThumbnailUrl(posterUrl);
    img.classList.add('show');
  }
  
  // Video preview init
  const videoUrl = document.getElementById('inp_video').value;
  if (videoUrl) {
    document.getElementById('inp_video').dispatchEvent(new Event('input'));
  }
});
</script>
@endpush
