@extends("_master.main")
@section("title")  {{$_setting['title']}} | محصولات | {{$product['name']}} @endsection()
@section("main")
<!-- main wrapper -->
<div class="main-wrapper">
    <!-- breadcrumb -->
    <nav class="bg-gray py-3">
        <div class="container d-flex justify-content-end">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item text-right" >{{$product->name}}</li>
                <li class="breadcrumb-item active text-right" aria-current="page" ><a href="{{route('shop')}}">محصولات</a></li>
                <li class="breadcrumb-item text-right" ><a href="/">خانه</a></li>

            </ol>
        </div>
    </nav>
    <!-- /breadcrumb -->

<div id="quickView" class="quickview">
  <div class="row w-100">
    <div class="col-lg-6 col-md-6 mb-5 mb-md-0 pl-5 pt-4 pt-lg-0 pl-lg-0">
      <img src="/images/feature/product.png" alt="product-img" class="img-fluid">
    </div>
    <div class="col-lg-5 col-md-6 text-center text-md-left align-self-center pl-5">
      <h3 class="mb-lg-2 mb-2">Woven Crop Cami</h3>
      <span class="mb-lg-4 mb-3 h5">$90.00</span>
      <p class="mb-lg-4 mb-3 text-gray">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspic atis unde omnis iste natus</p>
      <form action="#">
        <select class="form-control w-100 mb-2" name="color">
          <option value="brown">Brown Color</option>
          <option value="gray">Gray Color</option>
          <option value="black">Black Color</option>
        </select>
        <select class="form-control w-100 mb-3" name="size">
          <option value="small">Small Size</option>
          <option value="medium">Medium Size</option>
          <option value="large">Large Size</option>
        </select>

        <button id="cart" data-product-id="{{$product['id']}}" class="btn btn-primary w-100 mb-lg-4 mb-3" >افزودن به سبد خرید</button>
      </form>
      <ul class="list-inline social-icon-alt">
        <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a></li>
        <li class="list-inline-item"><a href="#"><i class="ti-twitter-alt"></i></a></li>
        <li class="list-inline-item"><a href="#"><i class="ti-vimeo-alt"></i></a></li>
        <li class="list-inline-item"><a href="#"><i class="ti-google"></i></a></li>
      </ul>
    </div>
  </div>
</div>

<!-- product-single -->
<section class="section text-right" dir="rtl">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 mb-4 mb-lg-0 mx-auto">
          <div style="width:80%;height:70%;" class="mx-auto">
              <img src="{{$product->picture->original_url}}" alt="" style="width:100%;height:100%;object-fit:cover;">
          </div>
      </div>
      <!-- produt details -->
      <div class="col-lg-6 mb-100">
        <h2>{{$product['name']}}</h2>
        <span class="{{$product['instock'] ? 'text-success' : 'text-danger'}}">{{$product['instock'] ? 'موجود است' : 'موجود نیست'}}</span>
        <ul class="list-inline p-0 mb-4">
            @php $rateSum=0 @endphp
            @if ($product->opinion->count())
            @foreach ($product->opinion as $opinion)
                @php $rateSum+=(int) $opinion->stars  @endphp
            @endforeach
            @endif
            @if ($rateSum)
            @for($i=0;$i<round($rateSum/$product->opinion->count());$i++)
                <li class="list-inline-item mx-0"><span class="rated"><i class="ti-star"></i></span></li>
            @endfor
            @endif

          <li class="list-inline-item"><a href="#" class="text-gray ml-3">( {{$product->opinion->count()}} نظر )</a></li>
        </ul>
        <h4 class="text-primary h3">{{$product['today_price']}}$ &nbsp;<s class="text-color ml-2">{{$product['previous_price'] ? $product['previous_price'].'$':  ''}}</s></h4>
          <form id="add-to-cart" method="post">
              <div class="d-flex flex-column flex-sm-row justify-content-between mb-4">
                @csrf
                <input id="quantity" class="quantity text-left mr-sm-2 mb-3 mb-sm-0" type="text" value="{{$lastCart->quantity ?? ''}}" name="quantity">
                <select class="form-control mx-sm-2 mb-3 mb-sm-0 text-center" name="color">
                    @foreach ($product->color as $color)
                        <option value="{{$color['id']}}" {{$lastCart && $lastCart->color->id==$color['id'] ? 'selected' : ''}}> رنگ {{$color['name']}} </option>
                    @endforeach
                </select>

                <select class="form-control ml-sm-2 mb-3 mb-sm-0" name="size">
                    @foreach ($product->size as $size)
                        <option value="{{$size['id']}}" {{$lastCart && $lastCart->size->id==$size['id'] ? 'selected' : ''}}>{{$size['size']}} </option>
                    @endforeach
                </select>
                <input type="hidden" value="{{$product['id']}}" name="pRe">
        </div>
              <button class="btn btn-primary mb-4" type="submit" {{$product->instock ? '' : 'disabled'}} style="cursor: {{$product->instock ? 'pointer' : 'initial'}}">سفارش</button>
          </form>
        <h4 class="mb-3"><span class="text-primary">بجنب!</span> تخفیف ها به زودی تمام میشود</h4>
        <!-- syo-timer -->
        <div class="syotimer dark">
            @php  use Carbon\Carbon;$discountDate=\Carbon\Carbon::parse($_setting['discount'])@endphp
            <div id="sale-timer" data-year="{{$discountDate->year}}" data-month="{{$discountDate->month}}" data-day="{{$discountDate->day}}" data-hour="{{$discountDate->hour}}"></div>
        </div>
        <hr>
        <div class="payment-option border border-primary mt-5 mb-4">
          <h5 class="bg-white">تسویه حساب ایمن تضمین شده</h5>
          <img class="img-fluid w-100 p-3" src="/images/payment-card/all-card.png" alt="payment-card">
        </div>
        <h5 class="mb-3">4 دلیلی که باید از ما بخرید</h5>
        <div class="row">
          <!-- service item -->
          <div class="col-lg-3 col-6 mb-4 mb-lg-0">
            <div class="d-flex">
              <i class="ti-truck icon-md ml-3"></i>
              <div class="align-items-center">
                <h6>تحویل رایگان</h6>
              </div>
            </div>
          </div>
          <!-- service item -->
          <div class="col-lg-3 col-6 mb-4 mb-lg-0">
            <div class="d-flex">
              <i class="ti-shield icon-md ml-3"></i>
              <div class="align-items-center">
                <h6>خرید امن</h6>
              </div>
            </div>
          </div>
          <!-- service item -->
          <div class="col-lg-3 col-6 mb-4 mb-lg-0">
            <div class="d-flex">
              <i class="ti-money icon-md ml-3"></i>
              <div class="align-items-center">
                <h6>کمترین قیمت</h6>
              </div>
            </div>
          </div>
          <!-- service item -->
          <div class="col-lg-3 col-6 mb-4 mb-lg-0">
            <div class="d-flex">
              <i class="ti-reload icon-md ml-3"></i>
              <div class="align-items-center">
                <h6>تا 30 روز بازگشت</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <h3 class="mb-3">توضیحات محصول</h3>
        <p class="text-gray mb-4">{{$product['description']}}</p>
          @if (!empty($product['features']))
        <h4>ویژگی های محصول</h4>
        <ul class="features-list">
                @foreach ($product['features'] as $feature)
                    <li>{{$feature['feature']}}</li>
                @endforeach
        </ul>
          @endif
      </div>
    </div>
  </div>
