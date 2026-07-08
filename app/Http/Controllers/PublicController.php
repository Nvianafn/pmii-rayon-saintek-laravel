<?php

namespace App\Http\Controllers;

use App\Models\Biro;
use App\Models\Karya;
use App\Models\Kegiatan;
use App\Models\Kepengurusan;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function home(): View
    {
        $periodeAktif = Periode::aktif()->first();

        $bph = Kepengurusan::with('anggota')
            ->where('periode_id', $periodeAktif?->id)
            ->bph()->orderBy('urutan')->take(2)->get();

        return view('home', [
            'biro' => Biro::orderBy('urutan')->get(),
            'kegiatanTerbaru' => Kegiatan::with('biro')->published()->latest('tanggal')->take(3)->get(),
            'karyaPilihan' => Karya::with('anggota')->published()->latest('published_at')->take(5)->get(),
            'bph' => $bph,
            'periodeAktif' => $periodeAktif,
            'stats' => [
                'anggota' => \App\Models\Anggota::where('status', 'aktif')->count(),
                'biro' => Biro::count(),
                'kegiatan' => Kegiatan::published()->count(),
                'karya' => Karya::published()->count(),
            ],
        ]);
    }

    public function tentang(): View
    {
        return view('tentang', [
            'periodeAktif' => Periode::aktif()->first(),
            'stats' => [
                'anggota' => \App\Models\Anggota::where('status', 'aktif')->count(),
                'biro' => Biro::count(),
                'kegiatan' => Kegiatan::published()->count(),
                'karya' => Karya::published()->count(),
            ],
        ]);
    }

    public function biroIndex(): View
    {
        return view('biro.index', [
            'biro' => Biro::withCount(['kepengurusan', 'kegiatan'])->orderBy('urutan')->get(),
        ]);
    }

    public function biroShow(Biro $biro): View
    {
        $periodeAktif = Periode::aktif()->first();

        $biro->load(['kepengurusan' => function ($q) use ($periodeAktif) {
            $q->where('periode_id', $periodeAktif?->id)
                ->with('anggota')->orderBy('urutan');
        }]);

        return view('biro.show', [
            'biro' => $biro,
            'ketua' => $biro->kepengurusan->firstWhere('level', 'ketua_biro'),
            'kegiatan' => $biro->kegiatan()->published()->latest('tanggal')->take(4)->get(),
        ]);
    }

    public function kepengurusan(Request $request): View
    {
        $periodeList = Periode::orderByDesc('tahun_mulai')->get();
        $periode = $request->filled('periode')
            ? $periodeList->firstWhere('id', (int) $request->periode)
            : ($periodeList->firstWhere('is_aktif', true) ?? $periodeList->first());

        $pengurus = Kepengurusan::with(['anggota', 'biro'])
            ->where('periode_id', $periode?->id)
            ->orderBy('urutan')->get();

        return view('kepengurusan', [
            'periodeList' => $periodeList,
            'periode' => $periode,
            'bph' => $pengurus->where('level', 'bph'),
            'perBiro' => $pengurus->whereIn('level', ['ketua_biro', 'anggota_biro'])->groupBy('biro_id'),
            'biroList' => Biro::orderBy('urutan')->get(),
        ]);
    }

    public function kegiatanIndex(Request $request): View
    {
        $query = Kegiatan::with('biro')->published();

        if ($request->filled('biro')) {
            $query->whereHas('biro', fn ($q) => $q->where('slug', $request->biro));
        }

        return view('kegiatan.index', [
            'kegiatan' => $query->latest('tanggal')->paginate(9)->withQueryString(),
            'biroList' => Biro::orderBy('urutan')->get(),
            'biroAktif' => $request->biro,
        ]);
    }

    public function kegiatanShow(Kegiatan $kegiatan): View
    {
        abort_if($kegiatan->status !== 'published', 404);
        $kegiatan->load(['biro', 'foto']);

        return view('kegiatan.show', [
            'kegiatan' => $kegiatan,
            'lainnya' => Kegiatan::published()->where('id', '!=', $kegiatan->id)
                ->latest('tanggal')->take(3)->get(),
        ]);
    }

    public function karyaIndex(Request $request): View
    {
        $query = Karya::with('anggota')->published();

        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }
        if ($request->filled('q')) {
            $query->where('judul', 'like', '%' . $request->q . '%');
        }

        return view('karya.index', [
            'karya' => $query->latest('published_at')->paginate(8)->withQueryString(),
            'tipeAktif' => $request->tipe,
            'keyword' => $request->q,
        ]);
    }

    public function karyaShow(Karya $karya): View
    {
        abort_if($karya->status !== 'published', 404);
        $karya->load('anggota');

        return view('karya.show', [
            'karya' => $karya,
            'terkait' => Karya::published()->where('id', '!=', $karya->id)
                ->where('tipe', $karya->tipe)->latest('published_at')->take(3)->get(),
        ]);
    }

    public function kontak(): View
    {
        return view('kontak');
    }

    public function kontakSubmit(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'pesan' => 'required|string|max:2000',
        ]);

        // TODO: kirim email / simpan ke tabel pesan (Fase lanjutan)
        return back()->with('success', 'Terima kasih! Pesan kamu sudah kami terima.');
    }
}
