<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class OtpVerification extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_EXPIRED = 'expired';
    const STATUS_VERIFIED = 'verified';

    protected $fillable = [
        'email',
        'otp',
        'created_at',
    ];

    public function isExpire()
    {
        if ($this->created_at < Carbon::now()->subMinutes(2)) {
            $this->delete();
            return true;
        }
    }
}
