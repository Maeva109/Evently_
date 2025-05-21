<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
        'image',
        'start_date',
        'end_date',
        'is_published',
        'is_active',
        'created_by',
        'capacity',
        'price',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_published' => 'boolean',
        'is_active' => 'boolean',
        'capacity' => 'integer',
        'price' => 'decimal:2',
    ];

    protected $appends = ['remaining_capacity'];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($event) {
            $event->slug = Str::slug($event->title);
        });
    }

    // Relation avec l'utilisateur (créateur de l'événement)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function photos()
    {
        return $this->hasMany(EventPhoto::class);
    }

    public function ticketTypes()
    {
        return $this->hasMany(TicketType::class);
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

    public function isFullyBooked()
    {
        if ($this->capacity === null) {
            return false; // Unlimited capacity
        }
        
        return $this->remaining_capacity <= 0;
    }
}