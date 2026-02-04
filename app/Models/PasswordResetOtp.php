<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetOtp extends Model
{
    protected $table = 'password_reset_otps';

    protected $fillable = ['email', 'otp', 'expires_at'];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function isExpired()
    {
        return $this->expires_at->isPast();
    }

    public static function generateOtp($email)
    {
        static::where('email', $email)->delete();
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        return static::create([
            'email' => $email,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(10),
        ]);
    }

    public static function verifyOtp($email, $otp)
    {
        $record = static::where('email', $email)
            ->where('otp', $otp)
            ->first();

        if (!$record) {
            return false;
        }

        if ($record->isExpired()) {
            $record->delete();
            return false;
        }

        return true;
    }
}
