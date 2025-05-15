<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bulk extends Model
{
    protected $fillable = ['user_id', 'product_id', 'bulk_order_quantity', 'price'];

    // Relationship to Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor to get the total price (bulk_order_quantity * price)
    public function getTotalPriceAttribute()
    {
        return $this->bulk_order_quantity * $this->price;
    }
}