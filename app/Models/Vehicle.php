<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'brand',
        'model',
        'registration_number',
        'insurance_expiry',
        'inspection_due_at',
        'documents_json',
    ];

    protected $casts = [
        'insurance_expiry' => 'date',
        'inspection_due_at' => 'date',
        'documents_json' => 'array',
    ];

    /**
     * Get the client that owns the vehicle.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get all reminders for the vehicle.
     */
    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }

    /**
     * Get all service requests for the vehicle.
     */
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class);
    }

    /**
     * Check if insurance is expiring soon.
     */
    public function isInsuranceExpiring(int $days = 14): bool
    {
        if (!$this->insurance_expiry) {
            return false;
        }

        return $this->insurance_expiry->diffInDays(now()) <= $days && $this->insurance_expiry->isFuture();
    }

    /**
     * Check if inspection is due soon.
     */
    public function isInspectionDue(int $days = 14): bool
    {
        if (!$this->inspection_due_at) {
            return false;
        }

        return $this->inspection_due_at->diffInDays(now()) <= $days && $this->inspection_due_at->isFuture();
    }
}
