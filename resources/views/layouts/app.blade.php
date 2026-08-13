<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'DevShelf') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Inline script to avoid flash of wrong theme -->
    <script>
        const savedTheme = localStorage.getItem('theme') || 'dark';
        document.documentElement.setAttribute('data-theme', savedTheme);
    </script>
</head>
<body class="min-h-screen bg-base-200 font-sans antialiased text-base-content transition-colors duration-300">
    
    <!-- Navbar -->
    <nav class="navbar bg-base-100 shadow-sm sticky top-0 z-50 backdrop-blur-md bg-opacity-80">
        <div class="flex-1">
            <a href="{{ route('resources.index') }}" class="btn btn-ghost normal-case text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-primary to-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                DevShelf
            </a>
        </div>
        <div class="flex-none gap-2">
            <button id="theme-toggle" class="btn btn-circle btn-ghost" aria-label="Toggle theme">
                <!-- Sun / Moon icons swapped via JS -->
                <svg id="theme-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </button>
            <a href="{{ route('resources.create') }}" class="btn btn-primary btn-sm md:btn-md shadow-lg shadow-primary/30 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                New Resource
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="toast toast-top toast-center z-[100] mt-16">
                <div class="alert alert-success shadow-lg text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Theme Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const html = document.documentElement;
            const themeToggle = document.getElementById('theme-toggle');
            const themeIcon = document.getElementById('theme-icon');

            const moonIcon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />';
            const sunIcon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />';

            function updateIcon(theme) {
                themeIcon.innerHTML = theme === 'dark' ? sunIcon : moonIcon;
            }

            updateIcon(html.getAttribute('data-theme'));

            themeToggle.addEventListener('click', () => {
                const currentTheme = html.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                html.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateIcon(newTheme);
            });
            
            // Auto dismiss toast
            const toasts = document.querySelectorAll('.toast');
            if(toasts.length > 0) {
                setTimeout(() => {
                    toasts.forEach(t => t.style.opacity = '0');
                    setTimeout(() => toasts.forEach(t => t.remove()), 300);
                }, 3000);
            }
        });
    </script>
</body>
</html>
