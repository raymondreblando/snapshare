@if (session('success'))
    <div class="bg-emerald-50 border border-emerald-500 rounded-md p-4 mb-4">
        <p class="text-xs text-emerald-500 text-center font-semibold">
            {{ session('success') }}
        </p>
    </div>    
@endif