<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BloodArticle extends Model
{
    use HasFactory;

    protected $table = 'blood_articles';

    protected $fillable = [
        'title',
        'date',
        'hospital_name',
        'blood_type',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
