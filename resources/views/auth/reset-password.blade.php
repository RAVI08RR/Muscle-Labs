@extends('layouts.app')

@section('title', 'Set New Password — Muscle Labs UK')

@section('content')
<div class="section flex items-center min-h-[60vh]">
    <div class="container max-w-md">
        <div class="card p-8 space-y-4">
            <h1 class="text-2xl font-extrabold text-white text-center">Set New Password</h1>

            <form action="{{ route('password.update') }}" method="POST" class="space-y-4 pt-2">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label class="label">Email Address</label>
                    <input type="email" name="email" required class="input">
                </div>

                <div>
                    <label class="label">New Password</label>
                    <input type="password" name="password" required class="input">
                </div>

                <div>
                    <label class="label">Confirm New Password</label>
                    <input type="password" name="password_confirmation" required class="input">
                </div>

                <button type="submit" class="btn btn-primary w-full">Reset Password</button>
            </form>
        </div>
    </div>
</div>
@endsection
