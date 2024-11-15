<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'artist',
        'duration',
        'file_path',
        'artwork_path',
        'bpm',
        'key',
        'plays_count',
        'likes_count',
        'is_featured',
        'status'
    ];

    protected $casts = [
        'duration' => 'integer',
        'bpm' => 'integer',
        'plays_count' => 'integer',
        'likes_count' => 'integer',
        'is_featured' => 'boolean'
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function moods()
    {
        return $this->belongsToMany(Mood::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }


    public function licenses()
    {
        return $this->hasMany(License::class);
    }

    public function getFormattedDurationAttribute()
    {
        $minutes = floor($this->duration / 60);
        $seconds = $this->duration % 60;
        return sprintf('%d:%02d', $minutes, $seconds);
    }

    public function getArtworkUrlAttribute()
    {
        return $this->artwork_path ? asset('storage/' . $this->artwork_path) : asset('images/default-artwork.jpg');
    }

    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopePopular($query)
    {
        return $query->orderBy('plays_count', 'desc');
    }
}