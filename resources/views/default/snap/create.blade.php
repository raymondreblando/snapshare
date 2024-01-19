@extends('layouts.layout')

@section('title', 'Create a snap - SnapShare')

@section('render')
    <div class="flex flex-col items-center pt-[110px] pb-8">
        <div class="w-[min(600px,95%)] bg-white rounded-lg p-8 mb-4">

            @php
                $heading = isset($pageId) ? 'page' : 'your';
            @endphp

            <p class="w-max text-xs text-light-dark text-center uppercase bg-neutral-50 font-bold border border-gray-200/80 rounded-full px-6 py-2 mx-auto mb-4">
                Create {{ $heading }} Snap
            </p>

            @include('partials.error')
            @include('partials.success')

            <form 
                method="POST"
                action="{{ route('snap.store') }}"
                autocomplete="off"
                enctype="multipart/form-data"
            >
                @csrf
                @method('post')

                @isset($pageId)
                    <input type="hidden" name="page" value="{{ $pageId }}">
                @endisset

                <div class="upload-container relative min-h-[300px] bg-neutral-50 border border-gray-200/80 rounded-sm mb-4 overflow-hidden cursor-pointer">
                    <input type="file" name="snap" class="file-upload" hidden>
                    <img src="" alt="uploaded image" class="image-preview w-full" hidden>
                    <div class="upload-icon absolute inset-0 flex flex-col justify-center items-center">
                        <img src="{{ asset('images/snap.svg') }}" alt="snap" class="w-8 h-8 mb-2">
                        <p class="text-xs text-light-dark font-bold">Upload a Snap</p>
                        <p class="text-xs text-gray-400 font-semibold">Accepts jpg, png, webp format.</p>
                    </div>
                </div>
                <textarea name="snap_caption" class="custom-scrollbar resize-none h-24 text-sm font-medium border border-gray-200 rounded-lg mb-2" placeholder="Enter snap caption"></textarea>
                <div class="mb-4">
                    <label for="snap_privacy" class="inline-block text-xs text-gray-400 font-semibold mb-2">Choose Snap Privacy</label>
                    <div class="flex flex-wrap gap-3">
                        <input type="hidden" name="snap_privacy">
                        <div class="group tickbox" role="button" data-value="Private">
                            <i class="ri-checkbox-circle-fill hidden group-[.active]:block text-base text-emerald-600"></i>
                            <p class="group-[.active]:text-emerald-600">Private</p>
                        </div>
                        <div class="group tickbox" role="button" data-value="Public">
                            <i class="ri-checkbox-circle-fill hidden group-[.active]:block text-base text-emerald-600"></i>
                            <p class="group-[.active]:text-emerald-600">Public</p>
                        </div>
                    </div>
                </div>
                <button type="submit" class="w-full h-12 text-sm text-white font-medium bg-primary rounded-lg">Create Snap</button>
            </form>
        </div>
    </div>
@endsection