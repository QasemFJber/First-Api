<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
    ];

    protected $fillable = [
        'name','address','phone_number','email'
    ];
}
