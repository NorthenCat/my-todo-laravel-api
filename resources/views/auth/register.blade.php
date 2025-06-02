@extends('layout.app')

@section('title', 'Register - My Todo App')

@section('content')
<div class="min-h-[calc(100vh-120px)] flex items-center justify-center">
    <div class="glass rounded-2xl p-8 w-full max-w-md">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-white mb-2">Join Us</h2>
            <p class="text-white/70">Create your account to get started</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div>
                <label for="username" class="block text-sm font-medium text-white/90 mb-2">Username</label>
                <input id="username" type="text" name="username" value="{{ old('username') }}" required
                    autocomplete="username" autofocus
                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent transition-all duration-200 @error('username') border-red-400 @enderror"
                    placeholder="Choose a username">
                @error('username')
                <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-white/90 mb-2">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent transition-all duration-200 @error('email') border-red-400 @enderror"
                    placeholder="Enter your email">
                @error('email')
                <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-white/90 mb-2">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent transition-all duration-200 @error('password') border-red-400 @enderror"
                    placeholder="Create a password">
                @error('password')
                <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-white/90 mb-2">Confirm
                    Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    autocomplete="new-password"
                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent transition-all duration-200"
                    placeholder="Confirm your password">
            </div>

            <button type="submit"
                class="w-full btn-primary text-white font-semibold py-3 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Create Account
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-white/70">
                Already have an account?
                <a href="{{ route('login') }}" class="text-white hover:text-white/80 font-medium transition-colors">
                    Sign in
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
