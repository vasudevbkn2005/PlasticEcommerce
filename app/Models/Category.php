<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category_id', 'cimage', 'name'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
