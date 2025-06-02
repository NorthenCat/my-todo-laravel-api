@extends('layout.app')

@section('title', 'Welcome - My Todo App')

@section('content')
<div class="min-h-screen flex items-center justify-center -mt-8">
    <div class="max-w-4xl mx-auto text-center">
        <!-- Hero Section -->
        <div class="glass rounded-3xl p-12 mb-8">
            <div class="mb-8">
                <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
                    Organize Your
                    <span class="bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                        Life
                    </span>
                </h1>
                <p class="text-xl text-white/80 mb-8 max-w-2xl mx-auto">
                    A beautiful, minimalist todo app that helps you stay focused and productive.
                    Manage your tasks with style and simplicity.
                </p>
            </div>

            <!-- Feature Icons -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-white/10 rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">Simple & Clean</h3>
                    <p class="text-white/70">Beautiful interface that focuses on what matters most</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-white/10 rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">Daily Planning</h3>
                    <p class="text-white/70">Organize your tasks by date and time</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-white/10 rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">Color Coding</h3>
                    <p class="text-white/70">Categorize your tasks with beautiful colors</p>
                </div>
            </div>

            <!-- CTA Buttons -->
            @guest
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}"
                    class="btn-primary text-white font-semibold py-4 px-8 rounded-xl text-lg inline-block">
                    Get Started Free
                </a>
                <a href="{{ route('login') }}"
                    class="bg-white/10 text-white font-semibold py-4 px-8 rounded-xl text-lg hover:bg-white/20 transition-colors inline-block">
                    Sign In
                </a>
            </div>
            @else
            <div>
                <a href="{{ route('tasks.index') }}"
                    class="btn-primary text-white font-semibold py-4 px-8 rounded-xl text-lg inline-block">
                    Go to Your Tasks
                </a>
            </div>
            @endguest
        </div>

        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="glass rounded-2xl p-6 text-center">
                <div class="text-3xl font-bold text-white mb-2">10K+</div>
                <div class="text-white/70">Tasks Completed</div>
            </div>
            <div class="glass rounded-2xl p-6 text-center">
                <div class="text-3xl font-bold text-white mb-2">5K+</div>
                <div class="text-white/70">Happy Users</div>
            </div>
            <div class="glass rounded-2xl p-6 text-center">
                <div class="text-3xl font-bold text-white mb-2">99.9%</div>
                <div class="text-white/70">Uptime</div>
            </div>
        </div>
    </div>
</div>
@endsection
