$(function(){
    const uploader = $('input[type="file"]')
    const firstFile = $('#profile').attr('src')
    uploader.change(function(evt){
        const fileName = $(this).val();
        if (fileName.length > 0){
            $('#inputTag').next('small').remove()
            if(checkExtension(fileName)){
                if (checkSize(this)){
                    const tgt = evt.target || window.event.srcElement,
                        files = tgt.files;
                    // FileReader support
                    if (FileReader && files && files.length) {
                        const fr = new FileReader();
                        fr.onload = function () {
                            $('#profile').attr('src',fr.result)
                        }
                        fr.readAsDataURL(files[0]);
                    }
                } else showError(this,'عکس باید کمتر از 2 مگابایت باشد.')
            }else showError(this,'فرمت عکس نادرست است.')
        }else $('#profile').attr('src',firstFile)
    })
})

const showError = (input,msg) =>{
    $(input).val('')
    alert(msg)
}

const checkExtension = (fileName) =>{
    const extension = fileName.slice((fileName.lastIndexOf(".") - 1 >>> 0) + 2)
    const acceptedEx = ['jpg','png','jpeg','webp','svg','gif','bmp']
    return acceptedEx.includes(extension)
}

const checkSize = (image) =>{
    const maxFileSize = 2 * 1024 * 1024
    const fileSize = image.files[0].size
    return fileSize <= maxFileSize
}
