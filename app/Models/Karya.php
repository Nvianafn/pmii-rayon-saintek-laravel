<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Karya extends Model
{
    use HasSlug;

    protected $table = 'karya';

    protected $fillable = [
        'anggota_id', 'judul', 'slug', 'tipe', 'konten', 'excerpt',
        'thumbnail', 'tags', 'status', 'published_at', 'created_by',
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
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

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function penulis(): string
    {
        return $this->anggota?->nama_lengkap ?? 'Tim Redaksi';
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
