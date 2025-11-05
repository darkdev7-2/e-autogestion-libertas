<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'type',
        'due_at',
        'status',
        'notes',
    ];

    protected $casts = [
        'due_at' => 'date',
    ];

    /**
     * Get the vehicle that owns the reminder.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Scope to get pending reminders.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to get reminders due soon.
     */
    public function scopeDueSoon($query, int $days = 14)
    {
        return $query->where('due_at', '<=', now()->addDays($days))
                     ->where('due_at', '>=', now());
    }

    /**
     * Scope to get overdue reminders.
     */
    public function scopeOverdue($query)
    {
        return $query->where('due_at', '<', now())
                     ->where('status', '!=', 'paid');
    }
}
