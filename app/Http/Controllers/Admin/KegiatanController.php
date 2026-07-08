<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KegiatanRequest;
use App\Models\Biro;
use App\Models\Kegiatan;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KegiatanController extends Controller
{
    public function __construct(private readonly ImageService $image)
    {
    }

    public function index(): View
    {
        return view('admin.kegiatan.index', [
            'kegiatan' => Kegiatan::with('biro')->latest('tanggal')->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.kegiatan.create', [
            'biroList' => Biro::orderBy('urutan')->get(),
        ]);
    }

    public function store(KegiatanRequest $request): RedirectResponse
    {
        $data = collect($request->validated())
            ->except(['thumbnail', 'foto', 'caption', 'hapus_foto'])
            ->toArray();
        $data['created_by'] = $request->user()->id;

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->image->store($request->file('thumbnail'), 'kegiatan', 1600);
        }

        $kegiatan = Kegiatan::create($data);
        $this->syncFoto($request, $kegiatan);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan "' . $kegiatan->judul . '" berhasil dibuat.');
    }

    public function edit(Kegiatan $kegiatan): View
    {
        return view('admin.kegiatan.edit', [
            'kegiatan' => $kegiatan->load('foto'),
            'biroList' => Biro::orderBy('urutan')->get(),
        ]);
    }

    public function update(KegiatanRequest $request, Kegiatan $kegiatan): RedirectResponse
    {
        $data = collect($request->validated())
            ->except(['thumbnail', 'foto', 'caption', 'hapus_foto'])
            ->toArray();

        if ($request->hasFile('thumbnail')) {
            $this->image->delete($kegiatan->thumbnail);
            $data['thumbnail'] = $this->image->store($request->file('thumbnail'), 'kegiatan', 1600);
        }

        $kegiatan->update($data);

        // Remove deleted gallery photos
        foreach ($kegiatan->foto()->whereIn('id', $request->input('hapus_foto', []))->get() as $foto) {
            $this->image->delete($foto->path);
            $foto->delete();
        }

        $this->syncFoto($request, $kegiatan);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan "' . $kegiatan->judul . '" berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan): RedirectResponse
    {
        $this->image->delete($kegiatan->thumbnail);
        foreach ($kegiatan->foto as $foto) {
            $this->image->delete($foto->path);
        }
        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }

    private function syncFoto(KegiatanRequest $request, Kegiatan $kegiatan): void
    {
        if (! $request->hasFile('foto')) {
            return;
        }

        $start = (int) $kegiatan->foto()->max('urutan');
        foreach ($request->file('foto') as $i => $file) {
            $path = $this->image->store($file, 'kegiatan/foto', 1600);
            $kegiatan->foto()->create([
                'path' => $path,
                'caption' => $request->input('caption.' . $i),
                'urutan' => $start + $i + 1,
            ]);
        }
    }
}
