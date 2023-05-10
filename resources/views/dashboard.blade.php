@extends('_master.main')
@section("title")  {{$_setting['title']}} | داشبورد @endsection()
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
					<li class="list-inline-item"><a class="active" href="{{route('home')}}">داشبورد</a></li>
					<li class="list-inline-item"><a href="{{route('orders')}}">سفارشات</a></li>
					<li class="list-inline-item"><a href="{{route('profile')}}">جزئیات پروفایل</a></li>
				</ul>
				<div class="dashboard-wrapper user-dashboard">
					<div class="media">
						<div class="pull-left ml-3">
							<img class="media-object user-img" src="{{$media}}" alt="Image">
						</div>
						<div class="media-body align-self-center">
							<h2 class="media-heading">خوش آمدی {{Auth::user()->name}}</h2>
							<p class="mb-0">{{Auth::user()->profile->about}}</p>
						</div>
					</div>
					<div class="total-order mt-4">
						<h4>مجموع سفارشات</h4>
						<div class="table-responsive">
                            @if($orders->count())
							<table class="table">
								<thead>
									<tr>
										<th>آیدی سفارش</th>
										<th>تاریخ</th>
										<th>تعداد</th>
										<th>مجموع قیمت</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->reference}}</td>
                                            <td>{{\Morilog\Jalali\Jalalian::forge(\Carbon\Carbon::parse($order->order_date)->timezone("ASIA/Tehran"))->format(" %d %B %Y ")}}</td>
                                            <td>{{$order->quantity}}</td>
                                            <td>${{$order->quantity * $order->product->today_price}}</td>
                                        </tr>
                                    @endforeach
								</tbody>
							</table>
                            @else
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h5 class="card-text">هنوز محصولی سفارش نداده اید؟</h5>
                                        <a href="{{ route('shop') }}" class="btn btn-primary mt-4 text-light">فروشگاه</a>
                                    </div>
                                </div>
                            @endif
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
    @include('_master.footer')
</div>
<!-- /main wrapper -->
@endsection

