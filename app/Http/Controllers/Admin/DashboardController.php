<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Biro;
use App\Models\Karya;
use App\Models\Kegiatan;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'anggota' => Anggota::count(),
                'biro' => Biro::count(),
                'kegiatan' => Kegiatan::count(),
                'karya' => Karya::count(),
            ],
            'kegiatanTerbaru' => Kegiatan::with('biro')->latest('tanggal')->take(5)->get(),
            'karyaTerbaru' => Karya::with('anggota')->latest('created_at')->take(5)->get(),
            'draftKarya' => Karya::where('status', 'draft')->count(),
        ]);
    }
}
