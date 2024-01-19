@extends('layouts.app')

@section('title', 'SnapShare - Email Verify')

@section('content')
    <div class="min-h-screen flex justify-center items-center">
        <div>
            <p class="text-3xl text-black text-center uppercase mb-12">
                <span class="text-primary font-semibold">Snap</span>Share
            </p>
            <p class="text-xl text-black text-center font-semibold">Email Verification</p>
            <p class="text-sm text-light-dark text-center font-semibold mb-4">Congratulations on joining SnapShare!</p>
            <p class="max-w-[450px] text-sm text-light-dark text-center mx-auto mb-4">Kindly check your registered email address for the verification link that has been sent to you. If you haven't received the email, please check your spam folder.</p>

            <p class="text-sm text-light-dark text-center mb-12"><span class="text-red-600"><b>Note:</b></span> The verification link is only valid for the next 30 minutes.</p>

            <p class="text-sm text-light-dark text-center font-medium">Not received the email? <a href="#" class="text-primary">Resend Verification Email</a></p>
        </div>
    </div>
@endsection