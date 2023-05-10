@extends("_master.main")
@section("title")  {{$_setting['title']}} | {{$article['subject']}} @endsection()
@section("main")
<!-- main wrapper -->
<div class="main-wrapper">

    <nav class="bg-gray py-3">
        <div class="container d-flex justify-content-end">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item active text-right" aria-current="page" >{{$article->subject}}</li>
                <li class="breadcrumb-item active text-right" aria-current="page" ><a href="{{route('blog')}}">وبلاگ</a></li>
                <li class="breadcrumb-item text-right" ><a href="/">خانه</a></li>

            </ol>
        </div>
    </nav>

<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="post post-single text-right" dir="rtl">
          <div class="post-thumb">
            <img class="img-fluid w-100" src="{{$media}}" alt="post-thumb">
          </div>
          <h2 class="post-title text-right">{{$article['subject']}}</h2>
          <div class="post-meta ">
                <ul>
                    <li dir="ltr">
                        <span dir="rtl">
                            {{\Morilog\Jalali\Jalalian::forge(\Carbon\Carbon::parse($article['updated_at'])->timezone("ASIA/Tehran"))->format(" %d %B %Y ")}}
                        </span>&nbsp;
                        <i class="ti-calendar"></i>
                    </li>
                    <li>
                        <i class="ti-user"></i> {{$article->user->name}}
                    </li>
                    <li><i class="ti-tag"></i>
                        @foreach ($article->category as $category)
                            <span>{{$category['title']}}</span> |
                        @endforeach
                    </li>
                    <li class="" dir="ltr">
                        <span dir="rtl" id="comment-q">&nbsp;{{$article->comments->count()}} نظر  </span>
                        <i class="ti-comments"></i>

                    </li>
                </ul>
            </div>
          <div class="post-content post-excerpt mb-5" >
              {{$article['body']}}
          </div>
          <div class="post-social-share mb-4">
            <h4 class="post-sub-heading  pb-3 mb-3">این پست را به اشتراک بگذارید</h4>
            <div class="social-media-icons">
              <ul class="list-inline social-icons p-0 ">
                <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="ti-twitter-alt"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="ti-vimeo-alt"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="ti-google"></i></a></li>
              </ul>
            </div>
          </div>

          <div class="post-comments" id="comment-section">
            <ul class="media-list mb-5">
                @comments(['model' => $article])

            </ul>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

@include("_master.footer")

</div>
<!-- /main wrapper -->
@endsection()

@section('extra_js')
    <script src="/js/comment.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script>
        const postContainer = $('.post-content')
        postContainer.html( marked.parse(postContainer.text().trim()))
        postContainer.find('img').addClass('img-fluid')
    </script>
@endsection

