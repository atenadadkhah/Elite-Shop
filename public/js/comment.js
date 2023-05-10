$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('submit','form',function(e){
        e.preventDefault();
        const formID = '#'+$(this).attr('id')
        const msg = $(formID).find('[name="message"]').val()
        $(formID).find('#submit').attr('disable','disable')
        $(formID).load(document.URL +  ' '+formID+' > *', function(){
            const url = $(formID +' .url').attr('data-url')
            $.ajax({
                url : url,
                type : "POST",
                data : $(formID).serialize() + '&message=' + msg,
                success:function(){
                    $('.modal').modal('hide');
                    $(formID).find('[name="message"]').val("")
                    $('#show-comments').load(document.URL +  ' #show-comments')
                    $('#comment-q').load(document.URL +  ' #comment-q')
                },
                error:function(e){
                    console.log(e)
                }
             })
               // enable the submit button
               $(formID).find('#submit').removeAttr('disable')
        })

    })

})
