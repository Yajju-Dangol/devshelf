@extends('layouts.app')

@section('content')
<div class="space-y-8">

    {{-- ═══════════════════════════════════════════
         BENTO SUMMARY GRID
    ═══════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        {{-- Stat 1 — Total Resources --}}
        <div class="bento-card p-6 flex items-center gap-5 stat-glow">
            <div class="w-14 h-14 rounded-2xl bg-purple-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-7 h-7 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-neutral-400 uppercase tracking-wider mb-0.5">Total Resources</p>
                <p class="text-3xl font-extrabold text-neutral-900 leading-none">{{ $totalCount }}</p>
            </div>
        </div>

        {{-- Stat 2 — Featured / Top Category (Dark Card) --}}
        <div class="relative overflow-hidden rounded-3xl bg-neutral-900 text-white p-6 flex flex-col justify-between min-h-[140px]">
            {{-- Gradient wave accent --}}
            <div class="absolute -bottom-8 -right-8 w-40 h-40 rounded-full gradient-wave opacity-30 blur-2xl"></div>
            <div class="absolute top-0 right-0 w-24 h-24 rounded-full bg-purple-500/10 blur-xl"></div>
            <div class="relative z-10">
                <p class="text-xs font-semibold text-neutral-400 uppercase tracking-wider mb-1">Top Category</p>
                <p class="text-2xl font-extrabold leading-tight">{{ $topCategory }}</p>
            </div>
            <div class="relative z-10 flex items-center gap-2 mt-3">
                <div class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></div>
                <p class="text-xs text-neutral-400">Most bookmarked</p>
            </div>
        </div>

        {{-- Stat 3 — Favorites --}}
        <div class="bento-card p-6 flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-rose-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-7 h-7 text-rose-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-neutral-400 uppercase tracking-wider mb-0.5">Favorites Saved</p>
                <p class="text-3xl font-extrabold text-neutral-900 leading-none">{{ $favoritesCount }}</p>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════
         SEARCH + CATEGORY FILTER BAR
    ═══════════════════════════════════════════ --}}
    <div class="bento-card p-5" id="categories">
        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
            {{-- Search --}}
            <form method="GET" action="{{ route('resources.index') }}" class="relative flex-1 max-w-md" id="search-form">
                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4.5 h-4.5 text-neutral-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search resources..." class="w-full pl-11 pr-4 py-2.5 bg-[#f4f4f7] border border-transparent focus:border-purple-300 focus:bg-white rounded-xl text-sm font-medium text-neutral-700 placeholder-neutral-400 outline-none transition-all duration-200 focus:ring-2 focus:ring-purple-500/20" />
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if(request('filter'))
                    <input type="hidden" name="filter" value="{{ request('filter') }}">
                @endif
            </form>

            {{-- Category Pills --}}
            <div class="flex items-center gap-2 overflow-x-auto scrollbar-hide pb-1 flex-1">
                <a href="{{ route('resources.index', array_filter(['search' => request('search'), 'filter' => request('filter')])) }}"
                   class="pill-tab {{ !request('category') ? 'active' : '' }} flex-shrink-0">All</a>
                @foreach(['Frontend', 'Backend', 'DevOps', 'AI', 'Design'] as $cat)
                    <a href="{{ route('resources.index', array_filter(['category' => $cat, 'search' => request('search'), 'filter' => request('filter')])) }}"
                       class="pill-tab {{ request('category') === $cat ? 'active' : '' }} flex-shrink-0">{{ $cat }}</a>
                @endforeach
            </div>

            {{-- Clear filters --}}
            @if(request('search') || request('category') || request('filter'))
                <a href="{{ route('resources.index') }}" class="text-xs font-semibold text-purple-600 hover:text-purple-800 flex-shrink-0 transition-colors">
                    Clear all
                </a>
            @endif
        </div>
    </div>

    {{-- ═══════════════════════════════════════════
         RESOURCE GRID
    ═══════════════════════════════════════════ --}}
    @if($resources->isEmpty())
        {{-- Empty State --}}
        <div class="bento-card flex flex-col items-center justify-center py-24 px-6 text-center">
            <div class="w-20 h-20 rounded-3xl bg-purple-50 flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
            </div>
            <h3 class="text-xl font-bold text-neutral-900 mb-2">No resources yet</h3>
            <p class="text-sm text-neutral-500 max-w-sm mb-8 leading-relaxed">Your shelf is empty. Start curating your developer toolkit by adding your first bookmark.</p>
            <a href="{{ route('resources.create') }}" class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold rounded-full px-7 py-3 shadow-lg shadow-purple-600/25 transition-all duration-200 hover:shadow-purple-600/40 hover:scale-[1.03] active:scale-95">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Add Your First Resource
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($resources as $resource)
                <div class="bento-card p-5 flex flex-col group">
                    {{-- Header: Favicon + Category --}}
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3 min-w-0">
                            {{-- Favicon circle --}}
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-100 to-fuchsia-50 flex items-center justify-center flex-shrink-0 border border-purple-100/60 overflow-hidden">
                                <img src="{{ $resource->favicon_url ?? 'https://www.google.com/s2/favicons?domain=' . parse_url($resource->url, PHP_URL_HOST) . '&sz=64' }}" alt="" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                                <svg style="display:none" class="w-5 h-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                            </div>
                            {{-- Category tag --}}
                            <span class="text-[11px] font-bold uppercase tracking-widest text-purple-600 bg-purple-50 px-2.5 py-1 rounded-lg">{{ $resource->category }}</span>
                        </div>
                        {{-- Favorite star --}}
                        <form action="{{ route('resources.favorite', $resource) }}" method="POST" class="flex-shrink-0">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-9 h-9 rounded-xl flex items-center justify-center transition-all duration-200 {{ $resource->is_favorite ? 'bg-purple-100 text-purple-600' : 'bg-transparent text-neutral-300 hover:text-purple-500 hover:bg-purple-50' }}" title="{{ $resource->is_favorite ? 'Remove favorite' : 'Add favorite' }}">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="{{ $resource->is_favorite ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                            </button>
                        </form>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-base font-bold text-neutral-900 leading-snug mb-1.5 group-hover:text-purple-700 transition-colors line-clamp-2">
                        <a href="{{ $resource->url }}" target="_blank" rel="noopener noreferrer">{{ $resource->title }}</a>
                    </h3>

                    {{-- URL Badge --}}
                    <a href="{{ $resource->url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs text-neutral-400 hover:text-purple-500 transition-colors mb-3 truncate max-w-full">
                        <svg class="w-3 h-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        <span class="truncate">{{ str_replace(['http://', 'https://', 'www.'], '', $resource->url) }}</span>
                    </a>

                    {{-- Description --}}
                    <p class="text-sm text-neutral-500 leading-relaxed line-clamp-2 mb-4 flex-grow">{{ $resource->description ?: 'No description added.' }}</p>

                    {{-- Tags --}}
                    @if(!empty($resource->tags) && is_array($resource->tags))
                        <div class="flex flex-wrap gap-1.5 mb-4">
                            @foreach(array_slice($resource->tags, 0, 3) as $tag)
                                <span class="text-[11px] font-semibold text-neutral-500 bg-neutral-100 px-2.5 py-1 rounded-lg">#{{ $tag }}</span>
                            @endforeach
                            @if(count($resource->tags) > 3)
                                <span class="text-[11px] font-semibold text-neutral-400 bg-neutral-100 px-2.5 py-1 rounded-lg">+{{ count($resource->tags) - 3 }}</span>
                            @endif
                        </div>
                    @endif

                    {{-- Action Bar --}}
                    <div class="flex items-center justify-between pt-3.5 border-t border-neutral-100 mt-auto action-bar">
                        {{-- Timestamp --}}
                        <span class="text-[11px] text-neutral-400 font-medium">{{ $resource->created_at->diffForHumans() }}</span>

                        <div class="flex items-center gap-1.5">
                            {{-- Copy Link (Alpine.js) --}}
                            <div x-data="{ copied: false }">
                                <button @click="navigator.clipboard.writeText('{{ $resource->url }}'); copied = true; setTimeout(() => copied = false, 1500)"
                                        class="w-8 h-8 rounded-lg flex items-center justify-center transition-all"
                                        :class="copied ? 'text-emerald-500 bg-emerald-50' : 'text-neutral-400 hover:text-purple-600 hover:bg-purple-50'"
                                        :title="copied ? 'Copied!' : 'Copy link'">
                                    <svg x-show="!copied" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    <svg x-show="copied" x-cloak class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                </button>
                            </div>

                            {{-- Edit --}}
                            <a href="{{ route('resources.edit', $resource) }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-neutral-400 hover:text-blue-600 hover:bg-blue-50 transition-all" title="Edit">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>

                            {{-- Delete (Alpine.js modal trigger) --}}
                            <div x-data="{ open: false }">
                                <button @click="open = true" class="w-8 h-8 rounded-lg flex items-center justify-center text-neutral-400 hover:text-rose-600 hover:bg-rose-50 transition-all" title="Delete">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>

                                {{-- Alpine.js Delete Confirmation Modal --}}
                                <template x-teleport="body">
                                    <div x-show="open" x-cloak class="fixed inset-0 z-[200] flex items-center justify-center p-4">
                                        {{-- Backdrop --}}
                                        <div x-show="open"
                                             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                             @click="open = false"
                                             class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>
                                        {{-- Modal Box --}}
                                        <div x-show="open"
                                             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                             @click.away="open = false"
                                             class="relative bg-white rounded-3xl border border-black/5 shadow-2xl max-w-sm w-full p-8">
                                            <div class="flex flex-col items-center text-center">
                                                <div class="w-14 h-14 rounded-2xl bg-rose-50 flex items-center justify-center mb-4">
                                                    <svg class="w-7 h-7 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </div>
                                                <h3 class="text-lg font-bold text-neutral-900 mb-1">Delete Resource?</h3>
                                                <p class="text-sm text-neutral-500 leading-relaxed mb-6">
                                                    <strong>{{ $resource->title }}</strong> will be permanently removed. This can&rsquo;t be undone.
                                                </p>
                                                <div class="flex items-center gap-3 w-full">
                                                    <button @click="open = false" class="flex-1 py-2.5 rounded-xl text-sm font-semibold text-neutral-600 bg-neutral-100 hover:bg-neutral-200 transition-colors">Cancel</button>
                                                    <form action="{{ route('resources.destroy', $resource) }}" method="POST" class="flex-1">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="w-full py-2.5 rounded-xl text-sm font-semibold text-white bg-rose-500 hover:bg-rose-600 shadow-lg shadow-rose-500/25 transition-all">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>


            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="flex justify-center pt-6">
            {{ $resources->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection
