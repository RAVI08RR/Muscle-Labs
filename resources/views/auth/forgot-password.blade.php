@extends('layouts.app')

@section('title', 'Forgot Password — Muscle Labs UK')

@section('content')
<div class="section flex items-center min-h-[60vh]">
    <div class="container max-w-md">
        <div class="card p-8 space-y-4">
            <h1 class="text-2xl font-extrabold text-white text-center">Reset Password</h1>
            <p class="text-xs text-[var(--color-text-secondary)] text-center">Enter your email address and we will send you a password reset link.</p>

            <form action="{{ route('password.email') }}" method="POST" class="space-y-4 pt-2">
                @csrf
                <div>
                    <label class="label">Email Address</label>
                    <input type="email" name="email" required class="input">
                </div>

                <button type="submit" class="btn btn-primary w-full">Send Reset Link</button>
            </form>
        </div>
    </div>
</div>
@endsection
