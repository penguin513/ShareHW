<div class="media">
    <div class="media-body comment-body pt-2 px-10 pb-8 hover:text-gray-400">
        <div class="row">
            <span class="comment-body-user font-bold">{{ $item->name }}</span>
            <span class="comment-body-time text-gray-800 text-xs ml-2">{{ $item->created_at }}</span>
        </div>
        <span class="comment-body-content">{!! nl2br(e($item->comment)) !!}</span>
    </div>
</div>
