<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'fullName',
        'email',
        'mobile',
        'address',
        'city',
        'pin',
        'payment_method',
        'screenshot',
        'total',
        'gst',
        'status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
