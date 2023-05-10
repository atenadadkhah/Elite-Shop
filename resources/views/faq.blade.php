@extends("_master.main")
@section("title"){{$_setting['title']}} | پرسش و پاسخ @endsection()
@section("main")
<!-- main wrapper -->
<div class="main-wrapper">

<!-- breadcrumb -->
    <nav class="bg-gray py-3">
        <div class="container d-flex justify-content-end">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item active text-right" aria-current="page" >پرسش و پاسخ</li>
                <li class="breadcrumb-item text-right" ><a href="/">خانه</a></li>

            </ol>
        </div>
    </nav>>
<!-- /breadcrumb -->

<section class="section text-right" dir="rtl">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h2>پرسش های متداول</h2>
				<p>در اینجا به برخی از پرسش های متداول مشتریان پاسخ داده خواهد شد.</p>
				<p>{{$media['contact']['email'][0]}}</p>
			</div>
			<div class="col-md-8">
				<!-- accordion -->
				<div class="accordion">
                    @foreach($faq as $index=>$item)
                        <div class="card">
                            <div class="card-header cursor-pointer" data-toggle="collapse" data-target="#collapse-{{$index}}">
                                <h4 class="mb-0">{{$item->question}}</h4>
                            </div>

                            <div id="collapse-{{$index}}" class="collapse {{!$index ? 'show' : ''}}">
                                <div class="card-body">
                                    {{$item->answer}}
                                </div>
                            </div>
                        </div>
                    @endforeach
				</div>
			</div>
		</div>
	</div>
</section>

@include('_master.footer')

</div>
<!-- /main wrapper -->
@endsection
