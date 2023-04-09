<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
    ];

    protected $fillable = [
        'image','description','price','quantity','name',
    ];
}
