@extends('layouts.layout')

@section('title', 'Update Snap - SnapShare')

@section('render')
    <div class="flex flex-col items-center pt-[110px] pb-8">
        <div class="w-[min(600px,95%)] bg-white rounded-lg p-8 mb-4">
            <p class="text-base text-light-dark text-center font-bold mb-4">
                Update your Snap
            </p>

            @include('partials.error')
            @include('partials.success')

            <form 
                method="POST"
                action="{{ route('snap.update', $snap) }}"
                autocomplete="off"
                enctype="multipart/form-data"
            >
                @csrf
                @method('put')
                <div class="upload-container relative min-h-[300px] bg-neutral-50 rounded-lg mb-4 overflow-hidden cursor-pointer">
                    <input 
                        type="file" 
                        name="snap" 
                        class="file-upload" 
                        hidden
                    >
                    <img 
                        src="{{ asset('storage/snaps/' . $snap->snap_image) }}" 
                        alt="uploaded image" 
                        class="image-preview w-full"
                    >
                    <div class="upload-icon absolute inset-0 hidden flex-col justify-center items-center">
                        <img 
                            src="{{ asset('images/snap.svg') }}" 
                            alt="snap" 
                            class="w-8 h-8 mb-2"
                        >
                        <p class="text-xs text-light-dark font-bold">
                            Upload a Snap
                        </p>
                        <p class="text-xs text-gray-400 font-semibold">
                            Accepts jpg, png, webp format.
                        </p>
                    </div>
                </div>
                <textarea 
                    name="snap_caption" 
                    class="custom-scrollbar resize-none h-24 text-sm font-medium border border-gray-200 rounded-lg mb-2" 
                    placeholder="Enter snap caption"
                >{{ $snap->snap_caption }}</textarea>
                <div class="mb-4">
                    <label for="snap_privacy" class="inline-block text-xs text-gray-400 font-semibold mb-2">
                        Choose Snap Privacy
                    </label>
                    <div class="flex flex-wrap gap-3">
                        <input type="hidden" name="snap_privacy" value="{{ $snap->snap_privacy }}">
                        <div class="group tickbox @if ($snap->snap_privacy === 'Private') active @endif" role="button" data-value="Private">
                            <i class="ri-checkbox-circle-fill hidden group-[.active]:block text-base text-emerald-500"></i>
                            Private
                        </div>
                        <div class="group tickbox @if ($snap->snap_privacy === 'Friends') active @endif" role="button" data-value="Friends">
                            <i class="ri-checkbox-circle-fill hidden group-[.active]:block text-base text-emerald-500"></i>
                            Friends
                        </div>
                        <div class="group tickbox @if ($snap->snap_privacy === 'Public') active @endif" role="button" data-value="Public">
                            <i class="ri-checkbox-circle-fill hidden group-[.active]:block text-base text-emerald-500"></i>
                            Public
                        </div>
                    </div>
                </div>
                <button type="submit" class="w-full h-12 text-sm text-white font-medium bg-primary rounded-lg">Update Snap</button>
            </form>
        </div>
    </div>
@endsection