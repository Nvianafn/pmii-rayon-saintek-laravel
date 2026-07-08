@extends('layouts.admin')

@section('title', 'Biro')

@push('styles')
<style>
.toolbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;gap:1rem;flex-wrap:wrap}
.toolbar p{color:var(--on-surface-variant);font-size:.92rem}
.data-table{width:100%;border-collapse:collapse;background:#fff;border:1px solid var(--outline-variant);border-radius:1rem;overflow:hidden}
.data-table th{text-align:left;font-size:11.5px;text-transform:uppercase;letter-spacing:.05em;color:var(--on-surface-variant);padding:.85rem 1rem;background:var(--sc-low);border-bottom:1px solid var(--outline-variant)}
.data-table td{padding:.8rem 1rem;border-bottom:1px solid var(--outline-variant);font-size:.92rem;vertical-align:middle}
.data-table tr:last-child td{border-bottom:none}
.data-table tr:hover td{background:var(--sc-lowest)}
.cell-name{display:flex;align-items:center;gap:.7rem}
.swatch{width:34px;height:34px;border-radius:.5rem;flex:none;border:1px solid rgba(0,0,0,.08)}
.cell-name b{font-weight:600}
.row-actions{display:flex;gap:.5rem;justify-content:flex-end}
.btn-sm{padding:.4rem .8rem;font-size:12.5px;border-radius:.45rem;border:1px solid var(--outline-variant);background:#fff;color:var(--on-surface);cursor:pointer;font-family:var(--font-sans);text-decoration:none}
.btn-sm:hover{border-color:var(--primary-container);color:var(--primary)}
.btn-sm.danger:hover{border-color:var(--error);color:var(--error)}
.empty-cell{text-align:center;padding:3rem;color:var(--on-surface-variant)}
</style>
@endpush

@section('content')
<div class="toolbar">
  <p>{{ $biro->count() }} biro terdaftar. Urutan menentukan posisi tampil di situs.</p>
  <a href="{{ route('admin.biro.create') }}" class="btn btn-primary">+ Tambah Biro</a>
</div>

<table class="data-table">
  <thead>
    <tr><th style="width:60px">Urut</th><th>Biro</th><th>Pengurus</th><th>Kegiatan</th><th style="text-align:right">Aksi</th></tr>
  </thead>
  <tbody>
    @forelse ($biro as $b)
    <tr>
      <td>{{ $b->urutan }}</td>
      <td>
        <div class="cell-name">
          <span class="swatch" style="background:{{ $b->warna_aksen ?? '#003399' }}"></span>
          <span><b>{{ $b->nama }}</b></span>
        </div>
      </td>
      <td>{{ $b->kepengurusan_count }}</td>
      <td>{{ $b->kegiatan_count }}</td>
      <td>
        <div class="row-actions">
          <a class="btn-sm" href="{{ route('admin.biro.edit', $b) }}">Edit</a>
          <form method="POST" action="{{ route('admin.biro.destroy', $b) }}" onsubmit="return confirm('Hapus biro ini?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn-sm danger">Hapus</button>
          </form>
        </div>
      </td>
    </tr>
    @empty
    <tr><td colspan="5" class="empty-cell">Belum ada biro.</td></tr>
    @endforelse
  </tbody>
</table>
@endsection
