<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'description',
        'price',
        'capacity',
        'is_available'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'capacity' => 'integer',
        'is_available' => 'boolean'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getRemainingCapacityAttribute()
    {
        if ($this->capacity === null) {
            return null; // Unlimited capacity
        }
        
        $bookedCount = $this->bookings()->count();
        return max(0, $this->capacity - $bookedCount);
    }

    public function getIsAvailableAttribute()
    {
        if ($this->capacity === null) {
            return true;
        }
        
        return $this->remaining_capacity > 0;
    }
} 