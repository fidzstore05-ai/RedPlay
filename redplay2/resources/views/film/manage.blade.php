@extends('layouts.app')

@push('styles')
<style>
:root { --primary:#e50914; --dark:#121212; --secondary:#1f1f1f; }
.admin-wrap { display:grid; grid-template-columns:220px 1fr; min-height:calc(100vh - 62px); margin:-2rem -5%; }
.admin-sidebar { background:#0d0d0d; border-right:1px solid rgba(255,255,255,0.06); padding:1.5rem 0; }
.sidebar-logo { padding:0 1.5rem 1.5rem; font-size:1.1rem; font-weight:700; color:#e50914; border-bottom:1px solid rgba(255,255,255,0.06); margin-bottom:1rem; }
.sidebar-logo span { color:#fff; }
.sidebar-menu { list-style:none; margin:0; padding:0; }
.sidebar-menu li a { display:flex; align-items:center; gap:.7rem; padding:.7rem 1.5rem; font-size:.88rem; color:rgba(255,255,255,.55); transition:all .2s; }
.sidebar-menu li a:hover,.sidebar-menu li a.active { color:#fff; background:rgba(229,9,20,.12); border-right:3px solid #e50914; }
.sidebar-menu li a svg { flex-shrink:0; }
.admin-main { padding:2rem 2.5rem; background:#111; }
.admin-topbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:2rem; }
.admin-topbar h1 { font-size:1.5rem; font-weight:700; }
.btn-add { display:inline-flex; align-items:center; gap:.5rem; background:linear-gradient(135deg,#e50914,#c8000f); color:#fff; border:none; padding:.65rem 1.3rem; border-radius:9px; font-weight:600; font-size:.88rem; cursor:pointer; font-family:Outfit,sans-serif; transition:all .2s; box-shadow:0 4px 15px rgba(229,9,20,.3); }
.btn-add:hover { transform:translateY(-1px); box-shadow:0 6px 20px rgba(229,9,20,.45); }
.stats-row { display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; margin-bottom:2rem; }
.stat-card { background:#1a1a1a; border:1px solid rgba(255,255,255,.06); border-radius:12px; padding:1.2rem 1.5rem; }
.stat-card .s-num { font-size:1.8rem; font-weight:700; color:#e50914; }
.stat-card .s-lbl { font-size:.78rem; color:rgba(255,255,255,.4); text-transform:uppercase; letter-spacing:.5px; margin-top:.2rem; }
.search-bar-admin { display:flex; gap:.8rem; margin-bottom:1.5rem; }
.search-bar-admin input { flex:1; background:#1a1a1a; border:1px solid rgba(255,255,255,.08); border-radius:9px; color:#fff; font-family:Outfit,sans-serif; font-size:.88rem; padding:.65rem 1rem; outline:none; transition:border-color .2s; }
.search-bar-admin input:focus { border-color:rgba(229,9,20,.4); }
.search-bar-admin button { background:#1a1a1a; border:1px solid rgba(255,255,255,.08); color:rgba(255,255,255,.6); border-radius:9px; padding:.65rem 1.2rem; cursor:pointer; font-family:Outfit,sans-serif; font-size:.85rem; transition:all .2s; }
.search-bar-admin button:hover { border-color:rgba(229,9,20,.4); color:#fff; }
.table-wrap { background:#1a1a1a; border:1px solid rgba(255,255,255,.06); border-radius:14px; overflow:hidden; }
table { width:100%; border-collapse:collapse; }
thead tr { background:rgba(255,255,255,.04); }
th { padding:1rem 1.2rem; font-size:.78rem; text-transform:uppercase; letter-spacing:.5px; color:rgba(255,255,255,.4); font-weight:600; text-align:left; white-space:nowrap; }
tbody tr { border-top:1px solid rgba(255,255,255,.04); transition:background .15s; }
tbody tr:hover { background:rgba(255,255,255,.03); }
td { padding:.9rem 1.2rem; font-size:.88rem; vertical-align:middle; }
.td-poster { width:44px; height:60px; object-fit:cover; border-radius:6px; background:#222; display:block; }
.td-poster-ph { width:44px; height:60px; background:linear-gradient(135deg,#1a1a2e,#0f3460); border-radius:6px; display:flex; align-items:center; justify-content:center; font-size:1.2rem; }
.td-title { font-weight:600; color:#fff; max-width:200px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.td-rating { color:#f5c518; font-weight:700; }
.genre-pill-sm { display:inline-block; background:rgba(229,9,20,.12); border:1px solid rgba(229,9,20,.25); color:#ff6b6b; padding:.15rem .5rem; border-radius:10px; font-size:.7rem; margin:.1rem; }
.action-btns { display:flex; gap:.5rem; }
.btn-edit { background:rgba(59,130,246,.15); border:1px solid rgba(59,130,246,.3); color:#60a5fa; padding:.35rem .8rem; border-radius:7px; font-size:.78rem; font-weight:600; cursor:pointer; font-family:Outfit,sans-serif; transition:all .2s; }
.btn-edit:hover { background:rgba(59,130,246,.25); color:#93c5fd; }
.btn-del { background:rgba(229,9,20,.12); border:1px solid rgba(229,9,20,.3); color:#ff6b6b; padding:.35rem .8rem; border-radius:7px; font-size:.78rem; font-weight:600; cursor:pointer; font-family:Outfit,sans-serif; transition:all .2s; }
.btn-del:hover { background:rgba(229,9,20,.25); color:#fca5a5; }
.pagination-wrap { padding:1.2rem 1.5rem; border-top:1px solid rgba(255,255,255,.05); }
/* MODAL */
.modal-bg { display:none; position:fixed; inset:0; background:rgba(0,0,0,.75); z-index:2000; align-items:center; justify-content:center; backdrop-filter:blur(4px); }
.modal-bg.open { display:flex; }
.modal { background:#1a1a1a; border:1px solid rgba(255,255,255,.08); border-radius:18px; width:100%; max-width:640px; max-height:90vh; overflow-y:auto; box-shadow:0 30px 80px rgba(0,0,0,.7); }
.modal-header { display:flex; justify-content:space-between; align-items:center; padding:1.5rem 2rem; border-bottom:1px solid rgba(255,255,255,.06); position:sticky; top:0; background:#1a1a1a; z-index:1; }
.modal-header h2 { font-size:1.1rem; font-weight:700; }
.modal-close { background:none; border:none; color:rgba(255,255,255,.4); font-size:1.4rem; cursor:pointer; line-height:1; padding:.2rem .5rem; border-radius:6px; transition:all .2s; }
.modal-close:hover { color:#fff; background:rgba(255,255,255,.08); }
.modal-body { padding:1.5rem 2rem 2rem; }
.form-row { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
.form-group { margin-bottom:1.2rem; }
.form-group label { display:block; font-size:.8rem; color:rgba(255,255,255,.5); margin-bottom:.4rem; font-weight:600; text-transform:uppercase; letter-spacing:.4px; }
.form-group input,.form-group textarea,.form-group select { width:100%; background:#111; border:1px solid rgba(255,255,255,.1); border-radius:9px; color:#fff; font-family:Outfit,sans-serif; font-size:.9rem; padding:.75rem 1rem; outline:none; transition:border-color .2s; box-sizing:border-box; }
.form-group input:focus,.form-group textarea:focus,.form-group select:focus { border-color:rgba(229,9,20,.5); background:#150808; }
.form-group textarea { resize:vertical; min-height:90px; }
.form-group select option { background:#1a1a1a; }
.checkbox-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:.5rem; }
.checkbox-item { display:flex; align-items:center; gap:.5rem; background:#111; border:1px solid rgba(255,255,255,.08); border-radius:8px; padding:.5rem .7rem; cursor:pointer; transition:all .2s; }
.checkbox-item:hover { border-color:rgba(229,9,20,.3); }
.checkbox-item input[type=checkbox] { accent-color:#e50914; width:14px; height:14px; }
.checkbox-item label { font-size:.82rem; color:rgba(255,255,255,.7); cursor:pointer; }
.modal-footer { display:flex; justify-content:flex-end; gap:.8rem; padding-top:1rem; border-top:1px solid rgba(255,255,255,.06); margin-top:1rem; }
.btn-cancel { background:transparent; border:1px solid rgba(255,255,255,.15); color:rgba(255,255,255,.6); padding:.65rem 1.3rem; border-radius:9px; font-weight:600; font-size:.88rem; cursor:pointer; font-family:Outfit,sans-serif; transition:all .2s; }
.btn-cancel:hover { border-color:rgba(255,255,255,.35); color:#fff; }
.btn-save { background:linear-gradient(135deg,#e50914,#c8000f); color:#fff; border:none; padding:.65rem 1.5rem; border-radius:9px; font-weight:700; font-size:.88rem; cursor:pointer; font-family:Outfit,sans-serif; transition:all .2s; box-shadow:0 4px 15px rgba(229,9,20,.3); }
.btn-save:hover { transform:translateY(-1px); box-shadow:0 6px 20px rgba(229,9,20,.45); }
.alert { padding:.8rem 1rem; border-radius:9px; margin-bottom:1.5rem; font-size:.88rem; }
.alert-success { background:rgba(34,197,94,.12); border:1px solid rgba(34,197,94,.3); color:#86efac; }
.alert-danger { background:rgba(229,9,20,.12); border:1px solid rgba(229,9,20,.3); color:#ff6b6b; }
</style>
@endpush

@section('content')
<div class="admin-wrap">

  {{-- SIDEBAR --}}
  <aside class="admin-sidebar">
    <div class="sidebar-logo">FILM<span>APP</span> <span style="font-size:.7rem;color:rgba(255,255,255,.3);font-weight:400;">Admin</span></div>
    <ul class="sidebar-menu">
      <li>
        <a href="{{ route('films.manage') }}" class="active">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="15" rx="2"/><path d="M16 3H8L2 7h20l-6-4z"/></svg>
          Film
        </a>
      </li>
      <li>
        <a href="{{ route('films.create') }}">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
          Tambah Film
        </a>
      </li>
      <li>
        <a href="{{ route('films.index') }}">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
          Lihat Situs
        </a>
      </li>
    </ul>
  </aside>

  {{-- MAIN --}}
  <div class="admin-main">

    {{-- Topbar --}}
    <div class="admin-topbar">
      <h1>Manajemen Film</h1>
      <button class="btn-add" onclick="window.location='{{ route('films.create') }}'">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
        Tambah Film
      </button>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Stats --}}
    <div class="stats-row">
      <div class="stat-card">
        <div class="s-num">{{ $films->total() }}</div>
        <div class="s-lbl">Total Film</div>
      </div>
      <div class="stat-card">
        <div class="s-num">{{ $genres->count() }}</div>
        <div class="s-lbl">Genre</div>
      </div>
      <div class="stat-card">
        <div class="s-num">{{ $actors->count() }}</div>
        <div class="s-lbl">Aktor</div>
      </div>
      <div class="stat-card">
        <div class="s-num">{{ \App\Models\User::count() }}</div>
        <div class="s-lbl">Pengguna</div>
      </div>
    </div>

    {{-- Search --}}
    <form class="search-bar-admin" method="GET" action="{{ route('films.manage') }}">
      <input type="text" name="q" placeholder="Cari judul film..." value="{{ request('q') }}">
      <button type="submit"> Cari</button>
      @if(request('q'))
        <a href="{{ route('films.manage') }}" style="display:flex;align-items:center;padding:.65rem 1rem;background:#1a1a1a;border:1px solid rgba(255,255,255,.08);border-radius:9px;color:rgba(255,255,255,.5);font-size:.85rem;text-decoration:none;"> Reset</a>
      @endif
    </form>

    {{-- Table --}}
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Poster</th>
            <th>Judul</th>
            <th>Genre</th>
            <th>Rating</th>
            <th>Tahun</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($films as $film)
          <tr>
            <td style="color:rgba(255,255,255,.3);font-size:.8rem;">{{ $film->id_film }}</td>
            <td>
              @if($film->thumbnail)
                <img src="{{ $film->thumbnail }}" class="td-poster" alt="">
              @else
                <div class="td-poster-ph"></div>
              @endif
            </td>
            <td>
              <div class="td-title">{{ $film->judul }}</div>
              @if($film->video)
                <span style="font-size:.7rem;color:#4ade80;"> Video</span>
              @else
                <span style="font-size:.7rem;color:rgba(255,255,255,.2);"> No video</span>
              @endif
            </td>
            <td>
              @foreach($film->genres->take(3) as $g)
                <span class="genre-pill-sm">{{ $g->genre }}</span>
              @endforeach
            </td>
            <td class="td-rating">{{ $film->rating ? ' '.$film->rating : '' }}</td>
            <td style="color:rgba(255,255,255,.5);">{{ $film->tahun ? \Carbon\Carbon::parse($film->tahun)->year : '' }}</td>
            <td>
              <div class="action-btns">
                <button class="btn-edit" onclick="openEdit({{ $film->id_film }})"> Edit</button>
                <form action="{{ route('films.destroy', $film->id_film) }}" method="POST" onsubmit="return confirm('Hapus film ini?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn-del"> Hapus</button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" style="text-align:center;padding:3rem;color:rgba(255,255,255,.3);">Tidak ada film ditemukan</td>
          </tr>
          @endforelse
        </tbody>
      </table>
      <div class="pagination-wrap">{{ $films->links() }}</div>
    </div>

  </div>{{-- /admin-main --}}
</div>{{-- /admin-wrap --}}

{{-- ===== ADD MODAL ===== --}}
<div class="modal-bg" id="addModal">
  <div class="modal">
    <div class="modal-header">
      <h2> Tambah Film Baru</h2>
      <button class="modal-close" onclick="closeModal('addModal')"></button>
    </div>
    <div class="modal-body">
      <form action="{{ route('films.store') }}" method="POST">
        @csrf
        <div class="form-row">
          <div class="form-group" style="grid-column:1/-1">
            <label>Judul Film *</label>
            <input type="text" name="judul" required placeholder="Masukkan judul film">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Tahun Rilis</label>
            <input type="date" name="tahun">
          </div>
          <div class="form-group">
            <label>Rating (010)</label>
            <input type="number" name="rating" step="0.1" min="0" max="10" placeholder="8.5">
          </div>
        </div>
        <div class="form-group">
          <label>Thumbnail URL</label>
          <input type="text" name="thumbnail" placeholder="https://...">
        </div>
        <div class="form-group">
          <label>Video URL (YouTube / Drive / MP4)</label>
          <input type="text" name="video" placeholder="https://...">
        </div>
        <div class="form-group">
          <label>Subtitle URL</label>
          <input type="text" name="subtitle" placeholder="https://...">
        </div>
        <div class="form-group">
          <label>Deskripsi</label>
          <textarea name="deskripsi" placeholder="Sinopsis film..."></textarea>
        </div>
        <div class="form-group">
          <label>Genre</label>
          <div class="checkbox-grid">
            @foreach($genres as $g)
              <div class="checkbox-item">
                <input type="checkbox" name="genres[]" value="{{ $g->id_genre }}" id="ag_{{ $g->id_genre }}">
                <label for="ag_{{ $g->id_genre }}">{{ $g->genre }}</label>
              </div>
            @endforeach
          </div>
        </div>
        <div class="form-group">
          <label>Aktor</label>
          <div class="checkbox-grid">
            @foreach($actors as $a)
              <div class="checkbox-item">
                <input type="checkbox" name="actors[]" value="{{ $a->id_aktor }}" id="aa_{{ $a->id_aktor }}">
                <label for="aa_{{ $a->id_aktor }}">{{ $a->namaaktor }}</label>
              </div>
            @endforeach
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-cancel" onclick="closeModal('addModal')">Batal</button>
          <button type="submit" class="btn-save"> Simpan Film</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- ===== EDIT MODALS ===== --}}
@foreach($films as $film)
<div class="modal-bg" id="editModal_{{ $film->id_film }}">
  <div class="modal">
    <div class="modal-header">
      <h2> Edit Film</h2>
      <button class="modal-close" onclick="closeModal('editModal_{{ $film->id_film }}')"></button>
    </div>
    <div class="modal-body">
      <form action="{{ route('films.update', $film->id_film) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-row">
          <div class="form-group" style="grid-column:1/-1">
            <label>Judul Film *</label>
            <input type="text" name="judul" required value="{{ $film->judul }}">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Tahun Rilis</label>
            <input type="date" name="tahun" value="{{ $film->tahun }}">
          </div>
          <div class="form-group">
            <label>Rating (010)</label>
            <input type="number" name="rating" step="0.1" min="0" max="10" value="{{ $film->rating }}">
          </div>
        </div>
        <div class="form-group">
          <label>Thumbnail URL</label>
          <input type="text" name="thumbnail" value="{{ $film->thumbnail }}">
        </div>
        <div class="form-group">
          <label>Video URL</label>
          <input type="text" name="video" value="{{ $film->video }}">
        </div>
        <div class="form-group">
          <label>Subtitle URL</label>
          <input type="text" name="subtitle" value="{{ $film->subtitle }}">
        </div>
        <div class="form-group">
          <label>Deskripsi</label>
          <textarea name="deskripsi">{{ $film->deskripsi }}</textarea>
        </div>
        <div class="form-group">
          <label>Genre</label>
          <div class="checkbox-grid">
            @php $filmGenreIds = $film->genres->pluck('id_genre')->toArray(); @endphp
            @foreach($genres as $g)
              <div class="checkbox-item">
                <input type="checkbox" name="genres[]" value="{{ $g->id_genre }}" id="eg_{{ $film->id_film }}_{{ $g->id_genre }}"
                  {{ in_array($g->id_genre, $filmGenreIds) ? 'checked' : '' }}>
                <label for="eg_{{ $film->id_film }}_{{ $g->id_genre }}">{{ $g->genre }}</label>
              </div>
            @endforeach
          </div>
        </div>
        <div class="form-group">
          <label>Aktor</label>
          <div class="checkbox-grid">
            @php $filmActorIds = $film->actors->pluck('id_aktor')->toArray(); @endphp
            @foreach($actors as $a)
              <div class="checkbox-item">
                <input type="checkbox" name="actors[]" value="{{ $a->id_aktor }}" id="ea_{{ $film->id_film }}_{{ $a->id_aktor }}"
                  {{ in_array($a->id_aktor, $filmActorIds) ? 'checked' : '' }}>
                <label for="ea_{{ $film->id_film }}_{{ $a->id_aktor }}">{{ $a->namaaktor }}</label>
              </div>
            @endforeach
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-cancel" onclick="closeModal('editModal_{{ $film->id_film }}')">Batal</button>
          <button type="submit" class="btn-save"> Update Film</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

@endsection

@push('scripts')
<script>
function openModal(id) {
  document.getElementById(id).classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeModal(id) {
  document.getElementById(id).classList.remove('open');
  document.body.style.overflow = '';
}
function openEdit(id) {
  openModal('editModal_' + id);
}
// Close on backdrop click
document.querySelectorAll('.modal-bg').forEach(function(bg) {
  bg.addEventListener('click', function(e) {
    if (e.target === bg) closeModal(bg.id);
  });
});
// Close on Escape
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    document.querySelectorAll('.modal-bg.open').forEach(function(m) {
      closeModal(m.id);
    });
  }
});
</script>
@endpush
