<?php
// app/Models/Mood.php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Mood extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    // Relația cu tracks
    public function tracks()
    {
        return $this->belongsToMany(Track::class);
    }

    // Generare automată slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($mood) {
            if (!$mood->slug) {
                $mood->slug = Str::slug($mood->name);
            }
        });
    }
}