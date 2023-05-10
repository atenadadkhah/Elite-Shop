@extends('_master.main')
@section("title"){{$_setting['title']}} | ورود @endsection()
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
                        <h2 class="text-center">خوش آمدید</h2>
                        <form class="text-left clearfix" action="{{route('login')}}" method="post" id="form">
                            @csrf
                            <div class="form-group">
                                <input type="text" data-validate="email" value="{{ old('email') }}" name="email" class="form-control" placeholder="ایمیل یا نام کاربری">
                                @error('email')
                                <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" data-validate="password" value="{{ old('password') }}" name="password" class="form-control" placeholder="رمز عبور">
                                @error('password')
                                <span class="invalid-feedback text-right" role="alert" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group position-relative mr-4">
                                <div class="checkbox d-flex">
                                    <input class="checkbox-flip" name="remember" type="checkbox" id="check1" />
                                    <label for="check1"><span >مرا به خاطر بسپار</span></label>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" >ورود</button>
                            </div>

                        </form>

                        <p class="mt-3">کاربر جدید هستید؟<a href="{{route('register')}}"> ساخت حساب جدید </a></p>
                        @if (Route::has('password.request'))
                            <a  href="{{ route('password.request') }}">
                                <small>{{ __('فراموشی رمز عبور') }}</small>
                            </a>
                        @endif
                        <hr>
                        <a href="{{route('social.redirect','google')}}" class="login-with-btn login-with-google-btn mx-2 social-login" >
                            ورود با گوگل
                        </a>
                        <a href="{{route('social.redirect','github')}}" class="login-with-btn login-with-github-btn social-login">
                            ورود با گیت هاب
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra_js')
    <script src="/js/data.js"></script>
@endsection

