<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnggotaRequest;
use App\Models\Anggota;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AnggotaController extends Controller
{
    public function __construct(private readonly ImageService $image)
    {
    }

    public function index(): View
    {
        return view('admin.anggota.index', [
            'anggota' => Anggota::orderBy('nama_lengkap')->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.anggota.create');
    }

    public function store(AnggotaRequest $request): RedirectResponse
    {
        $data = collect($request->validated())->except('foto')->toArray();

        if ($request->hasFile('foto')) {
            $data['foto'] = $this->image->store($request->file('foto'), 'anggota', 800);
        }

        $anggota = Anggota::create($data);

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Anggota "' . $anggota->nama_lengkap . '" berhasil ditambahkan.');
    }

    public function edit(Anggota $anggota): View
    {
        return view('admin.anggota.edit', ['anggota' => $anggota]);
    }

    public function update(AnggotaRequest $request, Anggota $anggota): RedirectResponse
    {
        $data = collect($request->validated())->except('foto')->toArray();

        if ($request->hasFile('foto')) {
            $this->image->delete($anggota->foto);
            $data['foto'] = $this->image->store($request->file('foto'), 'anggota', 800);
        }

        $anggota->update($data);

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Data "' . $anggota->nama_lengkap . '" berhasil diperbarui.');
    }

    public function destroy(Anggota $anggota): RedirectResponse
    {
        $this->image->delete($anggota->foto);
        $anggota->delete();

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
