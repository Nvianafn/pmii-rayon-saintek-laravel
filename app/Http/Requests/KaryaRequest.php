<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KaryaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'tipe' => ['required', 'in:artikel,esai,puisi,berita'],
            'anggota_id' => ['nullable', 'exists:anggota,id'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'konten' => ['required', 'string'],
            'tags' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:draft,published'],
            'published_at' => ['nullable', 'date'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ];
    }

    public function attributes(): array
    {
        return [
            'judul' => 'judul karya',
            'tipe' => 'tipe karya',
            'konten' => 'isi karya',
            'anggota_id' => 'penulis',
        ];
    }
}
