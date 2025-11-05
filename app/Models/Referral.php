<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Referral extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'referred_user_id',
        'bonus_cfa',
        'status',
        'activated_at',
    ];

    protected $casts = [
        'bonus_cfa' => 'decimal:2',
        'activated_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($referral) {
            if (empty($referral->code)) {
                $referral->code = static::generateUniqueCode();
            }
        });
    }

    /**
     * Generate a unique referral code.
     */
    protected static function generateUniqueCode(): string
    {
        do {
            $code = strtoupper(Str::random(8));
        } while (static::where('code', $code)->exists());

        return $code;
    }

    /**
     * Get the user that owns the referral (the referrer).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the referred user.
     */
    public function referredUser()
    {
        return $this->belongsTo(User::class, 'referred_user_id');
    }

    /**
     * Scope to get active referrals.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Activate the referral.
     */
    public function activate(): void
    {
        $this->update([
            'status' => 'active',
            'activated_at' => now(),
        ]);
    }
}
