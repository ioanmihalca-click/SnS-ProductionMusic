<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Album extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'artwork_path',
        'total_duration',
        'tracks_count',
        'tags',
        'category',
        'standard_license_price',
        'premium_license_price',
        'exclusive_license_price',
        'status',
        'is_featured',
        'seo_description',
        'seo_keywords'
    ];

    protected $casts = [
        'total_duration' => 'integer',
        'tracks_count' => 'integer',
        'is_featured' => 'boolean',
        'tags' => 'array',
        'plays_count' => 'integer',
        'downloads_count' => 'integer',
        'standard_license_price' => 'decimal:2',
        'premium_license_price' => 'decimal:2',
        'exclusive_license_price' => 'decimal:2'
    ];

    protected $attributes = [
        'status' => 'active',
        'is_featured' => false,
        'plays_count' => 0,
        'downloads_count' => 0
    ];

    // Relații
    public function tracks()
    {
        return $this->belongsToMany(Track::class)
                    ->withPivot('position')
                    ->orderBy('position')
                    ->withTimestamps();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Helpers
    public function getArtworkUrl()
    {
        return $this->artwork_path ? asset('storage/' . $this->artwork_path) : null;
    }

    public function getDurationForHumans()
    {
        $minutes = floor($this->total_duration / 60);
        $seconds = $this->total_duration % 60;
        return sprintf('%d:%02d', $minutes, $seconds);
    }

    public function updateTotalDuration()
    {
        $this->total_duration = $this->tracks()->sum('duration');
        $this->tracks_count = $this->tracks()->count();
        $this->save();
    }

    // Events
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($album) {
            if (!$album->slug) {
                $baseSlug = Str::slug($album->name);
                $slug = $baseSlug;
                $count = 2;
                
                while (static::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $count++;
                }
                
                $album->slug = $slug;
            }
        });

        static::saving(function ($album) {
            if (empty($album->seo_description)) {
                $album->seo_description = Str::limit(strip_tags($album->description), 160);
            }

            if (empty($album->seo_keywords)) {
                $keywords = collect([$album->name])
                    ->concat($album->tags ?? [])
                    ->filter()
                    ->unique()
                    ->take(10)
                    ->implode(', ');
                $album->seo_keywords = $keywords;
            }
        });
    }
}