<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class Track extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'artist',
        'description',
        'original_file_path',
        'preview_file_path',
        'artwork_path',
        'duration',
        'preview_duration',
        'key',
        'bpm',
        'tags',
        'category',
        'standard_license_price',
        'premium_license_price',
        'exclusive_license_price',
        'status',
        'slug',
        'seo_description',
        'seo_keywords',
        'is_featured'
    ];

    protected $casts = [
        'duration' => 'integer',
        'preview_duration' => 'integer',
        'bpm' => 'integer',
        'plays_count' => 'integer',
        'likes_count' => 'integer',
        'downloads_count' => 'integer',
        'is_featured' => 'boolean',
        'tags' => 'array',
        'standard_license_price' => 'decimal:2',
        'premium_license_price' => 'decimal:2',
        'exclusive_license_price' => 'decimal:2'
    ];

    protected $attributes = [
        'status' => 'active',
        'preview_duration' => 60,
        'plays_count' => 0,
        'likes_count' => 0,
        'downloads_count' => 0,
        'is_featured' => false
    ];

    // Relații
    public function genres()
    {
        return $this->belongsToMany(Genre::class)->withTimestamps();
    }

    public function moods()
    {
        return $this->belongsToMany(Mood::class)->withTimestamps();
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function licenses()
    {
        return $this->hasMany(License::class);
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

    public function scopeInCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeWithTag($query, $tag)
    {
        return $query->whereJsonContains('tags', $tag);
    }

    public function scopePriceRange($query, $min, $max)
    {
        return $query->whereBetween('standard_license_price', [$min, $max]);
    }

    // Helpers
    public function getPreviewUrl()
    {
        return asset('storage/' . $this->preview_file_path);
    }

    public function getOriginalUrl()
    {
        return asset('storage/' . $this->original_file_path);
    }

    public function getArtworkUrl()
    {
        return $this->artwork_path ? asset('storage/' . $this->artwork_path) : null;
    }

    public function incrementPlays()
    {
        $this->increment('plays_count');
    }

    public function incrementDownloads()
    {
        $this->increment('downloads_count');
    }

    public function incrementLikes()
    {
        $this->increment('likes_count');
    }

    public function decrementLikes()
    {
        $this->decrement('likes_count');
    }

    public function getDurationForHumans()
    {
        $minutes = floor($this->duration / 60);
        $seconds = $this->duration % 60;
        return sprintf('%d:%02d', $minutes, $seconds);
    }

    public function getPreviewDurationForHumans()
    {
        $minutes = floor($this->preview_duration / 60);
        $seconds = $this->preview_duration % 60;
        return sprintf('%d:%02d', $minutes, $seconds);
    }

    public function isLicensedBy(User $user)
    {
        return $this->licenses()
                    ->where('user_id', $user->id)
                    ->where('status', 'active')
                    ->exists();
    }

    public function isFavoritedBy(User $user)
    {
        return $this->favorites()->where('user_id', $user->id)->exists();
    }

    public function getLicensePrice(string $type)
    {
        return match ($type) {
            'standard' => $this->standard_license_price,
            'premium' => $this->premium_license_price,
            'exclusive' => $this->exclusive_license_price,
            default => null,
        };
    }

    // Auto-generare slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($track) {
            if (!$track->slug) {
                $baseSlug = Str::slug($track->name);
                $slug = $baseSlug;
                $count = 2;
                
                while (static::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $count++;
                }
                
                $track->slug = $slug;
            }
        });

        static::saving(function ($track) {
            if (empty($track->seo_description)) {
                $track->seo_description = Str::limit(strip_tags($track->description), 160);
            }

            if (empty($track->seo_keywords)) {
                $keywords = collect([$track->name, $track->artist])
                    ->concat($track->tags ?? [])
                    ->filter()
                    ->unique()
                    ->take(10)
                    ->implode(', ');
                $track->seo_keywords = $keywords;
            }
        });
    }

    // URL
    public function getRouteKeyName()
    {
        return 'slug';
    }
}