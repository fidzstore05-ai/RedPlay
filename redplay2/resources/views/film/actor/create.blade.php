@extends('layouts.app')
@push('styles')
<style>
.create-wrap{display:grid;grid-template-columns:1fr;max-width:600px;margin:0 auto;gap:2rem;align-items:start}
.create-header{margin-bottom:2rem;text-align:center}
.create-header .welcome{font-size:1.5rem;font-weight:700;margin-bottom:.2rem}
.create-header .date{font-size:.82rem;color:rgba(255,255,255,.4)}
.panel{background:#1a1a1a;border:1px solid rgba(255,255,255,.07);border-radius:16px;overflow:hidden}
.panel-title{font-size:1.1rem;font-weight:700;padding:1.3rem 1.5rem;border-bottom:1px solid rgba(255,255,255,.06);display:flex;align-items:center;gap:.6rem}
.panel-body{padding:1.5rem}
.fg{margin-bottom:1.2rem}
.fg label{display:block;font-size:.78rem;font-weight:600;color:rgba(255,255,255,.45);text-transform:uppercase;letter-spacing:.5px;margin-bottom:.5rem}
.fg input{width:100%;background:#111;border:1px solid rgba(255,255,255,.1);border-radius:9px;color:#fff;font-family:Outfit,sans-serif;font-size:.9rem;padding:.75rem 1rem;outline:none;transition:border-color .2s,background .2s;box-sizing:border-box}
.fg input:focus{border-color:rgba(229,9,20,.5);background:#150808}
.fg input::placeholder{color:#444}
.form-actions{display:flex;gap:.8rem;margin-top:1.5rem;padding-top:1.5rem;border-top:1px solid rgba(255,255,255,.06)}
.btn-back{flex:1;background:transparent;border:1px solid rgba(255,255,255,.15);color:rgba(255,255,255,.6);padding:.75rem;border-radius:9px;font-weight:600;font-size:.9rem;cursor:pointer;font-family:Outfit,sans-serif;transition:all .2s;display:flex;align-items:center;justify-content:center;gap:.5rem;text-decoration:none}
.btn-back:hover{border-color:rgba(255,255,255,.35);color:#fff}
.btn-save{flex:2;background:linear-gradient(135deg,#e50914,#c8000f);color:#fff;border:none;padding:.75rem;border-radius:9px;font-weight:700;font-size:.9rem;cursor:pointer;font-family:Outfit,sans-serif;transition:all .2s;box-shadow:0 4px 15px rgba(229,9,20,.3);display:flex;align-items:center;justify-content:center;gap:.5rem}
.btn-save:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(229,9,20,.45)}
.alert{padding:.8rem 1rem;border-radius:9px;margin-bottom:1.5rem;font-size:.88rem}
.alert-danger{background:rgba(229,9,20,.12);border:1px solid rgba(229,9,20,.3);color:#ff6b6b}
</style>
@endpush

@section('content')

{{-- Header --}}
<div class="create-header">
  <div class="welcome">Tambah Aktor Baru</div>
  <div class="date">{{ now()->translatedFormat('D, d F Y') }}</div>
</div>

@if($errors->any())
  <div class="alert alert-danger">
    @foreach($errors->all() as $e) <div>{{ $e }}</div> @endforeach
  </div>
@endif

<div class="create-wrap">

  <div class="panel">
    <div class="panel-title">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
      Form Aktor
    </div>
    <div class="panel-body">
      <form action="{{ route('actors.store') }}" method="POST">
        @csrf

        <div class="fg">
          <label>Nama Aktor</label>
          <input type="text" name="namaaktor" placeholder="Contoh: Tom Cruise, Reza Rahadian..." value="{{ old('namaaktor') }}" required autofocus>
        </div>

        <div class="form-actions">
          <a href="{{ route('actors.manage') }}" class="btn-back">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
            Kembali
          </a>
          <button type="submit" class="btn-save">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
            Simpan Aktor
          </button>
        </div>

      </form>
    </div>
  </div>

</div>
@endsection
