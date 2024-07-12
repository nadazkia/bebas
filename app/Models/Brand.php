<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $with = ['categories'];

    protected $fillable = [
        'name',
        'category',
        'description',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'brand_category')->withTimestamps();
    }

    
}
