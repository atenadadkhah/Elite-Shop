@extends("_master.main")
@section("title"){{$_setting['title']}} | درباره ما @endsection()
@section("main")
<!-- main wrapper -->
<div class="main-wrapper">

    <nav class="bg-gray py-3">
        <div class="container d-flex justify-content-end">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item active text-right" aria-current="page" >درباره ما</li>
                <li class="breadcrumb-item text-right" ><a href="/">خانه</a></li>

            </ol>
        </div>
    </nav>

<!-- about -->
<section class="section text-right" dir="rtl">
  <div class="container">
    <div class="row">
      <div class="col-md-6 text-left" >
        <!-- image circle background -->
        <div class="about-img-bg"></div>
        <img class="img-fluid mb-4 mb-md-0" src="/images/about/product.jpg" alt="product-img">
      </div>
      <div class="col-md-6">
        <h2 class="section-title">به دنیای ما خوش آمدید</h2>
        <p class="mb-4">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد.</p>
        <ul class="pl-0">
          <li class="d-flex">
            <i class="ti-check mr-3 mt-1"></i>&nbsp;
            <div>
              <h4>کارت هدیه رایگان</h4>
              <p>کارت های هدیه رایگان است. اکنون آنها را درخواست کنید!</p>
            </div>
          </li>
          <li class="d-flex">
            <i class="ti-check mr-3 mt-1"></i>&nbsp;
            <div>
              <h4>بهترین تحویل</h4>
              <p>ارسال رایگان در تمام سفارشات ایالات متحده</p>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!-- /about -->

<section class="section overlay cta " data-background="images/backgrounds/cta.jpg">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center " dir="rtl">
        <h1 class="text-white mb-2">فروش آخر فصل</h1>
        <p class="text-white mb-4">25% تخفیف برای تمام ژاکت ها و بافتنی ها. تخفیف در هنگام تسویه حساب اعمال می شود.</p>
        <a href="shop.blade.php" class="btn btn-light">اکنون خرید کنید</a>
      </div>
    </div>
  </div>
</section>

<!-- team -->
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
        @foreach ($team as $member)
            <!-- team member -->
                <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
                    <div class="card border-0 text-center team-member">
                        <img class="card-img-top rounded-0 mb-1" src="/{{$member['image']}}" alt="team-member">
                        <div class="card-body">
                            <h4 class="card-title">{{$member['name']}}</h4>
                            <p class="card-text">{{$member['title']}}</p>
                        </div>
                        <ul class="list-inline social-icons">
                            @foreach (json_decode($member['media'],1) as $social=>$link)
                                <li class="list-inline-item"><a href="{{$link}}"><i class="ti-{{$social}}"></i></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
        @endforeach


    </div>
  </div>
</section>
<!-- /team -->

@include("_master.footer")

</div>
<!-- /main wrapper -->
@endsection()

