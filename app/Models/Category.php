<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $with = ['brands'];


    protected $fillable = [
        'name',
    ];

    public function brands()
    {
        // 1 Brand bisa punya banyak category
        // 1 category bisa dimiliki oleh banyak brand berbeda
        return $this->belongsToMany(Brand::class, 'brand_category')->withTimestamps();
    }
}
