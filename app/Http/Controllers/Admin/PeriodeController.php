<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PeriodeRequest;
use App\Models\Periode;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PeriodeController extends Controller
{
    public function index(): View
    {
        return view('admin.periode.index', [
            'periode' => Periode::withCount('kepengurusan')->orderByDesc('tahun_mulai')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.periode.create');
    }

    public function store(PeriodeRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_aktif'] = $request->boolean('is_aktif');

        if ($data['is_aktif']) {
            Periode::query()->update(['is_aktif' => false]);
        }

        $periode = Periode::create($data);

        return redirect()->route('admin.periode.index')
            ->with('success', 'Periode "' . $periode->nama . '" berhasil dibuat.');
    }

    public function edit(Periode $periode): View
    {
        return view('admin.periode.edit', ['periode' => $periode]);
    }

    public function update(PeriodeRequest $request, Periode $periode): RedirectResponse
    {
        $data = $request->validated();
        $data['is_aktif'] = $request->boolean('is_aktif');

        if ($data['is_aktif']) {
            Periode::where('id', '!=', $periode->id)->update(['is_aktif' => false]);
        }

        $periode->update($data);

        return redirect()->route('admin.periode.index')
            ->with('success', 'Periode "' . $periode->nama . '" berhasil diperbarui.');
    }

    public function destroy(Periode $periode): RedirectResponse
    {
        $periode->delete();

        return redirect()->route('admin.periode.index')
            ->with('success', 'Periode beserta data kepengurusannya telah dihapus.');
    }
}
