$(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click','.remove-cart',function(){
        let removeUrl = '/cart/'
        const cartID = '#' + $(this).closest('.cart-item').find('.setting').attr('id')
        $(cartID).load(document.URL + ' '+cartID+' > *', function(){
            const pID = $(cartID+ ' input').val()
            removeUrl += pID
            $.ajax({
                url: removeUrl,
                type:'DELETE',
                success:function(d){
                    console.log(d)
                    $(cartID).closest('.cart-item').remove()
                    $('#cart-section').load(document.URL +  ' #cart-section > *',function(){
                        clickCart()
                        iziToast.show({
                            message: 'محصول از سبد خرید حذف شد.',
                            theme: 'dark',
                            progressBarColor: '#04d404',
                            timeout: 1500,
                            rtl: true,
                            zindex: 99999999999,
                        })

                        if(!$('.cart-item').length){
                            $('#cart-page').load(document.URL +  ' #cart-page > *');
                        }
                    });

                },
                error:function(e){
                    console.log(e)
                }
            })
        })
    })

    $(document).on('change','.change-quantity',function(){
        let updateUrl = '/cart/'
        const quantity = $(this).val()
        const cartID = '#' + $(this).closest('.cart-item').find('.setting').attr('id')
        $(cartID).load(document.URL + ' '+cartID+' > *', function(){
            const pID = $(cartID+ ' input').val()
            updateUrl +=  pID
            $.ajax({
                url: updateUrl,
                type:'PUT',
                data:{quantity:quantity},
                success:function(){
                    $('#cart-section').load(document.URL +  ' #cart-section > *',function() {
                        clickCart()
                    })
                },
                error:function(e){
                    console.log(e)
                }
            })
        })
    })
})
