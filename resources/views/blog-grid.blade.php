@extends("_master.main")
@section("title")  {{$_setting['title']}} | وبلاگ @endsection()
@section("main")
    <!-- main wrapper -->
    <div class="main-wrapper">
        <nav class="bg-gray py-3">
            <div class="container d-flex justify-content-end">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item active text-right" aria-current="page" >وبلاگ</li>
                    <li class="breadcrumb-item text-right" ><a href="/">خانه</a></li>

                </ol>
            </div>
        </nav>
        <div class="section">
            <div class="container">
                <div class="row">
                    @foreach ($articles as $article)
                        <div class="col-md-6" dir="rtl">
                            <div class="post text-right">
                                <div class="post-thumb">
                                    <a href="{{route("singleBlog",$article['slug'])}}">
                                        <img class="img-fluid" src="/{{$article['image']}}" alt="">
                                    </a>
                                </div>
                                <h3 class="post-title wrap"><a href="{{route("singleBlog",$article['slug'])}}">{{$article['subject']}}</a></h3>
                                <div class="post-meta ">
                                    <ul class="p-0 pl-3">
                                        <li dir="ltr">
                                           <span dir="rtl">
                                                 {{\Morilog\Jalali\Jalalian::forge(\Carbon\Carbon::parse($article['updated_at'])->timezone("Asia/Tehran"))->format(" %d %B %Y ")}}
                                           </span>&nbsp;
                                            <i class="ti-calendar"></i>
                                        </li>
                                        <li>
                                            <i class="ti-user"></i> {{$article->user->name}}
                                        </li>
                                        <li><i class="ti-tag"></i>
                                            @foreach ($article->category as $category)
                                                <a href="">{{$category['title']}}</a> |
                                            @endforeach
                                        </li>
                                        <li class="" dir="ltr">
                                            <span dir="rtl"> {{$article->comments->count()}} نظر </span>
                                            &nbsp;
                                            <i class="ti-comments"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="post-content">
                                    <p>{{Str::limit($article['body'],250," ...")}}</p>
                                    <a href="{{route("singleBlog",$article['slug'])}}" class="btn btn-primary btn-sm">ادامه به خواندن</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                        @include('pagination.default', ['paginator' => $articles])
                </div>
            </div>
        </div>
        @include("_master.footer")
    </div>
    <!-- /main wrapper -->
@endsection()
