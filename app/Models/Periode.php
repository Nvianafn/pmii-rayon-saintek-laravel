<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Periode extends Model
{
    protected $table = 'periode';

    protected $fillable = [
        'nama', 'tahun_mulai', 'tahun_selesai', 'is_aktif', 'tema', 'deskripsi',
    ];

    protected $casts = [
        'is_aktif' => 'boolean',
    ];

    public function kepengurusan(): HasMany
    {
        return $this->hasMany(Kepengurusan::class);
    }

    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }
}
