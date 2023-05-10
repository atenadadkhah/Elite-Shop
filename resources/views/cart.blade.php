@extends("_master.main")
@section("title")  {{$_setting['title']}}  | سبد خرید @endsection()
@section("main")
    <nav class="bg-gray py-3">
        <div class="container d-flex justify-content-end">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item active text-right" aria-current="page" >سبد خرید</li>
                <li class="breadcrumb-item text-right" ><a href="/">خانه</a></li>

            </ol>
        </div>
    </nav>
    <div class="section text-right" dir="rtl">
        <div class="cart shopping"  >
            <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <div class="block">
                            <div class="product-list" id="cart-page">
                                @if ($_cart->count())
                                    <div class="table-responsive">
                                        <table class="table cart-table">
                                            <thead>
                                            <tr class="text-center">
                                                <th>نام محصول</th>
                                                <th>قیمت</th>
                                                <th>تعداد</th>
                                                <th>ویژگی ها</th>
                                                <th>جمع کل</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($_cart as $index=>$cart)
                                                    <tr class="text-center cart-item">
                                                        <td class="d-flex">
                                                            <div class="mx-5 remove-cart"><a class="product-remove"  href="#" >&times;</a></div>
                                                            <div class="product-info">
                                                                <a href="{{route('singleProduct',$cart->product->slug)}}"><img style="width:65px;height:auto" src="{{$cart->product->picture->original_url}}" alt="product-img"></a>
                                                                <a href="{{route('singleProduct',$cart->product->slug)}}">{{$cart->product->name}}</a>
                                                            </div>
                                                        </td>
                                                        <td>${{$cart->product->today_price}}</td>
                                                        <td class="setting d-none" id="{{hash('crc32',$cart->product->id)}}"><input type="hidden" name="p-id" value="{{base64_encode(openssl_encrypt($cart->id,'AES-128-ECB','!123456ad'))}}"></td>
                                                        <td dir="ltr" id="change-quantity-{{$index}}">
                                                            <input class="change-quantity"  type="text" value="{{$cart->quantity}}" name="cart-quantity" >
                                                        </td>
                                                        <td>
                                                            <div class="product-features text-center">
                                                                <div class="mx-2">
                                                                    <span>{{$cart->color->name}}</span>
                                                                  <span class="color" style="background-color: {{$cart->color->color}}"></span>
                                                                </div>
                                                                <div class="mx-2">
                                                                    <small>{{$cart->size->size}}</small>
                                                                    <span class="ti-arrows-vertical" style="vertical-align:middle;"></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>${{$cart->product->today_price*$cart->quantity}}</td>
                                                        <td></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div class="d-flex flex-column flex-md-row align-items-center">
                                        <input type="text" class="form-control text-md-right  mb-3 mb-md-0" name="coupon" id="coupon" placeholder="من یک کوپن تخفیف دارم">
                                        <button class="btn btn-outline-primary mr-md-3 w-100 mb-3 mb-md-0">اعمال کپن</button>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <ul class="list-unstyled text-right">
                                                <li>جمع کل <span class="d-inline-block w-100px">${{$cartSum}}</span></li>
                                                <li>مالیات برارزش افزوده <span class="d-inline-block w-100px">$10.00</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <hr>
                                    <a href="checkout.html" class="btn btn-primary float-right">ادامه</a>

                                @else
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h5 class="card-text">محصولی در سبد خرید موجود نیست!</h5>
                                            <a href="{{ route('shop') }}" class="btn btn-primary mt-4">فروشگاه</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('_master.footer')
@endsection

