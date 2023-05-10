@extends("_master.main")
@section("title") فروشگاه | {{$_setting['title']}} @endsection
@section("main")
    <!-- main wrapper -->
    <div class="main-wrapper">

        <!-- breadcrumb -->
        <nav class="bg-gray py-3">
            <div class="container d-flex justify-content-end">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item active text-right" aria-current="page" >فروشگاه</li>
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
                        <button class="btn btn-primary w-100 mb-lg-4 mb-3">add to cart</button>
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

        <!-- shop -->
        <section class="text-right section" dir="rtl">
            <div class="container">
                <div class="row">
                    <!-- top bar -->
                    <div class="col-lg-12 mb-50">
                        <div class="d-flex border">
                            <div class="flex-basis-15 p-2 p-sm-4 border-right text-center">
                                <span class="text-color d-inline-block px-1 cursor-pointer" data-layout="1"><i class="ti-layout-grid3-alt"></i></span>
                                <span class="text-gray d-inline-block px-1 cursor-pointer" data-layout="2"><i class="ti-view-list-alt"></i></span>
                            </div>
                            <div class="flex-basis-70 p-2 p-sm-4 align-self-sm-center">
                                <p class="text-gray mb-0">نشان دادن <span class="text-color"><span id="from">1</span>- <span id="to">9</span> از  <span id="total">20</span></span> نتیجه</p>
                            </div>

                            <div class="flex-basis-15 p-2 p-sm-4 text-center">
                                <select class="select" name="sort" id="sort" data-filter="sort">
                                    <option value="0">چیدمان</option>
                                    <option value="1">الف-ی</option>
                                    <option value="2">ی-الف</option>
                                    <option value="3">محبوبیت</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- sidebar -->
                    <div class="col-lg-3">
                            <!-- categories -->
                            <div class="mb-30">
                                <h4 class="mb-3">دسته ها</h4>
                                <ul class="p-0 shop-list list-unstyled">
                                    @foreach ($_categories as $category)
                                        @if (!$category['sub'])
                                            <div class="d-flex justify-content-between custom-checkbox" dir="rtl">
                                                <label class="label" for="{{$category['title']}}"><span>{{$category['title']}}</span>
                                                    <input data-filter="category" type="checkbox" id="{{$category['title']}}" name="category" value="{{$category['id']}}">
                                                    <span class="box"></span>
                                                    <span>({{$_productCats[$category->id]->count()}})</span>
                                                </label>
                                            </div>

                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <hr>
                            <!-- price range -->
                            <div class="mb-30">
                               <h4 class="mb-4">قیمت</h4>
                                <input  class="range-track" type="text" data-slider-min="100" data-slider-max="1000" data-slider-step="5"
                                       data-slider-value="[100,1000]" />
                                <div class="d-flex justify-content-between">
                                    <span class="value">$100 - $1000</span>
                                </div>
                            </div>
                            <hr>
                            <!-- size checkbox -->
                            <div class="mb-30">
                                <h4 class="mb-3">اندازه ی موجود</h4>
                                <form action="#">
                                    @foreach ($_sizes as $size)
                                        <div class="d-flex justify-content-between custom-checkbox " dir="ltr">
                                            <label class="label" for="{{$size->size}}">{{$size->size}}
                                                <input type="checkbox" name="size" id="{{$size->size}}" data-filter="size" value="{{$size->id}}">
                                                <span class="box"></span>
                                            </label>
                                        </div>
                                    @endforeach

                                </form>
                            </div>
                            <!-- color selector -->
                            <div class="color">
                                <h4 class="mb-3">رنگ موجود</h4>
                                <ul class="p-0 list-inline ">
                                    @foreach($_colors as $color)
                                        <li class="list-inline-item mr-4" >
                                            <label class="radio ml-3">
                                                <input type="checkbox" name="color" data-filter="color" value="{{$color->id}}">
                                                <span class="radio-box" style="background-color: {{$color->color}};right:0"></span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                    </div>
                    <!-- product-list -->
                    <div class="col-lg-9 position-relative">
                        <div class="row" id="spinner">
                        </div>
                        <div class="row filter-product">
                        </div>
                        <div class="col-12 pagination-part position-absolute" style="bottom: -3rem;">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /shop -->

        <!-- footer -->
    @include("_master.footer")
    <!-- /footer -->
    </div>
    <!-- /main wrapper -->
@endsection
@section("extra_js")
    <script src="/js/shop.js"></script>
@endsection
