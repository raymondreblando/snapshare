@extends('layouts.app')

@section('title', 'SnapShare - Login')

@section('content')
    @include('partials.loader')
    <div class="relative min-h-screen flex justify-center items-center px-6 sm:px-16 py-16">
        <div>
            <p class="text-3xl text-black text-center uppercase">
                <span class="text-primary font-semibold">Snap</span>Share
            </p>
            <p class="text-sm text-light-dark text-center font-semibold mb-12">
                Capture and Share Life's Moments
            </p>

            @include('partials.error')
            @include('partials.success')

            <form 
                method="POST" 
                action="{{ route('login.auth') }}"
                autocomplete="off" 
                class="max-w-[450px]"
            >
                @csrf
                <input 
                    type="text" 
                    name="email" 
                    class="h-12 text-sm bg-neutral-100 rounded-lg mb-4" 
                    placeholder="Email address"
                    value="{{ old('email') }}"
                >
                <input 
                    type="password" 
                    name="password" 
                    class="h-12 text-sm bg-neutral-100 rounded-lg mb-4" 
                    placeholder="Password"
                    value="{{ old('password') }}"
                >
                <div class="flex items-center justify-between gap-4 mb-4">
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="remember" class="border-2 border-neutral-50 outline-none">
                        <p class="text-xs text-light-dark font-medium whitespace-nowrap">
                            Keep me signed in
                        </p>
                    </div>
                </div>
                <button type="submit" class="w-full h-12 text-white bg-primary rounded-lg">
                    Log in
                </button>
            </form>

            <div class="relative my-6">
                <hr class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full md:w-[450px] h-[0.5px] bg-neutral-200 border-0">
                <p class="relative w-max text-xs text-neutral-300 text-center font-semibold uppercase bg-white px-4 mx-auto">Or</p>
            </div>

            <a 
                href="{{ route('google.redirect') }}" 
                class="max-w-[450px] h-12 flex justify-center items-center border border-neutral-200 rounded-lg hover:bg-neutral-50 transition-all duration-200 gap-3 mb-4"
            >
                <img 
                    src="{{ asset('images/google.svg') }}" 
                    alt="google" 
                    class="w-6 h-6"
                >
                <p class="text-sm text-black font-medium">
                    Continue with Google
                </p>
            </a>
            <a 
                href="{{ route('facebook.redirect') }}" 
                class="max-w-[450px] h-12 flex justify-center items-center border border-neutral-200 rounded-lg hover:bg-neutral-50 transition-all duration-200 gap-3 mb-8"
            >
                <img 
                    src="{{ asset('images/facebook.svg') }}" 
                    alt="facebook" 
                    class="w-6 h-6"
                >
                <p class="text-sm text-black font-medium">
                    Continue with Facebook
                </p>
            </a>

            <p class="text-sm text-black text-center">
                New to Snapshare? 
                <a href="{{ route('register') }}" class="text-primary font-semibold">Create account</a>
            </p>
        </div>
    </div>
@endsection
