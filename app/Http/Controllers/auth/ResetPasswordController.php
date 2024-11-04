<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OtpVerification;
use App\Models\User;

class ResetPasswordController extends Controller
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

        if ($passwordReset) {
            $user = User::firstWhere('email', $passwordReset->email);
            $user->update($request->only('password'));
            $passwordReset->delete();

            return response()->json([
                'status' => true,
                'message' => 'Password updated successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Otp is invalid'
        ]);

        
    }
}
