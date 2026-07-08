<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KaryaRequest;
use App\Models\Anggota;
use App\Models\Karya;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class KaryaController extends Controller
{
    public function __construct(private readonly ImageService $image)
    {
    }

    public function index(): View
    {
        return view('admin.karya.index', [
            'karya' => Karya::with('anggota')->latest('created_at')->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.karya.create', [
            'anggotaList' => Anggota::orderBy('nama_lengkap')->get(),
        ]);
    }

    public function store(KaryaRequest $request): RedirectResponse
    {
        $data = $this->payload($request);
        $data['created_by'] = $request->user()->id;

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->image->store($request->file('thumbnail'), 'karya', 1400);
        }

        $karya = Karya::create($data);

        return redirect()->route('admin.karya.index')
            ->with('success', 'Karya "' . $karya->judul . '" berhasil dibuat.');
    }

    public function edit(Karya $karya): View
    {
        return view('admin.karya.edit', [
            'karya' => $karya,
            'anggotaList' => Anggota::orderBy('nama_lengkap')->get(),
        ]);
    }

    public function update(KaryaRequest $request, Karya $karya): RedirectResponse
    {
        $data = $this->payload($request, $karya);

        if ($request->hasFile('thumbnail')) {
            $this->image->delete($karya->thumbnail);
            $data['thumbnail'] = $this->image->store($request->file('thumbnail'), 'karya', 1400);
        }

        $karya->update($data);

        return redirect()->route('admin.karya.index')
            ->with('success', 'Karya "' . $karya->judul . '" berhasil diperbarui.');
    }

    public function destroy(Karya $karya): RedirectResponse
    {
        $this->image->delete($karya->thumbnail);
        $karya->delete();

        return redirect()->route('admin.karya.index')
            ->with('success', 'Karya berhasil dihapus.');
    }

    /**
     * Build the persisted payload: normalize tags and resolve publish time.
     */
    private function payload(KaryaRequest $request, ?Karya $karya = null): array
    {
        $data = collect($request->validated())
            ->except(['thumbnail', 'tags'])
            ->toArray();

        $data['tags'] = collect(explode(',', (string) $request->input('tags')))
            ->map(fn ($t) => trim($t))
            ->filter()
            ->values()
            ->all();

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = $karya?->published_at ?? Carbon::now();
        }

        if ($data['status'] === 'draft') {
            $data['published_at'] = null;
        }

        return $data;
    }
}
