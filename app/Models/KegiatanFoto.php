<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KegiatanFoto extends Model
{
    protected $table = 'kegiatan_foto';

    public const UPDATED_AT = null;

    protected $fillable = [
        'kegiatan_id', 'path', 'caption', 'urutan',
    ];

    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
