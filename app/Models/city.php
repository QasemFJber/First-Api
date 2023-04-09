<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    use HasFactory;
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'name','zip_code','country',
    ];
}
