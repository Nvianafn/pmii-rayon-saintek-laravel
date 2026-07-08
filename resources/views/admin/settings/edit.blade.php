@extends('layouts.admin')

@section('title', 'Pengaturan Situs')

@push('styles')
<style>
.settings-wrap{max-width:720px}
.card{background:#fff;border:1px solid var(--outline-variant);border-radius:1rem;padding:1.6rem;margin-bottom:1.4rem}
.card h3{font-family:var(--font-serif);font-size:1.05rem;color:var(--primary);margin-bottom:.3rem}
.card .sub{font-size:12.5px;color:var(--on-surface-variant);margin-bottom:1.2rem}
.field{margin-bottom:1.1rem}
.field:last-child{margin-bottom:0}
.field label{display:block;font-size:13px;font-weight:600;color:var(--on-surface);margin-bottom:.4rem}
.field .input,.field textarea{width:100%;padding:.6rem .8rem;border:1px solid var(--outline-variant);border-radius:.5rem;font-family:var(--font-sans);font-size:14px;background:#fff;color:var(--on-surface)}
.field textarea{min-height:90px;resize:vertical}
.field .err{color:var(--error);font-size:12.5px;margin-top:.3rem}
.form-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
.save-bar{position:sticky;bottom:0;background:var(--surface);padding:1rem 0;display:flex;gap:.7rem}
@media(max-width:560px){.form-grid-2{grid-template-columns:1fr}}
</style>
@endpush

@section('content')
<form method="POST" action="{{ route('admin.settings.update') }}" class="settings-wrap">
  @csrf @method('PUT')

  <div class="card">
    <h3>Identitas Rayon</h3>
    <p class="sub">Nama dan deskripsi yang tampil di seluruh situs.</p>
    <div class="field">
      <label for="nama_rayon">Nama Rayon</label>
      <input type="text" id="nama_rayon" name="nama_rayon" class="input" value="{{ old('nama_rayon', $settings['nama_rayon']) }}" required>
      @error('nama_rayon')<div class="err">{{ $message }}</div>@enderror
    </div>
    <div class="field">
      <label for="deskripsi_singkat">Deskripsi Singkat</label>
      <textarea id="deskripsi_singkat" name="deskripsi_singkat">{{ old('deskripsi_singkat', $settings['deskripsi_singkat']) }}</textarea>
      @error('deskripsi_singkat')<div class="err">{{ $message }}</div>@enderror
    </div>
  </div>

  <div class="card">
    <h3>Kontak</h3>
    <p class="sub">Digunakan di halaman Kontak dan footer.</p>
    <div class="form-grid-2">
      <div class="field">
        <label for="email_kontak">Email</label>
        <input type="email" id="email_kontak" name="email_kontak" class="input" value="{{ old('email_kontak', $settings['email_kontak']) }}">
        @error('email_kontak')<div class="err">{{ $message }}</div>@enderror
      </div>
      <div class="field">
        <label for="no_wa">No. WhatsApp</label>
        <input type="text" id="no_wa" name="no_wa" class="input" value="{{ old('no_wa', $settings['no_wa']) }}">
      </div>
    </div>
    <div class="field">
      <label for="alamat">Alamat Sekretariat</label>
      <input type="text" id="alamat" name="alamat" class="input" value="{{ old('alamat', $settings['alamat']) }}">
    </div>
  </div>

  <div class="card">
    <h3>Media Sosial</h3>
    <p class="sub">Tautan lengkap (mis. https://instagram.com/...). Kosongkan jika tidak dipakai.</p>
    <div class="field">
      <label for="instagram">Instagram</label>
      <input type="text" id="instagram" name="instagram" class="input" value="{{ old('instagram', $settings['instagram']) }}">
    </div>
    <div class="form-grid-2">
      <div class="field">
        <label for="facebook">Facebook</label>
        <input type="text" id="facebook" name="facebook" class="input" value="{{ old('facebook', $settings['facebook']) }}">
      </div>
      <div class="field">
        <label for="youtube">YouTube</label>
        <input type="text" id="youtube" name="youtube" class="input" value="{{ old('youtube', $settings['youtube']) }}">
      </div>
    </div>
  </div>

  <div class="save-bar">
    <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
  </div>
</form>
@endsection
