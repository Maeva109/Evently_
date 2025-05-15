<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'user_id',
        'event_id',
        'ticket_type_id',
        'quantity',
        'total_price',
        'status',
        'special_requests',
        'cancelled_at'
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'quantity' => 'integer',
        'cancelled_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }

    public function canBeCancelled()
    {
        if ($this->status === self::STATUS_CANCELLED) {
            return false;
        }

        // Check if the event is more than 48 hours away
        return $this->event->start_date->diffInHours(now()) > 48;
    }

    public function cancel()
    {
        if ($this->canBeCancelled()) {
            $this->update([
                'status' => self::STATUS_CANCELLED,
                'cancelled_at' => now()
            ]);
            return true;
        }
        return false;
    }
} 