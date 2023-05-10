@extends('_master.main')
@section("title"){{$_setting['title']}} | ثبت نام @endsection()
@section('meta')<meta name="csrf-token" content="{{ csrf_token() }}"> @endsection
@section('main')
    <section class="signin-page account text-right" dir="rtl">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="block text-center">
                        <a class="logo" href="/">
                            <img src="/{{$_setting['logo']['header']}}" alt="logo">
                        </a>
                        <h2 class="text-center">ساخت حساب کاربری جدید</h2>
                        <form class="text-left clearfix" action="{{route('register')}}" id="form" method="post">
                            @csrf
                            <div class="form-group text-right">
                                <input type="text"  class="form-control" data-validate="fullName" name="fullName" placeholder="نام کامل">
                            </div>

                            <div class="form-group text-right">
                                <input type="text" class="form-control" data-validate="userName" name="userName" placeholder="نام کاربری">
                            </div>
                            <div class="form-group text-right">
                                <input type="text" class="form-control" data-validate="email" name="email" placeholder="ایمیل">
                            </div>
                            <div class="form-group text-right">
                                <input type="password" class="form-control" data-validate="password" name="password" placeholder="رمز عبور">
                            </div>
                            <div class="text-center">
                                <button type="submit" name="register" class="btn btn-primary">عضویت</button>
                            </div>
                        </form>
                        <p class="mt-3">حساب دارید؟<a href="{{route('login')}}"> ورود</a></p>
                        <p><a href="forget-password.html"> فراموشی رمز عبور</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra_js')
    <script src="/js/data.js"></script>
@endsection()

