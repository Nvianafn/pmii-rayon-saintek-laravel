<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Biro extends Model
{
    use HasSlug;

    protected $table = 'biro';

    protected $fillable = [
        'nama', 'slug', 'deskripsi', 'logo', 'warna_aksen', 'urutan',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nama')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function kepengurusan(): HasMany
    {
        return $this->hasMany(Kepengurusan::class);
    }

    public function kegiatan(): HasMany
    {
        return $this->hasMany(Kegiatan::class);
    }
}
