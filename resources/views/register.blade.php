@extends('layouts.app')

@section('title', 'SnapShare - Register')

@section('content')
    @include('partials.loader')
    <div class="relative min-h-screen flex justify-center items-center px-6 sm:px-16 py-16">
        <div>
            <p class="text-3xl text-black text-center uppercase">
                <span class="text-primary font-semibold">Snap</span>Share
            </p>
            <p class="max-w-[450px] text-sm text-light-dark text-center font-semibold mb-12">
                Join SnapShare, the premier destination for capturing and sharing the beauty of life's moments.
            </p>

            <p class="text-xl text-black text-center font-semibold mb-12">
                Create your <span class="text-primary">SnapShare</span> account
            </p>

            @include('partials.error')
            @include('partials.success')

            <form 
                autocomplete="off" 
                method="POST" 
                action="{{ route('register.store') }}" 
                class="max-w-[450px]"
            >
                @csrf
                <input 
                    type="text" 
                    name="fullname" 
                    class="h-12 text-sm bg-neutral-100 rounded-lg mb-4" 
                    placeholder="Enter your fullname" 
                    value="{{ old('fullname') }}"
                >
                <input 
                    type="text" 
                    name="username" 
                    class="h-12 text-sm bg-neutral-100 rounded-lg mb-4" 
                    placeholder="Enter username" 
                    value="{{ old('username') }}"
                >
                <input 
                    type="text" 
                    name="email" 
                    class="h-12 text-sm bg-neutral-100 rounded-lg mb-4" 
                    placeholder="Enter email address" 
                    value="{{ old('email') }}"
                >
                <input 
                    type="password" 
                    name="password" 
                    class="h-12 text-sm bg-neutral-100 rounded-lg mb-4" 
                    placeholder="Account password" 
                    value="{{ old('password') }}"
                >
                <input 
                    type="password" 
                    name="password_confirmation" 
                    class="h-12 text-sm bg-neutral-100 rounded-lg mb-4" 
                    placeholder="Confirm password"
                    value="{{ old('password_confirmation') }}"
                >
                <button type="submit" class="w-full h-12 text-white bg-primary rounded-lg">
                    Register
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
                    Register with Google
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
                    Register with Facebook
                </p>
            </a>

            <p class="text-sm text-black text-center">
                Already have a SnapShare account? 
                <a href="{{ route('login') }}" class="text-primary font-semibold">
                    Log in
                </a>
            </p>
        </div>
    </div>
@endsection