@extends('layouts.app')

@section('title', 'Account Settings — Muscle Labs UK')

@section('content')
<div class="py-12 border-b border-[var(--color-border)] bg-[var(--color-bg-surface)]">
    <div class="container max-w-xl">
        <h1 class="text-3xl font-extrabold text-white">Profile Settings</h1>
    </div>
</div>

<div class="section">
    <div class="container max-w-xl">
        <div class="card p-8">
            <form action="{{ route('account.profile.update') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="label">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="input">
                </div>

                <div>
                    <label class="label">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="input">
                </div>

                <div>
                    <label class="label">New Password (leave blank to keep current)</label>
                    <input type="password" name="password" class="input">
                </div>

                <button type="submit" class="btn btn-primary w-full">Save Changes</button>
            </form>
        </div>
    </div>
</div>
@endsection
