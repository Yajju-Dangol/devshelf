@extends('layouts.app')

@section('content')
<div class="min-h-[75vh] flex items-center justify-center px-4">
    <div class="bg-white border border-black/5 rounded-3xl shadow-xl shadow-black/[0.03] w-full max-w-md p-8 sm:p-10">
        
        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-2xl font-extrabold text-neutral-900 tracking-tight">Create an account</h1>
            <p class="text-sm text-neutral-500 mt-2">Start curating your developer resources today.</p>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            {{-- Full Name --}}
            <div class="form-control w-full">
                <label class="label" for="name">
                    <span class="label-text font-semibold text-neutral-700">Full Name</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Jane Doe" class="input input-bordered w-full rounded-xl focus:border-purple-300 focus:ring-2 focus:ring-purple-500/20 transition-all @error('name') input-error @enderror" required autofocus />
                @error('name')
                    <label class="label pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>
                @enderror
            </div>

            {{-- Username --}}
            <div class="form-control w-full">
                <label class="label" for="username">
                    <span class="label-text font-semibold text-neutral-700">Username</span>
                </label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="e.g. janedoe" class="input input-bordered w-full rounded-xl focus:border-purple-300 focus:ring-2 focus:ring-purple-500/20 transition-all @error('username') input-error @enderror" required />
                @error('username')
                    <label class="label pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-control w-full">
                <label class="label" for="password">
                    <span class="label-text font-semibold text-neutral-700">Password</span>
                </label>
                <input type="password" id="password" name="password" placeholder="••••••••" class="input input-bordered w-full rounded-xl focus:border-purple-300 focus:ring-2 focus:ring-purple-500/20 transition-all @error('password') input-error @enderror" required />
                @error('password')
                    <label class="label pb-0"><span class="label-text-alt text-rose-500 font-medium">{{ $message }}</span></label>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="form-control w-full">
                <label class="label" for="password_confirmation">
                    <span class="label-text font-semibold text-neutral-700">Confirm Password</span>
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" class="input input-bordered w-full rounded-xl focus:border-purple-300 focus:ring-2 focus:ring-purple-500/20 transition-all" required />
            </div>

            {{-- Submit --}}
            <div class="pt-2">
                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 rounded-full shadow-lg shadow-purple-600/25 transition-all hover:shadow-purple-600/40 hover:scale-[1.02] active:scale-95">
                    Create Account
                </button>
            </div>
        </form>

        {{-- Footer Link --}}
        <p class="text-center text-sm text-neutral-500 font-medium mt-8">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-purple-600 hover:text-purple-800 transition-colors">Log in</a>
        </p>
    </div>
</div>
@endsection
