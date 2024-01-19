<form 
    method="POST" 
    autocomplete="off" 
    class="comment-form fixed bottom-[57px] left-1/2 -translate-x-1/2 w-[min(700px,95%)]"
>
    @csrf
    <div class="relative flex items-center w-full h-16 text-sm bg-white rounded-lg border border-gray-200/80 shadow-lg px-4">
        <textarea 
            name="comment" 
            class="comment-input resize-none h-5 bg-white overflow-hidden p-0" 
            placeholder="Write a comment"
        ></textarea>
        <button type="submit" class="post-comment hidden" data-id="{{ $snap_id }}">
            <img src="{{ asset('images/send.svg') }}" alt="post" class="w-6 h-6">
        </button>
    </div>
</form>