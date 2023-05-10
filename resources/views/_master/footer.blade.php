<!-- footer -->
<footer class="bg-light">
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 mb-5 mb-md-0 text-center text-sm-right">
                    <h4 class="mb-4">تماس</h4>
                    <p>{{$_setting['address']}}</p>
                    <p>{{$_setting['contact']['phone']}}</p>
                    <p>{{$_setting['contact']['email'][0]['email']}}</p>
                    <ul class="list-inline social-icons p-0">
                        @foreach($_setting['social_media'] as $media)
                            <li class="list-inline-item"><a href="{{$media['url']}}"><i class="ti-{{$media['media']}}"></i></a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 mb-5 mb-md-0 text-center text-sm-right">
                    <h4 class="mb-4">دسته ها</h4>
                    <ul class="pl-0 list-unstyled">
                        <li class="mb-2"><a class="text-color" href="shop.html">زنان</a></li>
                        <li class="mb-2"><a class="text-color" href="shop.html">مردان</a></li>
                        <li class="mb-2"><a class="text-color" href="shop.html">کودکان</a></li>
                        <li class="mb-2"><a class="text-color" href="shop.html">وسایل جانبی</a></li>
                        <li class="mb-2"><a class="text-color" href="shop.html">کفش</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 mb-5 mb-md-0 text-center text-sm-right">
                    <h4 class="mb-4">لینک های مفید</h4>
                    <ul class="pl-0 list-unstyled">
                        <li class="mb-2"><a class="text-color" href="about.html">اخبار و نکته ها</a></li>
                        <li class="mb-2"><a class="text-color" href="about.html">درباره ما</a></li>
                        <li class="mb-2"><a class="text-color" href="address.html">پشتیبانی</a></li>
                        <li class="mb-2"><a class="text-color" href="shop.html">فروشگاه ما</a></li>
                        <li class="mb-2"><a class="text-color" href="{{route("contact")}}">تماس با ما</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 text-center text-sm-right">
                    <h4 class="mb-4">سیاست های ما</h4>
                    <ul class="pl-0 list-unstyled">
                        <li class="mb-2"><a class="text-color" href="404.html">سیاست حفظ حریم خصوصی</a></li>
                        <li class="mb-2"><a class="text-color" href="404.html">شرایط و ضوابط</a></li>
                        <li class="mb-2"><a class="text-color" href="404.html">خط مشی کوکی</a></li>
                        <li class="mb-2"><a class="text-color" href="404.html">شرایط فروش</a></li>
                        <li class="mb-2"><a class="text-color" href="dashboard.html">ارسال رایگان و مرجوعی</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-5 text-center text-md-left mb-4 mb-md-0 align-self-center">
                    <p class="text-white mb-0">Logo &copy; 2018 all right reserved</p>
                </div>
                <div class="col-md-2 text-center text-md-left mb-4 mb-md-0">
                    <img src="{{$_setting['logo']['footer']}}" alt="logo">
                </div>
                <div class="col-md-5 text-center text-md-right mb-4 mb-md-0">
                    <ul class="list-inline">
                        <li class="list-inline-item"><img class="img-fluid rounded atm-card-img" src="/images/payment-card/card-1.jpg" alt="card"></li>
                        <li class="list-inline-item"><img class="img-fluid rounded atm-card-img" src="/images/payment-card/card-2.jpg" alt="card"></li>
                        <li class="list-inline-item"><img class="img-fluid rounded atm-card-img" src="/images/payment-card/card-3.jpg" alt="card"></li>
                        <li class="list-inline-item"><img class="img-fluid rounded atm-card-img" src="/images/payment-card/card-4.jpg" alt="card"></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- /footer -->
