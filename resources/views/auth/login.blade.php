@extends('layouts.app')

@section('content')
<div class="min-h-[75vh] flex items-center justify-center px-4">
    <div class="bg-white border border-black/5 rounded-3xl shadow-xl shadow-black/[0.03] w-full max-w-md p-8 sm:p-10">
        
        {{-- Header --}}
        <div class="text-center mb-8">
            <div class="w-12 h-12 rounded-2xl gradient-wave mx-auto flex items-center justify-center mb-4 shadow-lg shadow-purple-500/20">
                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <h1 class="text-2xl font-extrabold text-neutral-900 tracking-tight">Welcome back</h1>
            <p class="text-sm text-neutral-500 mt-2">Enter your credentials to access your shelf.</p>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            {{-- Username --}}
            <div class="form-control w-full">
                <label class="label" for="username">
                    <span class="label-text font-semibold text-neutral-700">Username</span>
                </label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Enter your username" class="input input-bordered w-full rounded-xl focus:border-purple-300 focus:ring-2 focus:ring-purple-500/20 transition-all @error('username') input-error @enderror" required autofocus />
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

            {{-- Remember Me --}}
            <div class="form-control">
                <label class="label cursor-pointer justify-start gap-3 w-max">
                    <input type="checkbox" name="remember" class="checkbox checkbox-sm checkbox-primary rounded-md" />
                    <span class="label-text text-neutral-600 font-medium">Remember me for 30 days</span>
                </label>
            </div>

            {{-- Submit --}}
            <div class="pt-2">
                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 rounded-full shadow-lg shadow-purple-600/25 transition-all hover:shadow-purple-600/40 hover:scale-[1.02] active:scale-95">
                    Sign In
                </button>
            </div>
        </form>

        {{-- Footer Link --}}
        <p class="text-center text-sm text-neutral-500 font-medium mt-8">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-purple-600 hover:text-purple-800 transition-colors">Register here</a>
        </p>
    </div>
</div>
@endsection
