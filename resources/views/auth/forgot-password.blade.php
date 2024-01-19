@extends('layouts.app')

@section('title', 'SnapShare - Forgot Password')

@section('content')
    <div class="min-h-screen flex justify-center items-center">
        <div>
            <p class="text-3xl text-black text-center uppercase">
                <span class="text-primary font-semibold">Snap</span>Share
            </p>
            <p class="text-sm text-light-dark text-center font-semibold mb-12">Reset account password</p>
            
            <p class="max-w-[450px] text-sm text-light-dark text-center mx-auto mb-4">To reset your account password simply enter the email address associated with your account, and we'll send you a link to reset your password.</p>

            <p class="text-sm text-red-600 text-center mb-12">For security reasons, the reset link is valid for 30 minutes.</p>

            <form autocomplete="off">
                <input type="email" name="email" class="h-12 text-sm bg-neutral-100 rounded-lg mb-4" placeholder="Email address">
                <button type="submit" class="w-full h-12 text-white bg-primary rounded-lg">Reset password</button>
            </form>

            <p class="text-sm text-black text-center mt-4">Not received the reset password link? <a href="#" class="text-primary font-semibold">Resend reset link</a></p>

            <a href="{{ route('login') }}" class="block text-sm text-primary text-center font-medium mt-8">Go to login page</a>
        </div>
    </div>
@endsection
