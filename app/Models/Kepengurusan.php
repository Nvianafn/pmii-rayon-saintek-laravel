<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kepengurusan extends Model
{
    protected $table = 'kepengurusan';

    protected $fillable = [
        'anggota_id', 'periode_id', 'biro_id', 'jabatan', 'level', 'urutan',
    ];

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class);
    }

    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class);
    }

    public function biro(): BelongsTo
    {
        return $this->belongsTo(Biro::class);
    }

    public function scopeBph($query)
    {
        return $query->where('level', 'bph');
    }
}
