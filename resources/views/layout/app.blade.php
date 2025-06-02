<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'My Todo App')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .task-card {
            transition: all 0.3s ease;
        }

        .task-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
    </style>
</head>

<body class="min-h-screen gradient-bg">
    <nav class="glass border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-white">My Todo</h1>
                </div>

                @auth
                <div class="flex items-center space-x-4">
                    <span class="text-white/80">Hello, {{ Auth::user()->username }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-white/80 hover:text-white transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
                @else
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-white/80 hover:text-white transition-colors">Login</a>
                    <a href="{{ route('register') }}"
                        class="bg-white/20 text-white px-4 py-2 rounded-lg hover:bg-white/30 transition-colors">Register</a>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-500/20 border border-green-500/30 rounded-lg text-green-100">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-500/20 border border-red-500/30 rounded-lg text-red-100">
            {{ session('error') }}
        </div>
        @endif

        @yield('content')
    </main>

    <script>
        // Add some basic JavaScript for interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth transitions
            const cards = document.querySelectorAll('.task-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
