$(function(){
    const url = '/cart'
    $('form#add-to-cart').submit(function(e){
        e.preventDefault()
        $.ajax({
            url : url,
            type : 'POST',
            data : $(this).serialize(),
            success : function(data){
                console.table(data)
                if (data.status !== 'exist' && data.quantity) {
                    iziToast.show({
                        message: 'محصول به سبد اضافه شد.',
                        theme: 'dark',
                        progressBarColor: '#04d404',
                        timeout: 1500,
                        rtl: true,
                        zindex: 99999999999,
                    })
                    $('#cart-section').load(document.URL +  ' #cart-section > *',function(){
                        clickCart()
                    });
                }
            },
            error : function(req){
                console.log(req)
            }
        })

    })

})

