<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'check_in',
        'check_out',
        'room_id',
        'user_id',
        'status', // added
        
    ];

    protected $appends = ['stayDays'];

    protected $casts = [
        'check_in'  => 'datetime',
        'check_out' => 'datetime',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'room_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getStayDaysAttribute()
    {
        return ($this->check_in && $this->check_out)
            ? $this->check_in->diffInDays($this->check_out)
            : 0;
    }
    public function orders()
{
    return $this->hasMany(Order::class, 'room_id');
}
}
















