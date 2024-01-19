@if ($errors->any())
    <div class="bg-red-50 border border-red-600 rounded-md p-4 mb-4">
        <p class="text-xs text-red-700 text-center font-semibold">
            {{ $errors->first() }}
        </p>
    </div>    
@endif