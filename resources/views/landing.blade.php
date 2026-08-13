<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="devshelf — Your personal developer bookmark dashboard.">
    <title>devshelf — Organize Your Developer Tools</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
        body { background: #f4f4f7; }
        .bento-card {
            background: #fff;
            border: 1px solid rgba(0,0,0,0.04);
            border-radius: 1.25rem;
            transition: box-shadow 0.25s ease, transform 0.25s ease;
        }
        .bento-card:hover {
            box-shadow: 0 8px 30px rgba(0,0,0,0.06);
            transform: translateY(-2px);
        }
        .gradient-wave {
            background-image: linear-gradient(135deg, #7c3aed 0%, #a855f7 40%, #ec4899 100%);
        }
    </style>
</head>
<body class="min-h-screen antialiased text-neutral-800 flex flex-col">

    {{-- Header Navigation --}}
    <nav class="sticky top-0 z-50 backdrop-blur-xl bg-[#f4f4f7]/80 border-b border-black/[0.04]">
        <div class="max-w-7xl mx-auto px-5 h-20 flex items-center justify-between">
            {{-- Logo --}}
            <a href="/" class="flex items-center gap-2.5 group select-none">
                <img src="{{ asset('devshelf-logo.svg') }}" alt="devshelf logo" class="w-10 h-10">
                <span class="text-xl font-extrabold tracking-tight text-neutral-900">devshelf</span>
            </a>

            {{-- Auth Buttons --}}
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-neutral-600 hover:text-neutral-900 transition-colors">Log In</a>
                <a href="{{ route('register') }}" class="inline-flex items-center bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold rounded-full px-6 py-2.5 shadow-lg shadow-purple-600/25 transition-all duration-200 hover:shadow-purple-600/40 hover:scale-[1.03] active:scale-95">
                    Get Started
                </a>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="flex-1 flex flex-col items-center justify-center pt-20 pb-16 px-5 max-w-7xl mx-auto w-full">
        
        {{-- Hero Section --}}
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h1 class="text-5xl sm:text-6xl font-black text-neutral-900 tracking-tight leading-tight mb-6">
                Your personal developer <br class="hidden sm:block" />
                <span class="text-transparent bg-clip-text gradient-wave">bookmark dashboard.</span>
            </h1>
            <p class="text-lg text-neutral-500 mb-10 max-w-2xl mx-auto leading-relaxed">
                Stop losing important documentation and tools in endless browser tabs. devshelf helps you organize, categorize, and access your favorite developer resources instantly.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex items-center justify-center bg-neutral-900 hover:bg-neutral-800 text-white text-base font-bold rounded-full px-8 py-4 shadow-xl shadow-neutral-900/20 transition-all hover:scale-[1.02]">
                    Start organizing for free
                </a>
                <a href="#preview" class="w-full sm:w-auto inline-flex items-center justify-center bg-white border border-neutral-200 text-neutral-700 hover:bg-neutral-50 text-base font-bold rounded-full px-8 py-4 transition-all">
                    See how it works
                </a>
            </div>
        </div>

        {{-- Live Preview Component --}}
        <div id="preview" class="w-full max-w-4xl mx-auto mb-24 perspective-1000">
            <div class="relative rounded-3xl bg-neutral-900 border border-neutral-800 shadow-2xl p-6 sm:p-10 overflow-hidden transform hover:-translate-y-2 transition-transform duration-500">
                <div class="absolute -top-20 -right-20 w-64 h-64 rounded-full gradient-wave opacity-20 blur-3xl"></div>
                
                {{-- Mock Bento Card --}}
                <div class="relative z-10 bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-md max-w-sm mx-auto">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-widest text-emerald-400 bg-emerald-400/10 px-2.5 py-1 rounded-lg">Backend</span>
                        </div>
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-purple-400 bg-purple-400/10">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-white leading-snug mb-1">Laravel Documentation</h3>
                    <p class="text-sm text-neutral-400 mb-4 line-clamp-2">The official Laravel PHP framework documentation. Covers routing, Eloquent ORM, Blade templates...</p>
                    <div class="flex gap-2">
                        <span class="text-[11px] font-semibold text-neutral-300 bg-white/5 px-2.5 py-1 rounded-lg">#php</span>
                        <span class="text-[11px] font-semibold text-neutral-300 bg-white/5 px-2.5 py-1 rounded-lg">#framework</span>
                    </div>
                </div>
                
                <p class="text-center text-neutral-400 text-sm mt-8 font-medium tracking-wide">BEAUTIFULLY ORGANIZED, ALWAYS ACCESSIBLE</p>
            </div>
        </div>

        {{-- Feature Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-5xl mx-auto">
            {{-- Feature 1 --}}
            <div class="bento-card p-8">
                <div class="w-12 h-12 rounded-2xl bg-purple-50 flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-neutral-900 mb-2">Fast Filtering</h3>
                <p class="text-neutral-500 text-sm leading-relaxed">Instantly find the exact tool or documentation page you need with real-time search and category tabs.</p>
            </div>
            
            {{-- Feature 2 --}}
            <div class="bento-card p-8">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-neutral-900 mb-2">Custom Categories</h3>
                <p class="text-neutral-500 text-sm leading-relaxed">Tag and organize your resources into logical buckets like Frontend, Backend, DevOps, or Design.</p>
            </div>

            {{-- Feature 3 --}}
            <div class="bento-card p-8">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-neutral-900 mb-2">One-Click Copy</h3>
                <p class="text-neutral-500 text-sm leading-relaxed">Grab URLs instantly with a single click. No more opening new tabs just to copy a link for a teammate.</p>
            </div>
        </div>

    </main>

    <footer class="py-8 text-center border-t border-black/5 mt-auto">
        <p class="text-sm text-neutral-400 font-medium">&copy; {{ date('Y') }} devshelf. Built for developers.</p>
    </footer>

</body>
</html>
