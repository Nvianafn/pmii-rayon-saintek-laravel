@php use App\Models\Setting; @endphp
<header id="hdr" class="site-header">
  <div class="wrap">
    <nav class="nav glass">
      <a class="brand" href="{{ route('home') }}">
        <span class="mark">P</span>
        <span class="brand-txt"><b>{{ Setting::get('nama_rayon', 'PMII Rayon Saintek') }}</b><span>Bergerak &middot; Berpikir &middot; Berkarya</span></span>
      </a>
      <div class="nav-links">
        <a href="{{ route('tentang') }}" @class(['active' => request()->routeIs('tentang')])>Tentang</a>
        <a href="{{ route('biro.index') }}" @class(['active' => request()->routeIs('biro.*')])>Biro</a>
        <a href="{{ route('kegiatan.index') }}" @class(['active' => request()->routeIs('kegiatan.*')])>Kegiatan</a>
        <a href="{{ route('karya.index') }}" @class(['active' => request()->routeIs('karya.*')])>Karya</a>
        <a href="{{ route('kepengurusan') }}" @class(['active' => request()->routeIs('kepengurusan')])>Kepengurusan</a>
      </div>
      <a href="{{ route('kontak') }}" class="btn btn-primary">Gabung Kami</a>
      <button class="btn btn-ghost menu-btn" aria-label="Menu">&#9776;</button>
    </nav>
    <div id="mobile-nav" class="glass">
      <a href="{{ route('tentang') }}">Tentang</a>
      <a href="{{ route('biro.index') }}">Biro</a>
      <a href="{{ route('kegiatan.index') }}">Kegiatan</a>
      <a href="{{ route('karya.index') }}">Karya</a>
      <a href="{{ route('kepengurusan') }}">Kepengurusan</a>
      <a href="{{ route('kontak') }}">Gabung Kami</a>
    </div>
  </div>
</header>
