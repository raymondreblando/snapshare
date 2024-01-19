@extends('layouts.layout')

@section('title', 'Update Page - SnapShare')

@section('render')
    <div class="flex flex-col items-center pt-[110px] pb-8">
        <div class="w-[min(600px,95%)] bg-white rounded-lg p-8 mb-4">
            <p class="text-base text-light-dark text-center font-bold mb-4">Update Your Snap Page</p>

            @include('partials.error')
            @include('partials.success')

            <form 
                method="POST"
                action="{{ route('page.update', $page) }}"
                autocomplete="off"
                enctype="multipart/form-data"
            >
                @csrf
                @method('put')
                <div class="upload-container relative min-h-[300px] bg-neutral-50 rounded-md mb-4 overflow-hidden cursor-pointer">
                    <input 
                        type="file" 
                        name="page_cover" 
                        class="file-upload" 
                        hidden
                    >
                    <img 
                        src="{{ asset('storage/page_covers/' . $page->page_cover) }}" 
                        alt="uploaded image" 
                        class="image-preview w-full"
                    >
                    <div class="upload-icon absolute inset-0 hidden flex-col justify-center items-center">
                        <img src="{{ asset('images/snap.svg') }}" alt="snap" class="w-8 h-8 mb-2">
                        <p class="text-xs text-light-dark font-bold">Upload Page Cover Photo</p>
                        <p class="text-xs text-gray-400 font-semibold">Accepts jpg, png, webp format.</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 mb-4">
                    <div class="upload-container relative min-w-[60px] h-[60px] bg-neutral-50 rounded-full overflow-hidden cursor-pointer mx-auto">
                        <input 
                            type="file" 
                            name="page_profile" 
                            class="file-upload" 
                            hidden
                        >
                        <img 
                            src="{{ asset('storage/page_profiles/' . $page->page_profile) }}" 
                            alt="uploaded image" 
                            class="image-preview w-full h-full object-cover" 
                        >
                        <div class="upload-icon absolute inset-0 hidden flex-col justify-center items-center">
                            <img src="{{ asset('images/snap.svg') }}" alt="snap" class="w-6 h-6">
                        </div>
                    </div>
                    <input 
                        name="page_name" 
                        class="h-14 text-sm text-gray-400 font-medium border border-gray-200 rounded-lg mb-2" 
                        placeholder="Enter page name"
                        value="{{ $page->page_name }}"
                    >
                </div>
                <button type="submit" class="w-full h-12 text-sm text-white font-medium bg-primary rounded-lg">
                    Update Page
                </button>
            </form>
        </div>
    </div>
@endsection