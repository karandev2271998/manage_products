<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OtpVerification;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendForgetPasswordOtp;
class ForgotPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        OtpVerification::where('email', $request->email)->delete();
        $data['otp'] = mt_rand(100000, 999999);
        $codeData = OtpVerification::create($data);
        Mail::to($request->email)->send(new SendForgetPasswordOtp($codeData->otp));
        return response(['message' => trans('passwords.sent')], 200);
    }
}
