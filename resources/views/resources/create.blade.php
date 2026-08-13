@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <!-- Back Button -->
    <a href="{{ route('resources.index') }}" class="btn btn-ghost btn-sm gap-2 group">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
        Back to Resources
    </a>

    <!-- Form Card -->
    <div class="card bg-base-100 shadow-xl border border-base-200/50 overflow-hidden">
        <!-- Decorative gradient bar -->
        <div class="h-1.5 bg-gradient-to-r from-primary via-secondary to-accent"></div>

        <div class="card-body p-8">
            <h2 class="card-title text-2xl font-extrabold tracking-tight mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Add New Resource
            </h2>
            <p class="text-base-content/60 mb-6">Bookmark a useful tool, article, or library to your shelf.</p>

            <form action="{{ route('resources.store') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Title -->
                <div class="form-control w-full">
                    <label class="label" for="title">
                        <span class="label-text font-semibold">Title</span>
                        <span class="label-text-alt text-base-content/40">Leave blank to auto-fill</span>
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="e.g. Laravel Documentation" class="input input-bordered w-full @error('title') input-error @enderror" />
                    @error('title')
                        <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
                    @enderror
                </div>

                <!-- URL -->
                <div class="form-control w-full">
                    <label class="label" for="url">
                        <span class="label-text font-semibold">URL <span class="text-error">*</span></span>
                    </label>
                    <input type="url" id="url" name="url" value="{{ old('url') }}" placeholder="https://laravel.com/docs" class="input input-bordered w-full @error('url') input-error @enderror" />
                    @error('url')
                        <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
                    @enderror
                </div>

                <!-- Category -->
                <div class="form-control w-full">
                    <label class="label" for="category">
                        <span class="label-text font-semibold">Category <span class="text-error">*</span></span>
                    </label>
                    <select id="category" name="category" class="select select-bordered w-full @error('category') select-error @enderror">
                        <option value="" disabled {{ old('category') ? '' : 'selected' }}>Pick a category</option>
                        @foreach(['Frontend', 'Backend', 'DevOps', 'AI', 'Design'] as $cat)
                            <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-control w-full">
                    <label class="label" for="description">
                        <span class="label-text font-semibold">Description</span>
                        <span class="label-text-alt text-base-content/40">Optional</span>
                    </label>
                    <textarea id="description" name="description" rows="3" placeholder="A short description of this resource..." class="textarea textarea-bordered w-full @error('description') textarea-error @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
                    @enderror
                </div>

                <!-- Tags -->
                <div class="form-control w-full">
                    <label class="label" for="tags">
                        <span class="label-text font-semibold">Tags</span>
                        <span class="label-text-alt text-base-content/40">Comma-separated</span>
                    </label>
                    <input type="text" id="tags" name="tags" value="{{ old('tags') }}" placeholder="laravel, php, backend" class="input input-bordered w-full @error('tags') input-error @enderror" />
                    @error('tags')
                        <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
                    @enderror
                </div>

                <!-- Favorite Toggle -->
                <div class="form-control">
                    <label class="label cursor-pointer justify-start gap-3" for="is_favorite">
                        <input type="checkbox" id="is_favorite" name="is_favorite" value="1" {{ old('is_favorite') ? 'checked' : '' }} class="checkbox checkbox-primary" />
                        <span class="label-text font-semibold">Mark as favorite</span>
                    </label>
                </div>

                <!-- Submit -->
                <div class="flex justify-end gap-3 pt-4 border-t border-base-200">
                    <a href="{{ route('resources.index') }}" class="btn btn-ghost">Cancel</a>
                    <button type="submit" class="btn btn-primary shadow-lg shadow-primary/30 rounded-full px-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        Save Resource
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
