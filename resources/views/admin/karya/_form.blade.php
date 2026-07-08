@push('styles')
<style>
.form-wrap{display:grid;grid-template-columns:1fr 330px;gap:1.5rem;align-items:start}
.form-main,.form-side{background:#fff;border:1px solid var(--outline-variant);border-radius:1rem;padding:1.5rem}
.form-side{position:sticky;top:5.5rem}
.form-side h3{font-size:12px;text-transform:uppercase;letter-spacing:.08em;color:var(--on-surface-variant);margin-bottom:1rem}
.field{margin-bottom:1.1rem}
.field label{display:block;font-size:13px;font-weight:600;color:var(--on-surface);margin-bottom:.4rem}
.field .input,.field select,.field textarea{width:100%;padding:.6rem .8rem;border:1px solid var(--outline-variant);border-radius:.5rem;font-family:var(--font-sans);font-size:14px;background:#fff;color:var(--on-surface)}
.field textarea.konten{min-height:340px;resize:vertical;line-height:1.7;font-size:14.5px}
.field textarea.excerpt{min-height:80px;resize:vertical}
.field .hint{font-size:12px;color:var(--on-surface-variant);margin-top:.3rem}
.field .err{color:var(--error);font-size:12.5px;margin-top:.3rem}
.img-preview{width:100%;aspect-ratio:16/9;object-fit:cover;border-radius:.6rem;margin-bottom:.6rem;border:1px solid var(--outline-variant);background:var(--sc)}
.form-actions{display:flex;gap:.7rem;margin-top:1rem}
@media(max-width:860px){.form-wrap{grid-template-columns:1fr}.form-side{position:static}}
</style>
@endpush

@php $ky = $karya ?? null; @endphp

<div class="form-wrap">
  <div class="form-main">
    <div class="field">
      <label for="judul">Judul Karya</label>
      <input type="text" id="judul" name="judul" class="input" value="{{ old('judul', $ky?->judul) }}" required>
      @error('judul')<div class="err">{{ $message }}</div>@enderror
    </div>

    <div class="field">
      <label for="excerpt">Ringkasan / Excerpt</label>
      <textarea id="excerpt" name="excerpt" class="excerpt" placeholder="Cuplikan singkat yang tampil di daftar karya...">{{ old('excerpt', $ky?->excerpt) }}</textarea>
      @error('excerpt')<div class="err">{{ $message }}</div>@enderror
    </div>

    <div class="field">
      <label for="konten">Isi Karya</label>
      <textarea id="konten" name="konten" class="konten" required placeholder="Tulis isi karya di sini. Boleh pakai HTML sederhana untuk format.">{{ old('konten', $ky?->konten) }}</textarea>
      <div class="hint">Mendukung HTML dasar (paragraf, heading, kutipan). Konten dirender apa adanya di halaman publik.</div>
      @error('konten')<div class="err">{{ $message }}</div>@enderror
    </div>
  </div>

  <aside class="form-side">
    <h3>Publikasi</h3>
    <div class="field">
      <label for="status">Status</label>
      <select id="status" name="status">
        <option value="draft" @selected(old('status', $ky?->status) === 'draft')>Draft</option>
        <option value="published" @selected(old('status', $ky?->status) === 'published')>Published</option>
      </select>
      <div class="hint">Draft tidak tampil di publik. Waktu terbit terisi otomatis saat dipublikasikan.</div>
    </div>
    <div class="field">
      <label for="published_at">Waktu Terbit (opsional)</label>
      <input type="datetime-local" id="published_at" name="published_at" class="input" value="{{ old('published_at', $ky?->published_at?->format('Y-m-d\TH:i')) }}">
    </div>

    <h3 style="margin-top:1.5rem">Detail</h3>
    <div class="field">
      <label for="tipe">Tipe</label>
      <select id="tipe" name="tipe">
        @foreach (['artikel' => 'Artikel', 'esai' => 'Esai', 'puisi' => 'Puisi', 'berita' => 'Berita'] as $val => $lbl)
          <option value="{{ $val }}" @selected(old('tipe', $ky?->tipe) === $val)>{{ $lbl }}</option>
        @endforeach
      </select>
    </div>
    <div class="field">
      <label for="anggota_id">Penulis</label>
      <select id="anggota_id" name="anggota_id">
        <option value="">&mdash; Tim Redaksi &mdash;</option>
        @foreach ($anggotaList as $a)
          <option value="{{ $a->id }}" @selected((string) old('anggota_id', $ky?->anggota_id) === (string) $a->id)>{{ $a->nama_lengkap }}</option>
        @endforeach
      </select>
    </div>
    <div class="field">
      <label for="tags">Tags</label>
      <input type="text" id="tags" name="tags" class="input" value="{{ old('tags', $ky ? implode(', ', $ky->tags ?? []) : '') }}" placeholder="pergerakan, literasi">
      <div class="hint">Pisahkan dengan koma.</div>
    </div>
    <div class="field">
      <label>Thumbnail</label>
      @if ($ky && $ky->thumbnail)<img class="img-preview" src="{{ asset('storage/'.$ky->thumbnail) }}" alt="">@endif
      <input type="file" name="thumbnail" accept="image/*" class="input">
      @error('thumbnail')<div class="err">{{ $message }}</div>@enderror
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="{{ route('admin.karya.index') }}" class="btn-sm" style="display:inline-flex;align-items:center">Batal</a>
    </div>
  </aside>
</div>
