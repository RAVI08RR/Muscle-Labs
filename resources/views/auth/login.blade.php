@extends('layouts.app')

@section('title', 'Sign In — Muscle Labs UK')

@section('content')
<div class="section flex items-center min-h-[70vh]">
    <div class="container max-w-md">
        <div class="card p-8 space-y-6">
            <div class="text-center">
                <span class="section-label">Account Access</span>
                <h1 class="text-2xl font-extrabold text-white mt-1">Sign In to Muscle Labs</h1>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="label">Email Address</label>
                    <input type="email" name="email" required value="{{ old('email') }}" class="input">
                </div>

                <div>
                    <label class="label">Password</label>
                    <input type="password" name="password" required class="input">
                </div>

                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center gap-2 text-[var(--color-text-secondary)]">
                        <input type="checkbox" name="remember" class="rounded border-slate-700 bg-slate-900 text-violet-500">
                        Remember Me
                    </label>

                    <a href="{{ route('password.request') }}" class="text-[var(--color-accent-light)] hover:underline">Forgot Password?</a>
                </div>

                <button type="submit" class="btn btn-primary w-full btn-lg">
                    Sign In
                </button>

                <div class="text-center text-xs text-[var(--color-text-secondary)] pt-4 border-t border-[var(--color-border)]">
                    Don't have an account? <a href="{{ route('register') }}" class="text-[var(--color-accent-light)] font-bold hover:underline">Register here</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
