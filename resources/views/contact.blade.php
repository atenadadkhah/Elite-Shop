@extends("_master.main")
@section("title"){{$_setting['title']}} | تماس با ما @endsection()
@section("main")
    <!-- main wrapper -->
    <div class="main-wrapper">

        <!-- breadcrumb -->
        <nav class="bg-gray py-3">
            <div class="container d-flex justify-content-end">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item active text-right" aria-current="page" >تماس با ما</li>
                    <li class="breadcrumb-item text-right" ><a href="/">خانه</a></li>

                </ol>
            </div>
        </nav>
        <!-- /breadcrumb -->

        <!-- google map -->
        <section class="map">
            <!-- Google Map -->
            <div id="map_canvas" data-latitude="51.507351" data-longitude="-0.127758"></div>
        </section>
        <!-- /google map -->

        <!-- contact -->
        <section class="section" dir="rtl">
            <div class="container">
                <div class="row justify-content-between">
                    <!-- form -->
                    <div class="col-lg-7 mb-5 mb-lg-0 text-center text-md-right">
                        <h2 class="section-title">تماس با ما</h2>
                        <form action="#" class="row">
                            <div class="col-md-6">
                                <input type="text" id="firstName" name="firstName" class="form-control mb-4 rounded-0" placeholder="نام" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="lastName" name="lastName" class="form-control mb-4 rounded-0" placeholder="نام خانوادگی" required>
                            </div>
                            <div class="col-md-12">
                                <input type="text" id="subject" name="subject" class="form-control mb-4 rounded-0" placeholder="موضوع" required>
                            </div>
                            <div class="col-md-12">
                                <textarea name="message" id="message" class="form-control rounded-0 mb-4" placeholder="پیام"></textarea>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" value="send" class="btn btn-primary">ارسال کن!</button>
                            </div>
                        </form>
                    </div>
                    <!-- contact item -->
                    <div class="col-lg-4 text-right">
                        <div class="d-flex mb-60">
                            <i class="ti-location-pin contact-icon"></i>
                            <div>
                                <h4>مکان ما</h4>
                                <p class="text-gray">{{$_setting['address']}}</p>
                            </div>
                        </div>
                        <div class="d-flex mb-60">
                            <i class="ti-mobile contact-icon"></i>
                            <div>
                                <h4>حالا تماس بگیرید</h4>
                                @foreach($_setting['contact']['call'] as $call)
                                    <p dir="ltr" class="text-gray mb-0">{{$call['call']}}</p>
                                @endforeach
                            </div>
                        </div>
                        <div class="d-flex mb-60">
                            <i class="ti-email contact-icon"></i>
                            <div>
                                <h4>اکنون برای ما بنویسید</h4>
                                @foreach($_setting['contact']['email'] as $email)
                                    <p class="text-gray mb-0">{{$email['email']}}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /contact -->
        @include("_master.footer")

    </div>
    <!-- /main wrapper -->
@endsection

