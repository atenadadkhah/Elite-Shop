@inject('markdown', 'Parsedown')
@php
    // TODO: There should be a better place for this.
    $markdown->setSafeMode(true);
@endphp

<div class="media" >
    <img class="ml-3 " style="height:55px;width:55px;object-fit: fill;border-radius: 50%"  src="{{$comment->commenter->profile->image}}" alt="{{ $comment->commenter->name ?? $comment->guest_name }} Avatar">
    <div class="media-body">
        <h5 class="mt-0 mb-1">{{ $comment->commenter->name ?? $comment->guest_name }} <small class="text-muted">- {{ $comment->created_at->diffForHumans() }}</small></h5>
        <div style="white-space: pre-wrap;">{!! $markdown->line($comment->comment) !!}</div>

        <div>
            @can('reply-to-comment', $comment)
                <button data-toggle="modal" data-target="#reply-modal-{{ $comment->getKey() }}" class="btn btn-sm btn-link text-uppercase">پاسخ</button>
            @endcan
            @can('edit-comment', $comment)
                <button data-toggle="modal" data-target="#comment-modal-{{ $comment->getKey() }}" class="btn btn-sm btn-link text-uppercase">ویرایش</button>
            @endcan
            @can('delete-comment', $comment)
                <form id="comment-delete-form-{{ $comment->getKey() }}" action="" method="POST" class="d-inline-block">
                    @method('DELETE')
                    @csrf
                    <div class="url" data-url="{{ route('comments.destroy', $comment->getKey()) }}"></div>
                    <button class="btn btn-sm btn-link" type="submit" id="delete-comment" name="delete"><small>حذف</small></button>
                </form>
            @endcan
        </div>

        @can('edit-comment', $comment)
            <div class="modal fade" id="comment-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content border-0" style="border-radius: 0">
                        <form method="POST" id="share-edit-{{ $comment->getKey() }}" action="">
                            @method('PUT')
                            @csrf
                            <div class="url" data-url="{{ route('comments.update', $comment->getKey()) }}"></div>
                            <div class="modal-header border-0">
                                <h5 class="modal-title">ویرایش نظر</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">

                                    <textarea required class="form-control" name="message" rows="3">{{ $comment->comment }}</textarea>

                                </div>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase" data-dismiss="modal">لغو</button>
                                <button type="submit" id="submit" class="btn btn-sm btn-outline-success text-uppercase">ویرایش</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan

        @can('reply-to-comment', $comment)
            <div class="modal fade" id="reply-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content border-0" style="border-radius:0">
                        <form method="POST" id="share-reply-{{ $comment->getKey() }}" action="">
                            @csrf
                            <div class="url" data-url="{{ route('comments.reply', $comment->getKey()) }}"></div>
                            <div class="modal-header border-0">
                                <h5 class="modal-title">پاسخ به نظر</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <textarea required class="form-control" name="message" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase" data-dismiss="modal">لغو</button>
                                <button type="submit" id="submit" class="btn btn-sm btn-outline-success text-uppercase">پاسخ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan

        <br />{{-- Margin bottom --}}

        <?php
            if (!isset($indentationLevel)) {
                $indentationLevel = 1;
            } else {
                $indentationLevel++;
            }
        ?>

        {{-- Recursion for children --}}
        @if($grouped_comments->has($comment->getKey()) && $indentationLevel <= $maxIndentationLevel)
            {{-- TODO: Don't repeat code. Extract to a new file and include it. --}}
            @foreach($grouped_comments[$comment->getKey()] as $child)
                @include('comments::_comment', [
                    'comment' => $child,
                    'grouped_comments' => $grouped_comments
                ])
            @endforeach
        @endif

    </div>
</div>

{{-- Recursion for children --}}
@if($grouped_comments->has($comment->getKey()) && $indentationLevel > $maxIndentationLevel)
    {{-- TODO: Don't repeat code. Extract to a new file and include it. --}}
    @foreach($grouped_comments[$comment->getKey()] as $child)
        @include('comments::_comment', [
            'comment' => $child,
            'grouped_comments' => $grouped_comments
        ])
    @endforeach
@endif
