<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Hospital extends Authenticatable
{
    use HasFactory;

    protected $table = 'hospitals';

    protected $fillable = [
        'hospital_id',
        'hospital_reg_number',
        'mobile_number1',
        'mobile_number2',
        'address',
        'user_name',
        'email',
        'password',
        'district',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $hidden = [
        'password',
    ];

    // Hash password when setting
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
