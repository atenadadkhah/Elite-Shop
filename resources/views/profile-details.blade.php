@extends('_master.main')
@section("title")  {{$_setting['title']}} | {{Auth::user()->name}} @endsection()
@section('main')
<!-- main wrapper -->
<div class="main-wrapper">
    <!-- breadcrumb -->
    <nav class="bg-gray py-3">
        <div class="container d-flex justify-content-end">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item active text-right" aria-current="page" >پروفایل من</li>
                <li class="breadcrumb-item text-right" ><a href="/">خانه</a></li>

            </ol>
        </div>
    </nav>
    <!-- /breadcrumb -->
    <section class="user-dashboard section text-right" dir="rtl">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
          <ul class="list-inline dashboard-menu text-center">
              <li class="list-inline-item"><a href="{{route('home')}}">داشبورد</a></li>
              <li class="list-inline-item"><a href="{{route('orders')}}">سفارشات</a></li>
              <li class="list-inline-item"><a class="active" href="{{route('profile')}}">جزئیات پروفایل</a></li>
          </ul>
        <div class="dashboard-wrapper dashboard-user-profile">
            <form action="{{route('profile')}}" id="form" class="dropzone" enctype="multipart/form-data" method="post">
                @csrf
                <div class="media row">
            <div class="text-center col-lg-4">
              <img id="profile" class="media-object user-img"  src="{{$media}}" alt="Image">

                <label  for="inputTag" class="btn mt-3 d-block dz-default dz-message" style="color:#ff4135">
                   تغییر عکس
                    <input id="inputTag" type="file" class="d-none" name="avatar" data-validate="avatar"/>
                </label>
                <div class="form-group">
                    <textarea name="about" placeholder="{{Auth::user()->profile->about ? '' : 'وارد نشده'}}" id="" cols="30" rows="10" class="form-control">{{Auth::user()->profile->about}}</textarea>
                </div>

                <div class="form-group col-md-12">
                    <button type="submit" name="submit" class="btn btn-primary" >
                       اعمال تغییرات
                    </button>
                </div>
            </div>
            <div class="media-body col-lg-5 mx-auto">

                        <div class="form-group">
                            <label for="fullName">نام کامل </label>
                            <input data-validate="fullName" class="form-control" id="fullName" type="text" name="fullName" value="{{Auth::user()->name}}">
                        </div>
                        <div class="form-group">
                            <label for="username">نام کاربری </label>
                            <input data-validate="userName" class="form-control" id="username" type="text" name="userName" value="{{Auth::user()->username}}">
                        </div>
                        <div class="form-group">
                            <label for="city">شهر </label>
                            <input data-validate="city" placeholder="{{Auth::user()->profile->country ? '' : 'وارد نشده'}}" class="form-control" id="city" type="text" name="city" value="{{Auth::user()->profile->country}}">
                        </div>
                        <div class="form-group">
                            <label for="phone">شماره تلفن </label>
                            <input data-validate="phone" placeholder="{{Auth::user()->profile->phone ? '' : 'وارد نشده'}}" class="form-control" id="phone" type="text" name="phone" value="{{Auth::user()->profile->phone}}">
                        </div>
                        <div class="form-group">
                            <label for="date">تاریخ تولد </label>
                            <input data-validate="birth" placeholder="{{Auth::user()->profile->birth ? '' : 'وارد نشده'}}" class="form-control" id="date" type="date" name="birth" value="{{Auth::user()->profile->birth}}">
                        </div>
            </div>
          </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</section>
@include('_master.footer')
</div>
    <!-- /main wrapper -->
@endsection()

@section('extra_js')
    <script src="/js/upload.js"></script>
    <script src="/js/data.js"></script>
@endsection

