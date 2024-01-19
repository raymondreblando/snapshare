@php
    $snapable = $snap->snapable;
    $reactCount = Number::abbreviate($snap->totalReacts());
    $commentCount = Number::abbreviate($snap->totalComments());
@endphp

<div class="search-area flex flex-col bg-white rounded-2xl border border-gray-200/80 p-8">
    <div class="flex justify-between gap-4 mb-4">
        @include('partials.posted-by', ['snap' => $snap])

        @can('update', $snap)
            @include('partials.snap-option', ['snap' => $snap])
        @endcan

    </div>

    @isset($snap->snap_caption)
        <p class="text-sm text-light-dark font-medium mb-4">
            {{ $snap->snap_caption }}
        </p>
    @endisset

    <img 
        data-src="{{ asset("storage/snaps/" . $snap->snap_image) }}" 
        src="{{ asset("storage/snaps/" . 'optimize-' . $snap->snap_image) }}" 
        alt="post" 
        class="lazy w-full rounded-sm mb-4"
    >

    <div class="flex justify-between items-center gap-4 px-2">
        <div class="flex gap-6">
            @include('partials.react-button', [
                'snap' => $snap, 
                'reactCount' => $reactCount
            ])

            @include('partials.comment-button', [
                'snap' => $snap,
                'commentCount' => $commentCount
            ])
        </div>

        @if (! $snap->isUserSnap())
            @include('partials.save-button', ['snap' => $snap])
        @endif
        
    </div>
</div>