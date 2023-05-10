@extends("_master.main")
@section("main")
    <!-- main wrapper -->
    <div class="main-wrapper">

        <section class="page-404 section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>404</h1>
                        <h2>صفحه پیدا نشد</h2>
                        <a href="/" class="btn btn-primary mt-4"><i class="ti-angle-double-left"></i> رفتن به صفحه اصلی</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- footer -->
    @include("_master.footer")
    <!-- /footer -->
    </div>
    <!-- /main wrapper -->
@endsection
