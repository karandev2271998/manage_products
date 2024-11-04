<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OtpVerification;
class OtpCheckController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $passwordReset = OtpVerification::firstWhere('otp', $request->otp);
        if ($passwordReset && $passwordReset->isExpire()) {
            return response()->json(['message' => 'Code is expired']);
        }
        return response()->json([
            'status' => true,
            'message' => 'Code is valid',
            'otp' => $passwordReset->otp
        ]);
    }
}
