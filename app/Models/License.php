<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class License extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'track_id',
        'license_type',
        'price',
        'transaction_id',
        'license_details',
        'valid_from',
        'valid_until',
        'status',
        'usage_terms'
    ];

    protected $casts = [
        'license_details' => 'array',
        'price' => 'decimal:2',
        'valid_from' => 'datetime',
        'valid_until' => 'datetime'
    ];

    // Relații
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                    ->where('valid_from', '<=', now())
                    ->where(function($q) {
                        $q->whereNull('valid_until')
                          ->orWhere('valid_until', '>=', now());
                    });
    }

    // Helper methods
    public function isValid()
    {
        return $this->status === 'active' &&
               $this->valid_from <= now() &&
               ($this->valid_until === null || $this->valid_until >= now());
    }

    public function revoke()
    {
        $this->update(['status' => 'revoked']);
    }
}