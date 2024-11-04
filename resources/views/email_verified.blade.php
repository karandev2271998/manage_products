@extends('layouts.email_layout')
@section('title', 'Email verification')
@section('email_content')
<div class="container min-vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow-sm" style="max-width: 400px; width: 100%;">
        <div class="card-body text-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="#28a745" class="bi bi-check-circle mb-4" viewBox="0 0 16 16">
                <path d="M10.97 4.97a.75.75 0 1 1 1.06 1.06L7.5 10.56 5.47 8.53a.75.75 0 0 1 1.06-1.06l1.97 1.97 4.47-4.47z"/>
                <path d="M16 8a8 8 0 1 1-16 0 8 8 0 0 1 16 0zM1.5 8a6.5 6.5 0 1 0 13 0 6.5 6.5 0 0 0-13 0z"/>
            </svg>
            <h4 class="card-title mb-3">Email Verified Successfully!</h4>
            <p class="card-text text-muted mb-4">
                Thank you! Your email address has been verified successfully.
            </p>
        </div>
    </div>
</div>
@endsection