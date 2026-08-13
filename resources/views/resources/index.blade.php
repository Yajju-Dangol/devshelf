@extends('layouts.app')

@section('content')
<div class="space-y-8">
    
    <!-- Hero Header & Filters -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 bg-base-100 p-6 rounded-3xl shadow-sm border border-base-300 relative overflow-hidden">
        <!-- decorative blur -->
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-primary opacity-10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-secondary opacity-10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="z-10">
            <h1 class="text-3xl font-extrabold mb-2 tracking-tight">Your Bookshelf</h1>
            <p class="text-base-content/70">Find and manage your curated developer resources.</p>
        </div>
        
        <form method="GET" action="{{ route('resources.index') }}" class="flex-1 w-full md:max-w-xl z-10 space-y-4">
            <div class="join w-full shadow-sm rounded-full">
                <input type="text" name="search" value="{{ request('search') }}" class="input input-bordered join-item w-full bg-base-200/50 focus:bg-base-100 rounded-l-full" placeholder="Search title or description..." />
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <button type="submit" class="btn btn-primary join-item rounded-r-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </button>
            </div>
            
            <div class="flex flex-wrap items-center gap-2">
                <span class="text-sm font-semibold text-base-content/60 uppercase tracking-wide mr-2">Categories:</span>
                <a href="{{ route('resources.index', ['search' => request('search')]) }}" 
                   class="badge badge-lg cursor-pointer hover:badge-primary transition-colors {{ !request('category') ? 'badge-primary' : 'badge-ghost border-base-300' }}">
                    All
                </a>
                @php
                    $categories = ['Frontend', 'Backend', 'DevOps', 'AI', 'Design'];
                @endphp
                @foreach($categories as $cat)
                    <a href="{{ route('resources.index', ['category' => $cat, 'search' => request('search')]) }}" 
                       class="badge badge-lg cursor-pointer hover:badge-primary transition-colors {{ request('category') === $cat ? 'badge-primary' : 'badge-ghost border-base-300' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>
        </form>
    </div>

    <!-- Results count & clear filters -->
    <div class="flex justify-between items-center text-sm text-base-content/60">
        <span>Showing <strong>{{ $resources->total() }}</strong> resources</span>
        @if(request('search') || request('category'))
            <a href="{{ route('resources.index') }}" class="link link-hover text-primary flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                Clear Filters
            </a>
        @endif
    </div>

    <!-- Resource Grid -->
    @if($resources->isEmpty())
        <!-- Empty State -->
        <div class="flex flex-col items-center justify-center py-20 px-4 text-center">
            <div class="w-64 h-64 mb-8 opacity-60">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full text-base-content/30"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"></path></svg>
            </div>
            <h3 class="text-2xl font-bold mb-2">No resources found</h3>
            <p class="text-base-content/60 max-w-md mb-6">Looks like your shelf is a little bare. Start adding some awesome links and resources to build your collection.</p>
            <a href="{{ route('resources.create') }}" class="btn btn-primary rounded-full px-8 shadow-lg shadow-primary/30">Add Your First Resource</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($resources as $resource)
                <div class="card bg-base-100 shadow-xl border border-base-200/50 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group overflow-hidden">
                    <div class="card-body p-6 relative">
                        
                        <!-- Favorite Toggle -->
                        <div class="absolute top-4 right-4 z-10">
                            <form action="{{ route('resources.toggle-favorite', $resource) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-ghost btn-sm btn-circle text-xl {{ $resource->is_favorite ? 'text-error' : 'text-base-content/30 hover:text-error/70' }} tooltip tooltip-left" data-tip="{{ $resource->is_favorite ? 'Remove from favorites' : 'Add to favorites' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ $resource->is_favorite ? 'fill-current' : 'fill-none' }}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            </form>
                        </div>

                        <!-- Category Tag -->
                        <div class="mb-3">
                            <div class="badge badge-secondary badge-outline text-xs font-semibold uppercase tracking-wider py-3 px-3">{{ $resource->category }}</div>
                        </div>

                        <!-- Title -->
                        <h2 class="card-title text-xl font-bold leading-tight mb-2 group-hover:text-primary transition-colors pr-10">
                            <a href="{{ $resource->url }}" target="_blank" rel="noopener noreferrer" class="hover:underline">{{ $resource->title }}</a>
                        </h2>

                        <!-- URL Badge/Link -->
                        <a href="{{ $resource->url }}" target="_blank" rel="noopener noreferrer" class="flex items-center text-sm text-base-content/50 hover:text-primary mb-4 truncate w-full group-hover:text-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                            <span class="truncate">{{ str_replace(['http://', 'https://'], '', $resource->url) }}</span>
                        </a>

                        <!-- Description -->
                        <p class="text-sm text-base-content/70 line-clamp-3 mb-4 flex-grow">{{ $resource->description ?: 'No description provided.' }}</p>

                        <!-- Tags -->
                        @if(!empty($resource->tags) && is_array($resource->tags))
                            <div class="flex flex-wrap gap-1.5 mb-4">
                                @foreach(array_slice($resource->tags, 0, 4) as $tag)
                                    <span class="badge badge-sm badge-ghost bg-base-200">#{{ $tag }}</span>
                                @endforeach
                                @if(count($resource->tags) > 4)
                                    <span class="badge badge-sm badge-ghost bg-base-200">+{{ count($resource->tags) - 4 }}</span>
                                @endif
                            </div>
                        @endif

                        <!-- Actions -->
                        <div class="card-actions justify-between items-center mt-auto pt-4 border-t border-base-200">
                            <div class="text-xs text-base-content/40 font-mono">{{ $resource->created_at->diffForHumans() }}</div>
                            <div class="flex gap-2">
                                <a href="{{ route('resources.edit', $resource) }}" class="btn btn-xs btn-outline btn-info">Edit</a>
                                
                                <button class="btn btn-xs btn-outline btn-error" onclick="document.getElementById('delete_modal_{{ $resource->id }}').showModal()">Delete</button>
                                
                                <!-- Delete Modal -->
                                <dialog id="delete_modal_{{ $resource->id }}" class="modal">
                                    <div class="modal-box relative border-t-4 border-error">
                                        <h3 class="font-bold text-lg mb-2 text-error">Delete Resource</h3>
                                        <p class="py-4">Are you sure you want to delete <strong>{{ $resource->title }}</strong>? This action cannot be undone.</p>
                                        <div class="modal-action">
                                            <form method="dialog">
                                                <button class="btn">Cancel</button>
                                            </form>
                                            <form action="{{ route('resources.destroy', $resource) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-error shadow-lg shadow-error/30 text-white">Yes, Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                    <form method="dialog" class="modal-backdrop"><button>close</button></form>
                                </dialog>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $resources->links() }}
        </div>
    @endif
</div>
@endsection
