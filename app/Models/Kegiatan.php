<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Kegiatan extends Model
{
    use HasSlug;

    protected $table = 'kegiatan';

    protected $fillable = [
        'biro_id', 'judul', 'slug', 'deskripsi', 'tanggal',
        'lokasi', 'thumbnail', 'status', 'created_by',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('judul')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function biro(): BelongsTo
    {
        return $this->belongsTo(Biro::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function foto(): HasMany
    {
        return $this->hasMany(KegiatanFoto::class)->orderBy('urutan');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
