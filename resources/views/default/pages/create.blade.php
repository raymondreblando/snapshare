@extends('layouts.layout')

@section('title', 'Create Page - SnapShare')

@section('render')
    <div class="flex flex-col items-center pt-[110px] pb-8">
        <div class="w-[min(600px,95%)] bg-white rounded-lg p-8 mb-4">
            <p class="w-max text-xs text-light-dark text-center uppercase bg-neutral-50 font-bold border border-gray-200/80 rounded-full px-6 py-2 mx-auto mb-4">
                Create A Page
            </p>
            
            @include('partials.error')
            @include('partials.success')

            <form 
                method="POST" 
                action="{{ route('page.store') }}"
                autocomplete="off"
                enctype="multipart/form-data"
            >
                @csrf
                <div class="upload-container relative min-h-[300px] bg-neutral-50 border border-gray-200/80 rounded-sm mb-4 overflow-hidden cursor-pointer">
                    <input type="file" name="page_cover" class="file-upload" hidden>
                    <img src="" alt="uploaded image" class="image-preview w-full" hidden>
                    <div class="upload-icon absolute inset-0 flex flex-col justify-center items-center">
                        <img src="{{ asset('images/snap.svg') }}" alt="snap" class="w-8 h-8 mb-2">
                        <p class="text-xs text-light-dark font-bold">Upload Page Cover Photo</p>
                        <p class="text-xs text-gray-400 font-semibold">Accepts jpg, png, webp format.</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 mb-4">
                    <div class="upload-container relative shrink-0 w-[70px] h-[70px] bg-neutral-50 border border-gray-200/80 rounded-full overflow-hidden cursor-pointer mx-auto">
                        <input type="file" name="page_profile" class="file-upload" hidden>
                        <img src="" alt="uploaded image" class="image-preview w-full h-full object-cover" hidden>
                        <div class="upload-icon absolute inset-0 flex flex-col justify-center items-center">
                            <img src="{{ asset('images/snap.svg') }}" alt="snap" class="w-6 h-6">
                        </div>
                    </div>
                    <input name="page_name" class="custom-scrollbar resize-none h-14 text-sm font-medium border border-gray-200 rounded-lg" placeholder="Enter page name">
                </div>
                <button type="submit" class="w-full h-12 text-sm text-white font-medium bg-primary rounded-lg">Create Page</button>
            </form>
        </div>
    </div>
@endsection