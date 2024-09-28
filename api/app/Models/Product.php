<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false; // a product táblában nincs created_at és updated_at mező amit laravel keresne

    protected $fillable = [
        'category',
        'name',
        'description',
        'picture',
        'price',
        'stock'
    ];
}
