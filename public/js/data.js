$(function(){
    const url = document.URL
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('form#form').submit(function(e){
        e.preventDefault();
        const form = $(this);
        const data = new FormData(form[0])
        form.wrap('<fieldset disabled="disabled"></fieldset>')
        $('.invalid-feedback').remove()
        $('input[data-validate]').removeClass('is-invalid')
        const button = form.find('button[type="submit"]')
        const buttonText = button.text()
        const buttonWidth = button.outerWidth()
        const buttonHeight = button.outerHeight()
        button.css({'height':buttonHeight,'width':buttonWidth})
        button.html(`<div id="loading"></div>`)
        $.ajax({
            url : url ,
            type : 'POST',
            data : data,
            processData: false,
            contentType: false,
            success : function(){
               window.location.href = '/dashboard'
                iziToast.show({
                    message: 'با موفقیت انجام شد',
                    theme:'dark',
                    progressBarColor:'#04d404',
                    timeout:2500,
                    rtl:true,
                    zindex:99999999999,
                });
            },
            error : function(error){
                if (error.status === 422){
                    $(form).unwrap()
                    button.html(buttonText)
                    const errors = $.parseJSON(error.responseText);
                    $('input[data-validate]').each(function(index,elem){
                        if (msg = errors.errors[$(elem).attr('data-validate')]){
                            $(elem).after(`<span class="invalid-feedback text-right" role="alert"><strong>${msg}</strong></span>`)
                            $(elem).addClass('is-invalid')
                        }
                    })
                }
                else console.log(error);
            }
        })

    })
})
