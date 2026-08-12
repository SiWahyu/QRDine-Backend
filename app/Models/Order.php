<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'restaurant_id',
        'user_id',
        'table_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'order_number',
        'payment_method',
        'payment_status',
        'payment_expired_at',
        'status',
        'subtotal',
        'note',
        'tax_amount',
        'service_amount',
        'total',
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class, 'table_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'payment_expired_at' => 'datetime',
    ];
}