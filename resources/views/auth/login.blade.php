@extends('layout.app')

@section('title', 'Login - My Todo App')

@section('content')
<div class="min-h-[calc(100vh-120px)] flex items-center justify-center">
    <div class="glass rounded-2xl p-8 w-full max-w-md">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-white mb-2">Welcome Back</h2>
            <p class="text-white/70">Sign in to your account</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-white/90 mb-2">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                    autofocus
                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent transition-all duration-200 @error('email') border-red-400 @enderror"
                    placeholder="Enter your email">
                @error('email')
                <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-white/90 mb-2">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent transition-all duration-200 @error('password') border-red-400 @enderror"
                    placeholder="Enter your password">
                @error('password')
                <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-white/20 rounded bg-white/10">
                    <label for="remember" class="ml-2 block text-sm text-white/70">
                        Remember me
                    </label>
                </div>

                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-sm text-white/70 hover:text-white transition-colors">
                    Forgot password?
                </a>
                @endif
            </div>

            <button type="submit"
                class="w-full btn-primary text-white font-semibold py-3 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Sign In
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-white/70">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-white hover:text-white/80 font-medium transition-colors">
                    Sign up
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
