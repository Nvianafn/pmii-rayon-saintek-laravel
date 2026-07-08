<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Setting keys grouped by section for the form.
     */
    private const FIELDS = [
        'nama_rayon',
        'deskripsi_singkat',
        'email_kontak',
        'no_wa',
        'alamat',
        'instagram',
        'facebook',
        'youtube',
    ];

    public function edit(): View
    {
        $settings = [];
        foreach (self::FIELDS as $key) {
            $settings[$key] = Setting::get($key, '');
        }

        return view('admin.settings.edit', ['settings' => $settings]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_rayon' => ['required', 'string', 'max:150'],
            'deskripsi_singkat' => ['nullable', 'string', 'max:500'],
            'email_kontak' => ['nullable', 'email', 'max:150'],
            'no_wa' => ['nullable', 'string', 'max:50'],
            'alamat' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'facebook' => ['nullable', 'string', 'max:255'],
            'youtube' => ['nullable', 'string', 'max:255'],
        ]);

        foreach ($validated as $key => $value) {
            Setting::put($key, $value ?? '');
        }

        return redirect()->route('admin.settings.edit')
            ->with('success', 'Pengaturan situs berhasil disimpan.');
    }
}
