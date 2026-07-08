<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KegiatanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'biro_id' => ['nullable', 'exists:biro,id'],
            'tanggal' => ['required', 'date'],
            'lokasi' => ['nullable', 'string', 'max:200'],
            'deskripsi' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'foto' => ['nullable', 'array'],
            'foto.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'caption' => ['nullable', 'array'],
            'caption.*' => ['nullable', 'string', 'max:255'],
            'hapus_foto' => ['nullable', 'array'],
            'hapus_foto.*' => ['integer'],
        ];
    }

    public function attributes(): array
    {
        return [
            'judul' => 'judul kegiatan',
            'biro_id' => 'biro',
            'tanggal' => 'tanggal',
        ];
    }
}