</section>
<!-- /product-single -->

<!-- testimonial -->
<section class="section bg-gray">
  <div class="container">
    <div class="row text-right" dir="rtl">
      <div class="col-lg-12">
        <h3 class="mb-4">نظرات برخی مشتریان</h3>
      </div>
        @if ($opinions->count())
            @foreach($opinions as $opinion)
            <!-- testimonial-item -->
                <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
                    <div class="d-flex">
                        <div>
                            <img width="60" height="60" class="rounded-circle ml-4" src="{{$opinion->user->picture ? $opinion->user->picture->original_url : $defaultUser}}" alt="customer-img">
                        </div>
                        <div>
                            <ul class="list-inline">
                                @for($i=0;$i<$opinion->stars;$i++)
                                    <li class="list-inline-item mx-0"><a href="#" class="rated"><i class="ti-star"></i></a></li>
                                @endfor
                            </ul>
                            <h4 class="text-dark">{{$opinion['title']}}</h4>
                            <p class="text-gray">{{$opinion['body']}}</p>
                            <h5 class="customer-name text-dark">{{$opinion->user->name}}</h5>
                        </div>
                    </div>
                </div>
        @endforeach
        @endif
    </div>
  </div>
</section>
<!-- /testimonial -->

<!-- related products -->
<section class="section text-right" dir="rtl">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="mb-4">شاید بپسندید...</h2>
      </div>
        @foreach($similarProducts as $similarProduct)
                <!-- product -->
                <div class="col-lg-3 col-sm-6 mb-5 mb-lg-0">
                    <div class="product text-center">
                        <div class="product-thumb">
                            <div class="overflow-hidden position-relative">
                                <a href="{{route("singleProduct",$similarProduct['slug'])}}">
                                    <img class="img-fluid w-100 mb-3 img-first" src="{{$similarProduct->picture->original_url}}" alt="product-img">

                                </a>
                                <div class="btn-cart">
                                    <a href="/shop/product/{{$similarProduct['slug']}}" class="btn btn-primary btn-sm">افزودن به سبد خرید</a>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3 class="h5"><a class="text-color" href="{{route("singleProduct",$similarProduct['slug'])}}">{{$similarProduct['name']}}</a></h3>
                            <span class="h5">${{$similarProduct['today_price']}}</span>
                        </div>
                        <!-- product label badge -->
                        <div class="product-label sale text-left">
                            {{$similarProduct['discount'] ? $similarProduct['discount'].' %' : ''}}
                        </div>
                    </div>
                </div>
                <!-- //end of product -->
        @endforeach


    </div>
  </div>
</section>
<!-- /related products -->

@include("_master.footer")

</div>
<!-- /main wrapper -->
@endsection

@section('extra_css')
    <link rel="stylesheet" href="/plugins/izitoast/dist/css/iziToast.css">
@endsection
@section('extra_js')
    <script src="/js/cart.js"></script>
@endsection
