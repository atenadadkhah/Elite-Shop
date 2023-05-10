$(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click','.remove-user',function(){
        const removeUrl = '/users/remove'
        const userID = '#' + $(this).closest('.user-item').find('.setting').attr('id')
        $(userID).load(document.URL + ' '+userID+' > *', function(){
            const uID = $(userID + ' input').val()
            iziToast.show({
                message: 'آیا از حذف کاربر مطمئن هستید؟',
                theme: 'dark',
                progressBarColor: '#3EBDFF',
                timeout: 6000,
                buttons: [
                    ['<button>حذف</button>', function (instance, toast) {
                        instance.hide({
                            transitionOut: 'fadeOutUp',
                            onClosing: function(){
                                $.ajax({
                                    url: removeUrl,
                                    type:'POST',
                                    data:{uID:uID},
                                    success:function(d){
                                        $(userID).closest('.user-item').remove()
                                        iziToast.show({
                                            message: 'کاربر حذف شد.',
                                            theme: 'dark',
                                            progressBarColor: '#04d404',
                                            timeout: 1500,
                                            rtl: true,
                                            zindex: 99999999999,
                                        })
                                        // updating user's number
                                        $('.user-count').text($('.user-count').text()-1)
                                        $('#pagination').load(document.URL + ' #pagination > *')
                                        if(!$('.user-item').length){
                                            $('#user-page').load(document.URL +  ' #user-page > *');
                                        }

                                    },
                                    error:function(e){
                                        console.log(e)
                                    }
                                })
                            }
                        }, toast, 'buttonName');
                    }],
                    ['<button>لغو</button>', function (instance, toast) {
                        instance.hide({
                            transitionOut: 'fadeOutUp',
                        }, toast, 'buttonName');
                    }]
                ],
                rtl: true,
                zindex: 99999999999,
            })

        })
    })

    $(document).on('change','[id*="select-role"]',function(){
        const updateUrl = '/users/update'
        const item = $(this)
        const role = item.val()
        const userID = '#' + $(this).closest('.user-item').find('.setting').attr('id')
        $(userID).load(document.URL + ' '+userID+' > *', function(){
            const uID = $(userID+ ' input').val()
            iziToast.show({
                message: 'نقش کاربر تغییر کند؟',
                theme: 'dark',
                progressBarColor: '#3EBDFF',
                timeout: 6000,
                buttons: [
                    ['<button>تأیید</button>', function (instance, toast) {
                        instance.hide({
                            transitionOut: 'fadeOutUp',
                            onClosing: function(){
                                $.ajax({
                                    url: updateUrl,
                                    type:'POST',
                                    data:{uID:uID,role:role},
                                    success:function(a){
                                        iziToast.show({
                                            message: 'نقش کاربر تغییر کرد.',
                                            theme: 'dark',
                                            progressBarColor: '#04d404',
                                            timeout: 1500,
                                            rtl: true,
                                            zindex: 99999999999,
                                        })
                                    },
                                    error:function(e){
                                        console.log(e)
                                    }
                                })
                            }
                        }, toast, 'buttonName');
                    }],
                    ['<button>لغو</button>', function (instance, toast) {
                        instance.hide({
                            transitionOut: 'fadeOutUp',
                        }, toast, 'buttonName');
                    }]
                ],
                rtl: true,
                zindex: 99999999999,
            })

        })
    })
})
