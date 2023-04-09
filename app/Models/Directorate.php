<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directorate extends Model
{
    use HasFactory;
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
    ];

    protected $fillable = [
        'departments',
        'teachers_number',
        'students_number',
        'educational_director_phone_number',
        'educational_director_name',
        'email',
        'phone_number',
        'address',
        'educational_district',
        'type',
        'name',

    ];
}
