/*
By Atena Dadkhah
github ==> https://github.com/Atenad86
*/
let url = new URL(document.URL);
let param = new URLSearchParams(url.search);
const limit = 6
let currentPage = param.get('page') ?? 1
let startIndex = (currentPage -1)*limit
let endIndex = startIndex + limit
$(function(){
    filterData()
    $('.range-track').on('slideStop',function (slideEvt){
        $('.value').text('$' + slideEvt.value[0] + ' - ' + '$' + slideEvt.value[1]);
        filterData()
    });
    $("[data-filter]").change(function(){
        $(".filter-product").html("")
        filterData()
    })
    $("span[data-layout]").click(function(){
        localStorage.setItem("layout", $(this).attr("data-layout"))
        makeProductElement($(this).attr("data-layout"), localStorage.getItem("productsData"),startIndex,endIndex)
    })
})

//filters data
const filterData =()=>{
    param.set('page', 1);
    pageSetting(`/shop?${param.toString()}`)

    $("#spinner").html(`<div class="mx-auto spinner-border text-secondary" style="width: 3rem; height: 3rem;" role="status"><span class="sr-only">Loading...</span></div>`)

    const action = "filter-data";
    const rangeTrack = $(".range-track").val().split(",")
    const category = getFilter("category");
    const size = getFilter("size");
    const color = getFilter("color");
    const sort = getFilter("sort",'').toString();
    const search = param.get('search') ?? null
    const dataObj = {search:search,action:action,priceRange:rangeTrack,category:category,size:size,color:color,sort:sort}

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        $.ajax({
            url : "/shop",
            type : "POST",
            data : dataObj,
            success:function(data){
                if (data){
                    localStorage.setItem("productsData",JSON.stringify(data));
                }else{
                    localStorage.setItem("productsData",null);
                }
                makeProductElement(localStorage.getItem("layout") ?? '1', localStorage.getItem('productsData'),startIndex,endIndex)
                paginate(data,$('ul.pagination'))
                $(".spinner-border").remove()

            },
            error:function(){
                alert("error");
            }
        });

}

// gets all applied filter values
const getFilter=(dataFilter,action=":checked")=>{
    let filter = [];
    $(`[data-filter='${dataFilter}']${action}`).each((index,element)=>{
        filter.push($(element).val())
    })
    return filter;
}

//creates elements of the products
const makeProductElement=(layout,data,from,to)=>{
    data = typeof data == "object" ? data : JSON.parse(data)
    if (data){
        $('#from').text(from + 1)
        $('#to').text(data.length >= to ? to : data.length)
        $('#total').text(data.length)
        $(".filter-product").html("")
        data = data.slice(from,to)
        switch (layout) {
            case '1':
                $.each(data ,function(index,product){
                    $(".filter-product").append(`
               <div class="col-lg-4 col-sm-6 mb-4">
                                    <div class="product text-center">
                                        <div class="product-thumb">
                                            <div class="overflow-hidden position-relative">
                                                <a href="/shop/product/${product.slug}">
                                                    <img class="img-fluid w-100 mb-3 img-first" src="${product.picture.original_url}" alt="product-img">
                                                </a>
                                                <div class="btn-cart">
                                                    <a href="/shop/product/${product.slug}" class="btn btn-primary btn-sm">افزودن به سبد خرید</a>
                                                </div>
                                            </div>
                                            <div class="product-hover-overlay">
                                                <a href="#" class="product-icon favorite" data-toggle="tooltip" data-placement="left" title="علایق"><i
                                                        class="ti-heart"></i></a>
                                                <a href="#" class="product-icon cart" data-toggle="tooltip" data-placement="left" title="Compare"><i
                                                        class="ti-direction-alt"></i></a>
                                                <a data-vbtype="inline" href="#quickView" class="product-icon view venobox" data-toggle="tooltip"
                                                   data-placement="left" title="Quick View"><i class="ti-search"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <h3 class="h5"><a class="text-color" href="/shop/product/${product.slug}">${product.name}</a></h3>
                                            <span class="h5">${product.today_price}$</span>
                                        </div>
                                        <!-- product label badge -->
                                            <div class="product-label sale text-left">
                                                ${product.discount ? product.discount+' %' : ''}
                                            </div>
                                    </div>
                                </div>
               `)
                })
                break
            case '2':
                $.each(data,function(index,product){
                    $(".filter-product").append(`
                    <div class="product mb-4">
                    <div class="row align-items-center px-3">
                        <div class="col-sm-4">
                            <div class="product-thumb position-relative text-center">
                                <div class="overflow-hidden position-relative">
                                    <a href="/shop/product/${product.slug}">
                                        <img class="img-fluid w-100 mb-3 img-first" src="${product.picture.original_url}"
                                            alt="product-img">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="product-info">
                                <h3 class="mb-md-4 mb-3"><a class="text-color" href="/shop/product/${product.slug}">${product.name}</a></h3>
                                <p class="mb-md-4 mb-3 product-description">${product.description.substring(0,230)}...</p>
                                <span class="h4">$${product.today_price}</span>
                                <ul class="list-inline mt-3">
                                    <li class="list-inline-item"><a href="#" class="btn btn-dark btn-sm">اضافه به علاقه مندی ها</a></li>
                                    <li class="list-inline-item"><a href="#" class="btn btn-primary btn-sm">اضافه به سبد خرید</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- product label badge -->
                    <div class="product-label sale">
                         ${product.discount ? product.discount+' %' : ''}
                    </div>
                </div>
               `)
                })
                break
        }

    }
    else{
        $(".filter-product").html(`<div class="alert alert-warning mx-auto"><span>محصولی با این مشخصات وجود ندارد.</span></div>`)
    }
    $('html, body').animate({scrollTop:0},600);

}

const paginate=(data,element,limit=6)=>{
    const lastPage = Math.ceil(data.length / limit)
    $(element).html('')
    if (lastPage > 1){
        const halfTotalLinks = Math.floor(limit / 2)
        let from = currentPage - halfTotalLinks
        let to = currentPage + halfTotalLinks
        param.set('page', 1);
        $(element).append(`<li class="page-item ${currentPage == 1 ? 'disabled' : ''}"><a class="page-link big" href="/shop?${param.toString()}">اولین</a></li>`)
        for (let i=1;i <= lastPage ; i++){
            if (currentPage < halfTotalLinks) {
                to += halfTotalLinks - currentPage;
            }
            if (lastPage - currentPage < halfTotalLinks) {
                from -= halfTotalLinks - (lastPage - currentPage) - 1;
            }
            if (from < i && i < to) {
                param.set('page', i);
                $(element).append(`<li class="page-item ${currentPage == i ? 'active': ''}"><a class="page-link" href="/shop?${param.toString()}">${i}</a>
            </li>`)
            }

        }
        param.set('page', lastPage);
        $(element).append(`<li class="page-item ${currentPage == lastPage ? ' disabled' : ''}"><a class="page-link big" href="/shop?${param.toString()}">آخرین</a></li>`)


        $('a.page-link').click(function(event){
            event.preventDefault()
            pageSetting($(this).attr('href'))
            paginate(data,$('ul.pagination'))
            makeProductElement(localStorage.getItem("layout") ?? '1', localStorage.getItem('productsData'),startIndex,endIndex)

        })
    }

}

const pageSetting=(urlState)=>{
    window.history.pushState({},'',urlState);
    url = new URL(document.URL);
    param = new URLSearchParams(url.search);
    currentPage = param.get('page') ?? 1
    startIndex = (currentPage -1)*limit
    endIndex = startIndex + limit
}
