<div class="post-comments-form" id="comment">
    @if($errors->has('commentable_type'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('commentable_type') }}
        </div>
    @endif
    @if($errors->has('commentable_id'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('commentable_id') }}
        </div>
    @endif
        <h4 class="post-sub-heading mb-3">دیدگاهتان را بنویسید</h4>
            <form method="post" action="" id="share-comment" role="form" >
                <div id="setting">
                    @csrf
                    @honeypot
                    <input type="hidden" name="commentable_type" value="\{{ get_class($model) }}" />
                    <input type="hidden" name="commentable_id" value="{{ $model->getKey() }}" />
                    <div class="url" data-url="{{ route('comments.store') }}"></div>
                </div>
                <div class="row">
                    <!-- Comment -->
                    <div class="form-group col-md-12">
                        <textarea name="message" id="text"  class="form-control @if($errors->has('message')) is-invalid @endif" rows="6" placeholder="نظر *" maxlength="400"></textarea>
                        <div class="invalid-feedback">
                            لطفا نظر خود را وارد کنید.
                        </div>
                    </div>
                    <!-- Send Button -->
                    <div class="form-group col-md-12">
                        <button id="submit" type="submit" class="btn btn-primary">
                            ارسال نظر
                        </button>
                    </div>
                </div>
            </form>

</div>
