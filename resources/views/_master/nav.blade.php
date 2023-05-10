<!-- header -->
<header>
    <!-- top advertise -->
    <!-- <div class="alert alert-secondary alert-dismissible fade show rounded-0 pb-0 mb-0" role="alert">
      <div class="d-flex justify-content-between">
        <p>SAVE UP TO $50</p>
        <h4>SALE!</h4>
        <div class="shop-now">
          <a href="shop.blade.php" class="btn btn-sm btn-primary">Shop Now</a>
        </div>
      </div>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div> -->

    <!-- top header -->
    <div class="top-header">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left order-2 order-lg-1">
                <ul class="list-inline">
                    <li class="list-inline-item flag"><img src="/images/flag.jpg" alt="flag" width="40"></li>
                    <li class="list-inline-item">
                        @auth
                            <a href="{{route('home')}}">{{Auth::user()->username}}</a>
                            @else
                            <a href="{{route('login')}}">حساب من</a>
                        @endauth
                    </li>
                    @auth
                    <li class="list-inline-item" title="خروج" style="margin: 0 !important;padding: 0 !important">
                        <a class="px-3"  href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="ti-shift-right text-center"></i>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    @endauth
                    <li class="list-inline-item">
                        <form action="#">
                            <select name="country" class="country">
                                <option value="" class="country-option"></option>
                            </select>
                        </form>
                </ul>
            </div>
            <div class="col-lg-6 text-center text-lg-right order-1 order-lg-2">
                <p class="text-white mb-lg-0 mb-1">{{$_setting['description']}}</p>
            </div>
        </div>
    </div>
    <!-- /top-header -->
</header>

<!-- navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white w-100" id="navbar">
    <a class="navbar-brand order-2 order-lg-1" href="{{env('APP_URL')}}"><img class="img-fluid" src="/{{$_setting['logo']['header']}}" alt="logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-1 order-lg-2" id="navbarSupportedContent" dir="rtl">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">خانه</a>
            </li>
            <li class="nav-item dropdown view" >
                <a class="nav-link dropdown-toggle" href="{{route("shop")}}" role="button" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    فروشگاه
                </a>
                <div class="dropdown-menu text-right " style="left:-50% !important">
                    <a class="dropdown-item" href="{{route("shop")}}">فروشگاه</a>
                    <a class="dropdown-item" href="shipping.html">روش حمل و نقل</a>
                    <a class="dropdown-item" href="payment.html">روش پرداخت</a>
                    <a class="dropdown-item" href="review.html">مرور</a>
                    <a class="dropdown-item" href="confirmation.html">تائیدیه</a>
                    <a class="dropdown-item" href="track.html">پیگیری سفارش</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route("blog")}}">وبلاگ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route("about-us")}}">درباره ما</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route("contact")}}">تماس با ما</a>
            </li>
        </ul>
    </div>
    <div class="order-3 navbar-right-elements">
        <div class="search-cart">
            <!-- search -->
            <div class="search" dir="rtl">
                <button id="searchOpen" class="search-btn"><i class="ti-search"></i></button>
                <div class="search-wrapper">
                    <form action="{{route('shop')}}" method="get">
                        <input class="search-box" name="search" id="search" type="text" placeholder="جستوجو کنید">
                        <button class="search-icon " type="submit"><i class="ti-search"></i></button>
                    </form>
                </div>
            </div>
            <!-- cart -->
                <div class="cart" id="cart-section">
                    <button id="cartOpen" class="cart-btn"><span class="quantity">{{$_cart->sum('quantity')}}</span>
                        <span class="d-xs-none">&nbsp;سبد خرید </span> <i class="ti-bag"></i> </button>
                    <div class="cart-wrapper text-right">
                        <i id="cartClose" class="ti-close cart-close" ></i>
                        <h4 class="mb-4">سبد خرید شما</h4>
                        <ul class="cart-items pl-0 mb-3">
                            @if ($_cart->count())
                                @foreach ($_cart as $index => $cart)
                                    <li  class="li-cart d-flex border-bottom position-relative text-right cart-item" >
                                        <a class="cart-f" href="{{route('singleProduct',$cart->product->slug)}}">
                                            <img style="width:65px;height:auto" src="{{$cart->product->picture->original_url}}" alt="product-img">
                                        </a>
                                        <div class="mx-3">
                                            <h6 >{{$cart->product->name}}</h6>
                                            <span class="p-q">{{$cart->quantity}}</span> X <span>{{$cart->product->today_price}}</span>
                                        </div>
                                        <div class="product-features d-flex position-absolute">
                                    <span class="mx-2">
                                        <span>{{$cart->color->name}}</span>
                                      <span class="color" style="background-color: {{$cart->color->color}}"></span>
                                    </span>
                                            <span class="mx-2">
                                        <small>{{$cart->size->size}}</small>
                                        <span class="ti-arrows-vertical" style="vertical-align:middle;"></span>
                                    </span>
                                        </div>
                                        <div class="remove-cart">
                                            <i class="ti-close"></i>
                                        </div>
                                        <div class="setting d-none" id="cart-setting-nav-{{$index}}"><input type="hidden" name="p-id" value="{{base64_encode(openssl_encrypt($cart->id,'AES-128-ECB','!123456ad'))}}"></div>
                                    </li>
                                @endforeach
                            @else
                                <div dir="rtl" class="w-75 text-center alert alert-danger mx-auto"><span>محصولی در سبد خرید وجود ندارد.</span></div>
                            @endif

                        </ul>
                        <div class="mb-2 p-2" style="border-top:1px solid #d9d4d4;">
                            <span>مجموع</span>
                            <span class="float-left">$ {{$cartSum}}</span>
                        </div>
                        <div class="text-center">
                            <a href="{{route('cart.index')}}" class="btn btn-dark btn-mobile rounded-0">مشاهده سبد خرید</a>
                            <a href="shipping.html" class="btn btn-dark btn-mobile rounded-0">بررسی</a>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</nav>
<!-- /navigation -->
