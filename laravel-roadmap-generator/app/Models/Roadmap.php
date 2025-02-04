<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_name',
        'duration',
        'level',
        'purpose',
        'response'
    ];
}