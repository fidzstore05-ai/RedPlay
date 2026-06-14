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
.btn-add { display:inline-flex; align-items:center; gap:.5rem; background:linear-gradient(135deg,#e50914,#c8000f); color:#fff; border:none; padding:.65rem 1.3rem; border-radius:9px; font-weight:600; font-size:.88rem; cursor:pointer; font-family:Outfit,sans-serif; transition:all .2s; box-shadow:0 4px 15px rgba(229,9,20,.3); text-decoration: none; }
.btn-add:hover { transform:translateY(-1px); box-shadow:0 6px 20px rgba(229,9,20,.45); }
.table-wrap { background:#1a1a1a; border:1px solid rgba(255,255,255,.06); border-radius:14px; overflow-x:auto; -webkit-overflow-scrolling:touch; }
.table-wrap::-webkit-scrollbar { height: 6px; }
.table-wrap::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.02); border-radius: 0 0 14px 14px; }
.table-wrap::-webkit-scrollbar-thumb { background: rgba(229, 9, 20, 0.35); border-radius: 3px; }
.table-wrap::-webkit-scrollbar-thumb:hover { background: rgba(229, 9, 20, 0.6); }
table { width:100%; border-collapse:collapse; }
thead tr { background:rgba(255,255,255,.04); }
th { padding:1rem 1.2rem; font-size:.78rem; text-transform:uppercase; letter-spacing:.5px; color:rgba(255,255,255,.4); font-weight:600; text-align:left; white-space:nowrap; }
tbody tr { border-top:1px solid rgba(255,255,255,.04); transition:background .15s; }
tbody tr:hover { background:rgba(255,255,255,.03); }
td { padding:.9rem 1.2rem; font-size:.88rem; vertical-align:middle; color:#fff; }
.action-btns { display:flex; gap:.5rem; }
.btn-edit { background:rgba(59,130,246,.15); border:1px solid rgba(59,130,246,.3); color:#60a5fa; padding:.35rem .8rem; border-radius:7px; font-size:.78rem; font-weight:600; cursor:pointer; font-family:Outfit,sans-serif; transition:all .2s; text-decoration:none; display:inline-block; }
.btn-edit:hover { background:rgba(59,130,246,.25); color:#93c5fd; }
.btn-del { background:rgba(229,9,20,.12); border:1px solid rgba(229,9,20,.3); color:#ff6b6b; padding:.35rem .8rem; border-radius:7px; font-size:.78rem; font-weight:600; cursor:pointer; font-family:Outfit,sans-serif; transition:all .2s; }
.btn-del:hover { background:rgba(229,9,20,.25); color:#fca5a5; }
.pagination-wrap { padding:1.2rem 1.5rem; border-top:1px solid rgba(255,255,255,.05); }
.alert { padding:.8rem 1rem; border-radius:9px; margin-bottom:1.5rem; font-size:.88rem; }
.alert-success { background:rgba(34,197,94,.12); border:1px solid rgba(34,197,94,.3); color:#86efac; }
.alert-danger { background:rgba(229,9,20,.12); border:1px solid rgba(229,9,20,.3); color:#ff6b6b; }

/* ===== RESPONSIVE ADMIN DASHBOARD ===== */
@media (max-width: 768px) {
    .admin-wrap {
        grid-template-columns: 1fr;
        margin: -2rem -5%;
    }
    .admin-sidebar {
        border-right: none;
        border-bottom: 1px solid rgba(255,255,255,0.06);
        padding: 1rem 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        background: #0a0a0a;
    }
    .sidebar-logo {
        border-bottom: none;
        padding: 0;
        margin-bottom: 0.5rem;
        text-align: center;
    }
    .sidebar-menu {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        gap: 0.4rem;
        padding-bottom: 0.4rem;
        width: 100%;
        scrollbar-width: none;
    }
    .sidebar-menu::-webkit-scrollbar {
        display: none;
    }
    .sidebar-menu li {
        display: inline-block;
        flex-shrink: 0;
    }
    .sidebar-menu li a {
        padding: 0.6rem 0.8rem;
        border-radius: 8px;
        font-size: 0.72rem;
        flex-direction: column;
        align-items: center;
        gap: 0.25rem;
        min-width: 65px;
        text-align: center;
    }
    .sidebar-menu li a svg {
        width: 20px;
        height: 20px;
    }
    .sidebar-menu li a:hover, .sidebar-menu li a.active {
        border-right: none;
        background: rgba(229,9,20,0.15);
    }
    .admin-main {
        padding: 1.5rem;
    }
    .admin-topbar {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    .admin-topbar .btn-add {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 600px) {
    .table-wrap {
        background: transparent;
        border: none;
    }
    .table-wrap table, 
    .table-wrap table tbody, 
    .table-wrap table tr, 
    .table-wrap table td {
        display: block;
        width: 100%;
        box-sizing: border-box;
    }
    .table-wrap table thead {
        display: none;
    }
    .table-wrap table tbody {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        padding: 0;
    }
    .table-wrap table tr {
        background: #1a1a1a;
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 14px;
        padding: 1.2rem;
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }
    .col-id {
        display: none !important;
    }
    .col-name {
        padding: 0 !important;
        font-size: 1.1rem;
        font-weight: 700;
        color: #fff;
    }
    .col-count {
        padding: 0 !important;
        font-size: 0.85rem;
        color: rgba(255,255,255,0.5);
    }
    .col-actions {
        padding: 0.75rem 0 0 0 !important;
        border-top: 1px solid rgba(255, 255, 255, 0.06);
        margin-top: 0.4rem;
    }
    .col-actions .action-btns {
        display: flex;
        gap: 0.5rem;
    }
    .col-actions .action-btns a, 
    .col-actions .action-btns form {
        flex: 1;
    }
    .col-actions .action-btns button,
    .col-actions .action-btns a {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        box-sizing: border-box;
    }
}
</style>
@endpush

@section('content')
<div class="admin-wrap">

  {{-- SIDEBAR --}}
  <aside class="admin-sidebar">
    <div class="sidebar-logo">FILM<span>APP</span> <span style="font-size:.7rem;color:rgba(255,255,255,.3);font-weight:400;">Admin</span></div>
    <ul class="sidebar-menu">
      <li>
        <a href="{{ route('films.manage') }}">
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
        <a href="{{ route('genres.manage') }}">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
          Genre
        </a>
      </li>
      <li>
        <a href="{{ route('actors.manage') }}" class="active">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
          Aktor
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

    <div class="admin-topbar">
      <h1>Manajemen Aktor</h1>
      <a href="{{ route('actors.create') }}" class="btn-add">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
        Tambah Aktor
      </a>
    </div>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nama Aktor</th>
            <th>Jumlah Film</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($actors as $a)
          <tr>
            <td class="col-id" style="color:rgba(255,255,255,.3);font-size:.8rem;">{{ $a->id_aktor }}</td>
            <td class="col-name" style="font-weight:600;">{{ $a->namaaktor }}</td>
            <td class="col-count" style="color:rgba(255,255,255,.5);">{{ $a->films_count ?? 0 }} Film</td>
            <td class="col-actions">
              <div class="action-btns">
                <a href="{{ route('actors.edit', $a->id_aktor) }}" class="btn-edit"> Edit</a>
                <form action="{{ route('actors.destroy', $a->id_aktor) }}" method="POST" onsubmit="return confirm('Hapus aktor ini?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn-del"> Hapus</button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="4" style="text-align:center;padding:3rem;color:rgba(255,255,255,.3);">Tidak ada aktor ditemukan</td>
          </tr>
          @endforelse
        </tbody>
      </table>
      @if(method_exists($actors, 'links'))
        <div class="pagination-wrap">{{ $actors->links() }}</div>
      @endif
    </div>

  </div>
</div>
@endsection
