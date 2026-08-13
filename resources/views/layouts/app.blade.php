<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="DevShelf — Your curated developer resource hub.">
    <title>{{ config('app.name', 'DevShelf') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
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
        .pill-tab {
            display: inline-flex; align-items: center; gap: 0.35rem;
            padding: 0.45rem 1.1rem; border-radius: 9999px;
            font-size: 0.82rem; font-weight: 600;
            transition: all 0.2s ease; cursor: pointer;
            white-space: nowrap; border: 1.5px solid transparent;
        }
        .pill-tab.active { background: #7c3aed; color: #fff; border-color: #7c3aed; }
        .pill-tab:not(.active) { background: #fff; color: #6b7280; border-color: #e5e7eb; }
        .pill-tab:not(.active):hover { background: #f3f4f6; color: #111827; border-color: #d1d5db; }
        .gradient-wave {
            background-image: linear-gradient(135deg, #7c3aed 0%, #a855f7 40%, #ec4899 100%);
        }
        .stat-glow { box-shadow: 0 0 40px rgba(124,58,237,0.08); }
        .action-bar { opacity: 0; transition: opacity 0.2s ease; }
        .bento-card:hover .action-bar { opacity: 1; }

        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="min-h-screen antialiased text-neutral-800"
      x-data="{ loading: false }"
      @submit.window="loading = true">

    {{-- Global Loading Overlay --}}
    <div x-show="loading" x-cloak class="fixed inset-0 z-[9999] bg-[#f4f4f7]/80 backdrop-blur-sm flex flex-col items-center justify-center">
        <div class="w-12 h-12 rounded-full border-4 border-purple-200 border-t-purple-600 animate-spin mb-4 shadow-xl shadow-purple-500/20"></div>
        <p class="text-sm font-bold text-neutral-700 animate-pulse">Processing...</p>
    </div>

    {{-- ── Navbar ── --}}
    <nav class="sticky top-0 z-50 backdrop-blur-xl bg-[#f4f4f7]/80 border-b border-black/[0.04]">
        <div class="max-w-7xl mx-auto px-5 h-16 flex items-center justify-between">
            {{-- Logo --}}
            <a href="{{ route('resources.index') }}" class="flex items-center gap-2.5 group select-none">
                <div class="w-9 h-9 rounded-xl gradient-wave flex items-center justify-center shadow-lg shadow-purple-500/20">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <span class="text-lg font-extrabold tracking-tight text-neutral-900">DevShelf</span>
            </a>

            {{-- Center Pill Tabs --}}
            <div class="hidden md:flex items-center gap-1.5 bg-white border border-black/[0.06] rounded-full p-1 shadow-sm">
                <a href="{{ route('resources.index') }}" class="pill-tab {{ !request('filter') ? 'active' : '' }}">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                    All Links
                </a>
                <a href="{{ route('resources.index', ['filter' => 'favorites']) }}" class="pill-tab {{ request('filter') === 'favorites' ? 'active' : '' }}">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    Favorites
                </a>
                <a href="{{ route('resources.index') }}#categories" class="pill-tab">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    Categories
                </a>
            </div>

            {{-- Add Button --}}
            <a href="{{ route('resources.create') }}" class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold rounded-full px-5 py-2.5 shadow-lg shadow-purple-600/25 transition-all duration-200 hover:shadow-purple-600/40 hover:scale-[1.03] active:scale-95">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                <span class="hidden sm:inline">Add Resource</span>
            </a>
        </div>
    </nav>

    {{-- ── Alpine.js Flash Toast (bottom-right) ── --}}
    @if(session('success'))
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 3000)"
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-4"
             class="fixed bottom-6 right-6 z-[100]">
            <div class="flex items-center gap-3 bg-white border border-emerald-200 text-emerald-700 rounded-2xl pl-4 pr-3 py-3 shadow-xl shadow-emerald-500/10 text-sm font-medium">
                <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('success') }}</span>
                <button @click="show = false" class="ml-2 w-6 h-6 rounded-lg flex items-center justify-center text-neutral-400 hover:text-neutral-600 hover:bg-neutral-100 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    @endif

    {{-- ── Main Content ── --}}
    <main class="max-w-7xl mx-auto px-5 py-8">
        @yield('content')
    </main>

</body>
</html>
