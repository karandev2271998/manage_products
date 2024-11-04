@extends('layouts.email_layout')
@section('title', 'One Time Password for password recovery')
@section('email_content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg w-100" style="max-width: 600px;">
        <div class="card-body">
            <h2 class="card-title text-center text-primary mb-4">Password Recovery OTP</h2>
            <p>Hello,</p>
            <p>To reset your password, please use the one-time password (OTP) provided below. This OTP is valid for only 2 minutes.</p>
            
            <div class="text-center py-3">
                <span class="display-6 fw-bold text-danger bg-danger bg-opacity-10 p-3 rounded">{{ $otp }}</span>
            </div>
            <p class="text-muted small">Thank you,<br>{{ env('APP_NAME') }}</p>
        </div>
    </div>
</div>
@endsection