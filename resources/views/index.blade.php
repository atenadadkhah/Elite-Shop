@extends("_master.main")
@section("title") {{$_setting['title']}} @endsection()
@section("main")
    <!-- main wrapper -->
    <div class="main-wrapper">

        <section class="section bg-gray hero-area">
            <div class="container">
                <div class="hero-slider">

                    <!-- Start first slide  -->
                    <div class="slider-item">
                        <div class="row">
                            <div class="col-lg-6 align-self-center text-center text-md-right mb-4 mb-lg-0">
                                <h3 data-duration-in=".5" data-animation-in="fadeInLeft" data-delay-in="0" data-animation-out="fadeOutLeft" data-delay-out="5" data-duration-out=".3">برای مردان</h3>
                                <!-- Start Title -->
                                <h1 data-duration-in=".5" data-animation-in="fadeInLeft" data-delay-in=".2" data-animation-out="fadeOutLeft" data-delay-out="5" data-duration-out=".3">کانورس با کیفیت بالا</h1>
                                <!-- end title -->
                                <!-- Start Subtitle -->
                                <h3 class="mb-4" data-duration-in=".5" data-animation-in="fadeInLeft" data-delay-in=".4" data-animation-out="fadeOutLeft" data-delay-out="5" data-duration-out=".3">فقط $59.00</h3>
                                <!-- end subtitle -->
                                <!-- Start description -->
                                <p class="mb-4" dir="rtl" data-duration-in=".5" data-animation-in="fadeInLeft" data-delay-in=".6" data-animation-out="fadeOutLeft" data-delay-out="5" data-duration-out=".3">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک، چاپگرها و متون است.</p>
                                <!-- end description -->
                                <!-- Start button -->
                                <a href="{{route('shop')}}" class="btn btn-primary" data-duration-in=".5" data-animation-in="fadeInLeft" data-delay-in=".8" data-animation-out="fadeOutLeft" data-delay-out="5" data-duration-out=".3">اکنون خرید کنید</a>
                                <!-- end button -->
                            </div>
                            <!-- Start slide image -->
                            <div class="col-lg-6 text-center text-md-left">
                                <!-- background letter -->
                                <div class="bg-letter">
                              <span data-duration-in=".5" data-animation-in="fadeInRight" data-delay-in="1.2" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-out=".3">
                                C
                              </span>
                                    <!-- Slide image -->
                                    <img class="img-fluid d-unset" src="/images/hero-area/converse.png" alt="converse" data-duration-in=".5" data-animation-in="fadeInRight" data-delay-in="1" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-out=".3">
                                </div>
                            </div>
                            <!-- end slide image  -->
                        </div>
                    </div>
                    <!-- end slider item -->


                    <!-- Start slide  -->
                    <div class="slider-item">
                        <div class="row">
                            <div class="col-lg-6 align-self-center text-center text-md-right mb-4 mb-lg-0">
                                <h3 data-duration-in=".5" data-animation-in="fadeInDown" data-delay-in="0" data-animation-out="fadeOutDown" data-delay-out="5.8" data-duration-out=".3">برای زنان</h3>
                                <h1 data-duration-in=".5" data-animation-in="fadeInDown" data-delay-in=".2" data-animation-out="fadeOutDown" data-delay-out="5.4" data-duration-out=".3">کیف با کیفیت بالا</h1>
                                <h3 class="mb-4" data-duration-in=".5" data-animation-in="fadeInDown" data-delay-in=".4" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-out=".3">فقط  $37.00</h3>
                                <p class="mb-4" dir="rtl" data-duration-in=".5" data-animation-in="fadeInDown" data-delay-in=".6" data-animation-out="fadeOutDown" data-delay-out="4.6" data-duration-out=".3">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک، چاپگرها و متون است.</p>
                                <a href="{{route('shop')}}" class="btn btn-primary" data-duration-in=".5" data-animation-in="fadeInDown" data-delay-in=".8" data-animation-out="fadeOutDown" data-delay-out="4.2" data-duration-out=".3">اکنون خرید کنید</a>
                            </div>
                            <div class="col-lg-6 text-center">
                                <div class="bg-letter">
                                    <!-- background letter -->
                                    <span data-duration-in=".5" data-animation-in="fadeInRight" data-delay-in="1.2" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-out=".3">
                                B
                              </span>
                                    <img class="img-fluid d-unset" src="images/hero-area/bag.png" alt="converse" data-duration-in=".5" data-animation-in="fadeInRight" data-delay-in="1" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-out=".3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end slide  -->

                </div>
            </div>
        </section>
        <!-- /hero area -->

        <!-- categories -->
        <section class="section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-title">دسته بندی های برتر</h2>
                    </div>
                    <!-- categories item -->
                    <div class="col-lg-4 col-md-6 mb-50">
                        <div class="card p-0">
                            <div class="border-bottom text-center hover-zoom-img">
                                <a href="{{route('shop')}}"><img src="/images/categories/product-big-1.jpg" class="rounded-top img-fluid w-100" alt="product-img"></a>
                            </div>
                            <ul class="d-flex list-unstyled pl-0 categories-list">
                                <li class="m-0 hover-zoom-img">
                                    <a href="{{route('shop')}}"><img src="/images/categories/product-sm-1.jpg" class="img-fluid w-100" alt="product-img"></a>
                                </li>
                                <li class="m-0 hover-zoom-img">
                                    <a href="{{route('shop')}}"><img src="/images/categories/product-sm-2.jpg" class="img-fluid w-100" alt="product-img"></a>
                                </li>
                                <li class="m-0 hover-zoom-img">
                                    <a href="{{route('shop')}}"><img src="/images/categories/product-sm-3.jpg" class="img-fluid w-100" alt="product-img"></a>
                                </li>
                            </ul>
                            <div class="px-4 py-3 border-top">
                                <h4 class="d-inline-block mb-0 mt-1 float-right">تن پوش</h4>
                                <a href="{{route('shop')}}" class="btn btn-sm btn-outline-primary float-left">بیشتر ببینید</a>
                            </div>
                        </div>
                    </div>
                    <!-- categories item -->
                    <div class="col-lg-4 col-md-6 mb-50">
                        <div class="card p-0">
                            <div class="border-bottom text-center hover-zoom-img">
                                <a href="{{route('shop')}}"><img src="images/categories/product-big-2.jpg" class="rounded-top img-fluid w-100" alt="product-img"></a>
                            </div>
                            <ul class="d-flex list-unstyled pl-0 categories-list">
                                <li class="m-0 hover-zoom-img">
                                    <a href="{{route('shop')}}"><img src="images/categories/product-sm-4.jpg" class="img-fluid w-100" alt="product-img"></a>
                                </li>
                                <li class="m-0 hover-zoom-img">
                                    <a href="{{route('shop')}}"><img src="images/categories/product-sm-5.jpg" class="img-fluid w-100" alt="product-img"></a>
                                </li>
                                <li class="m-0 hover-zoom-img">
                                    <a href="{{route('shop')}}"><img src="images/categories/product-sm-6.jpg" class="img-fluid w-100" alt="product-img"></a>
                                </li>
                            </ul>
                            <div class="px-4 py-3 border-top">
                                <h4 class="d-inline-block mb-0 mt-1 float-right">کفش</h4>
                                <a href="{{route('shop')}}" class="btn btn-sm btn-outline-primary float-left">بیشتر ببینید</a>
                            </div>
                        </div>
                    </div>
                    <!-- categories item -->
                    <div class="col-lg-4 col-md-6 mb-50">
                        <div class="card p-0">
                            <div class="border-bottom text-center hover-zoom-img">
                                <a href="{{route('shop')}}"><img src="images/categories/product-big-3.jpg" class="rounded-top img-fluid w-100" alt="product-img"></a>
                            </div>
                            <ul class="d-flex list-unstyled pl-0 categories-list">
                                <li class="m-0 hover-zoom-img">
                                    <a href="{{route('shop')}}"><img src="images/categories/product-sm-7.jpg" class="img-fluid w-100" alt="product-img"></a>
                                </li>
                                <li class="m-0 hover-zoom-img">
                                    <a href="{{route('shop')}}"><img src="images/categories/product-sm-8.jpg" class="img-fluid w-100" alt="product-img"></a>
                                </li>
                                <li class="m-0 hover-zoom-img">
                                    <a href="{{route('shop')}}"><img src="images/categories/product-sm-9.jpg" class="img-fluid w-100" alt="product-img"></a>
                                </li>
                            </ul>
                            <div class="px-4 py-3 border-top">
                                <h4 class="d-inline-block mb-0 mt-1 float-right">وسایل جانبی</h4>
                                <a href="{{route('shop')}}" class="btn btn-sm btn-outline-primary float-left">بیشتر ببینید</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /categories -->

        <section class="section overlay cta" data-background="images/backgrounds/cta.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center" dir="rtl">
                        <h1 class="text-white mb-2">فروش آخر فصل</h1>
                        <p class="text-white mb-4">25% تخفیف برای تمام ژاکت ها و بافتنی ها. تخفیف در هنگام تسویه حساب اعمال می شود.</p>
                        <a href="{{route('shop')}}" class="btn btn-light">اکنون خرید کنید</a>
                    </div>
                </div>
            </div>
        </section>

        <div id="quickView" class="quickview">
            <div class="row w-100">
                <div class="col-lg-6 col-md-6 mb-5 mb-md-0 pl-5 pt-4 pt-lg-0 pl-lg-0">
                    <img src="/images/feature/product.png" alt="product-img" class="img-fluid">
                </div>
                <div class="col-lg-5 col-md-6 text-center text-md-right align-self-center pl-5" dir="rtl">
                    <h3 class="mb-lg-2 mb-2">Woven Crop Cami</h3>
                    <span class="mb-lg-4 mb-3 h5">$90.00</span>
                    <p class="mb-lg-4 mb-3 text-gray">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد</p>
                    <form action="#">
                        <select class="form-control w-100 mb-2" name="color">
                            <option value="brown">رنگ قهوه ای</option>
                            <option value="gray">رنگ خاکستری</option>
                            <option value="black">رنگ مشکی</option>
                        </select>
                        <select class="form-control w-100 mb-3" name="size">
                            <option value="small">سایز کوچک</option>
                            <option value="medium">سایز متوسط</option>
                            <option value="large">سایز بزرگ</option>
                        </select>
                        <button class="btn btn-primary w-100 mb-lg-4 mb-3">اضافه به سبد خرید</button>
                    </form>
                    <ul class="list-inline social-icon-alt">
                        @foreach($_setting['social_media'] as $media)
                            <li class="list-inline-item"><a href="{{$media['url']}}"><i class="ti-{{$media['media']}}"></i></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!-- collection -->
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-title">مجموعه های برتر</h2>
                    </div>
                    <div class="col-12">
                        <div class="collection-slider">
                            @foreach($bestProducts as $product)
                                <!-- product -->
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="product text-center">
                                            <div class="product-thumb">
                                                <div class="overflow-hidden position-relative">
                                                    <a href="{{route('singleProduct',$product['slug'])}}">
                                                        <img class="img-fluid w-100 mb-3 img-first" src="{{$product->picture->original_url}}" alt="product-img">
                                                    </a>
                                                    <div class="btn-cart">
                                                        <a href="#" class="btn btn-primary btn-sm">اضافه به سبد خرید</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h3 class="h5"><a class="text-color" href="{{route('singleProduct',$product['slug'])}}">{{$product['name']}}</a></h3>
                                                <span class="h5">{{$product['today_price']}}</span>
                                            </div>
                                            <div class="product-label sale text-left">
                                                {{$product['discount'] ? $product['discount'].' %' : ''}}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- //end of product -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /collection -->

        <!-- deal -->
        <section class="section bg-cover " data-background="images/backgrounds/deal.jpg" >
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-right mb-4 mb-md-0" dir="rtl">
                        <h1>معامله روز</h1>
                        <h4 class="mb-40">با تخفیف دریافت کنید!</h4>
                        <!-- syo-timer -->
                        <div class="syotimer large">
                            @php  use Carbon\Carbon;$discountDate=\Carbon\Carbon::parse($_setting['discount'])@endphp
                            <div id="simple-timer" data-year="{{$discountDate->year}}" data-month="{{$discountDate->month}}" data-day="{{$discountDate->day}}" data-hour="{{$discountDate->hour}}"></div>
                        </div>
                        <a href="{{route('shop')}}" class="btn btn-primary">اکنون خرید کنید</a>
                    </div>
                    <div class="col-md-6 text-center text-md-right align-self-center">
                        <img src="/images/deal/product.png" alt="product-img" class="img-fluid up-down">
                    </div>
                </div>
            </div>
        </section>
        <!-- /deal -->

        <!-- instagram -->
        <section class="section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="mb-2">ما را در اینستاگرام دنبال کنید</h2>
                        <p class="mb-5">@ Occaecat Cupidatat</p>
                    </div>
                </div>
                <!-- instafeed -->
                <!-- <div class="row" id="instafeed" data-userId="4044026246" data-accessToken="4044026246.1677ed0.8896752506ed4402a0519d23b8f50a17"></div> -->
                <!-- for linking to instagram, just uncomment this line and change data-userid with your instagram user id andata-accesstoken with your instagram access token -->

                <!-- without instagram image -->
                <!-- remove this section after link with your instagram account -->
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4">
                        <div class="instagram-post mx-2"><img class="img-fluid w-100" src="images/instagram/item-1.png" alt="instagram-image">
                            <ul class="list-inline text-center">
                                <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="ti-heart mr-2"></i>40</a></li>
                                <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="ti-comments mr-2"></i>24</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4">
                        <div class="instagram-post mx-2"><img class="img-fluid w-100" src="images/instagram/item-2.png" alt="instagram-image">
                            <ul class="list-inline text-center">
                                <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="ti-heart mr-2"></i>65</a></li>
                                <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="ti-comments mr-2"></i>11</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4">
                        <div class="instagram-post mx-2"><img class="img-fluid w-100" src="images/instagram/item-3.png" alt="instagram-image">
                            <ul class="list-inline text-center">
                                <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="ti-heart mr-2"></i>33</a></li>
                                <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="ti-comments mr-2"></i>78</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4">
                        <div class="instagram-post mx-2"><img class="img-fluid w-100" src="images/instagram/item-4.png" alt="instagram-image">
                            <ul class="list-inline text-center">
                                <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="ti-heart mr-2"></i>32</a></li>
                                <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="ti-comments mr-2"></i>77</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4">
                        <div class="instagram-post mx-2"><img class="img-fluid w-100" src="images/instagram/item-5.png" alt="instagram-image">
                            <ul class="list-inline text-center">
                                <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="ti-heart mr-2"></i>80</a></li>
                                <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="ti-comments mr-2"></i>38</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4">
                        <div class="instagram-post mx-2"><img class="img-fluid w-100" src="images/instagram/item-6.png" alt="instagram-image">
                            <ul class="list-inline text-center">
                                <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="ti-heart mr-2"></i>22</a></li>
                                <li class="list-inline-item"><a href="%7b%7blink%7d%7d.html" target="_blank" class="text-white"><i class="ti-comments mr-2"></i>57</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /without instagram image -->
            </div>
        </section>
        <!-- /instagram -->

        <!-- service -->
        <section class="section-sm border-top">
            <div class="container">
                <div class="row">
                    <!-- service item -->
                    <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0 text-right" dir="rtl">
                        <div class="d-flex flex-sm-row flex-column align-items-center align-items-sm-start">
                            <i class="ti-truck icon-lg ml-4 mb-3 mb-sm-0"></i>
                            <div class="text-center text-sm-right">
                                <h4>ارسال رایگان</h4>
                                <p class="mb-0 text-gray">ارسال رایگان برای خریدهای بالای 70 دلار</p>
                            </div>
                        </div>
                    </div>
                    <!-- service item -->
                    <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0" dir="rtl">
                        <div class="d-flex flex-sm-row flex-column align-items-center align-items-sm-start">
                            <i class="ti-shield icon-lg ml-4 mb-3 mb-sm-0"></i>
                            <div class="text-center text-sm-right">
                                <h4>پرداخت امن</h4>
                                <p class="mb-0 text-gray">ما پرداخت ایمن را با PEV تضمین می کنیم</p>
                            </div>
                        </div>
                    </div>
                    <!-- service item -->
                    <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0" dir="rtl">
                        <div class="d-flex flex-sm-row flex-column align-items-center align-items-sm-start">
                            <i class="ti-timer icon-lg ml-4 mb-3 mb-sm-0"></i>
                            <div class="text-center text-sm-right">
                                <h4>پشتیبانی 24/7</h4>
                                <p class="mb-0 text-gray">24 ساعت شبانه روز و 7 روز هفته با ما تماس بگیرید</p>
                            </div>
                        </div>
                    </div>
                    <!-- service item -->
                    <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0" dir="rtl">
                        <div class="d-flex flex-sm-row flex-column align-items-center align-items-sm-start">
                            <i class="ti-reload icon-lg ml-4 mb-3 mb-sm-0"></i>
                            <div class="text-center text-sm-right">
                                <h4>تا 30 روز بازگشت</h4>
                                <p class="mb-0 text-gray">به سادگی آن را ظرف 30 روز برای تعویض برگردانید.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /service -->

        <!-- newsletter -->
        <section class="section bg-gray">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-title">خبرنامه ما</h2>
                        <p class="mb-4">برای دریافت پیشنهادات تخفیف زود هنگام در خبرنامه ما عضو شوید</p>
                    </div>
                    <div class="col-lg-6 col-md-8 col-sm-9 col-10 mx-auto" dir="rtl">
                        <form action="#" class="d-flex flex-column flex-sm-row">
                            <input type="email" class="form-control rounded-0 border-0 ml-3 mb-4 mb-sm-0" id="mail" placeholder="ایمیلتان را وارد کنید">
                            <button type="submit" value="send" class="btn btn-primary">عضویت</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- /newsletter -->

        <!-- Newsletter Modal -->
        <div class="modal fade subscription-modal" id="subscriptionModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <!-- modal content start -->
                <div class="modal-content">
                    <!-- container start -->
                    <div class="container-fluid">
                        <div class="row">
                            <!-- close button -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="col-lg-6 px-0">
                                <!-- newsletter image -->
                                <div class="image"><img src="images/newsletter-popup.jpg" alt="products" class="img-fluid w-100 rounded-left"></div>
                            </div>
                            <div class="col-lg-6 align-self-center p-5" dir="rtl">
                                <!-- Content start -->
                                <div class="text-center align-self-center">
                                    <h3 class="mb-lg-5 mb-4">خوش به حالت!</h3>
                                    <h4>فوری می خواهید</h4>
                                    <h2 class="mb-lg-5 mb-4">10% تخفیف؟</h2>
                                    <!-- newsletter form -->
                                    <div class="form">
                                        <input type="email" class="form-control mb-3" name="email" id="email" placeholder="آدرس ایمیل">
                                        <button class="btn btn-primary w-100" type="submit">به ما بپیوندید</button>
                                    </div>
                                </div>
                                <!-- Content end -->
                            </div>
                        </div>
                    </div>
                    <!-- container end -->
                </div>
                <!-- modal content end -->
            </div>
        </div>
        <!-- /Newsletter Modal -->
        @include("_master.footer")
    </div>
    <!-- /main wrapper -->
@endsection()


