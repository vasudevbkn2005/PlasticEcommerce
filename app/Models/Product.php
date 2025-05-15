<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ['name', 'mimage','description'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function otherImages()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }
    public function bulkOrders()
    {
        return $this->hasMany(Bulk::class);
    }
    public function bulk()
    {
        return $this->hasOne(Bulk::class);
    }
}
