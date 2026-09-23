@extends('layouts.app')

@section('title', 'Register Account — Muscle Labs UK')

@section('content')
<div class="section flex items-center min-h-[70vh]">
    <div class="container max-w-md">
        <div class="card p-8 space-y-6">
            <div class="text-center">
                <span class="section-label">Create Account</span>
                <h1 class="text-2xl font-extrabold text-white mt-1">Register for Muscle Labs</h1>
            </div>

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="label">Full Name</label>
                    <input type="text" name="name" required value="{{ old('name') }}" class="input">
                </div>

                <div>
                    <label class="label">Email Address</label>
                    <input type="email" name="email" required value="{{ old('email') }}" class="input">
                </div>

                <div>
                    <label class="label">Password</label>
                    <input type="password" name="password" required class="input">
                </div>

                <div>
                    <label class="label">Confirm Password</label>
                    <input type="password" name="password_confirmation" required class="input">
                </div>

                <button type="submit" class="btn btn-primary w-full btn-lg">
                    Create Account
                </button>

                <div class="text-center text-xs text-[var(--color-text-secondary)] pt-4 border-t border-[var(--color-border)]">
                    Already registered? <a href="{{ route('login') }}" class="text-[var(--color-accent-light)] font-bold hover:underline">Sign in here</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
