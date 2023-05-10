@extends('_master.main')
@section("title")  {{$_setting['title']}} | سفارشات @endsection
@section('main')
<!-- main wrapper -->
<div class="main-wrapper">

<!-- breadcrumb -->
    <nav class="bg-gray py-3">
        <div class="container d-flex justify-content-end">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item active text-right" aria-current="page" >سفارشات</li>
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
                    <li class="list-inline-item"><a class="active" href="{{route('orders')}}">سفارشات</a></li>
                    <li class="list-inline-item"><a  href="{{route('profile')}}">جزئیات پروفایل</a></li>
                </ul>
				<div class="dashboard-wrapper user-dashboard">
					<div class="table-responsive">
                        @if($orders->count())
						<table class="table">
							<thead>
								<tr class="text-center">
									<th>آیدی سفارش</th>
									<th>تاریخ</th>
									<th>تعداد</th>
									<th>مجموع قیمت</th>
									<th>وضعیت</th>
                                    <th>عکس</th>
                                    <th>ویژگی ها</th>
									<th></th>
								</tr>
							</thead>
							<tbody class="text-center">
                            @foreach($orders as $order)
								<tr>
									<td>{{$order->reference}}</td>
									<td>{{\Morilog\Jalali\Jalalian::forge(\Carbon\Carbon::parse($order->order_date)->timezone("ASIA/Tehran"))->format(" %d %B %Y ")}}</td>
									<td>{{$order->quantity}}</td>
									<td>${{$order->quantity * $order->product->today_price}}</td>
                                    @switch($order->status)
                                        @case(1)
                                        <td><span class="badge badge-info">درحال پردازش</span></td>
                                         @break
                                        @case(2)
                                        <td><span class="badge badge-primary">در انتظار</span></td>
                                        @break
                                        @case(3)
                                        <td><span class="badge badge-success">کامل شده</span></td>
                                        @break
                                        @case(4)
                                        <td><span class="badge badge-danger">لغو شده</span></td>
                                        @break
                                        @endswitch

									<td>
                                        <a href="{{route('singleProduct', $order->product->slug)}}">
                                            <img style="width:70px;height:auto" src="{{$order->product->picture->original_url}}" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <div class="product-features text-center">
                                            <div class="mx-2">
                                                <span>{{$order->product->color[0]->name}}</span>
                                                <span class="color" style="background-color: {{$order->product->color[0]->color}}"></span>
                                            </div>
                                            <div class="mx-2">
                                                <small>{{$order->product->size[0]->size}}</small>
                                                <span class="ti-arrows-vertical" style="vertical-align:middle;"></span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
							</tbody>
						</table>
                        @else
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-text">محصولی در سفارشات وجود ندارد!</h5>
                                    <a href="{{ route('shop') }}" class="btn btn-primary mt-4 text-light">اکنون خرید کنید</a>
                                </div>
                            </div>
                        @endif
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

