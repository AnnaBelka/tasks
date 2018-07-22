$('.fn_task_preview').on('click', function () {
    var name = $('.fn_val_name').val();
    var email = $('.fn_val_email').val();
    var body = $('textarea[name="body"]').val();
    $('.fn_name').text(name);
    $('.fn_email').text(email);
    $('.fn_body').html(body);
    $('.fn_task_preview').fancybox();
});


/*

if(window.File && window.FileReader && window.FileList && window.Image) {
    function handleFileSelect(evt){
        var file = evt.target.files[0];
        if (typeof file != 'undefined') {
            if (!file.type.match('image.*')) {
                return false;
            }

            var logo_image = $(this).closest('.fn_dropzone').find('img.logo_image');

            var reader = new FileReader();
            reader.onload = (function (theFile) {
                return function (e) {

                    var dropzone = logo_image.closest('.fn_dropzone');
                    logo_image.prop("onerror", '');
                    logo_image.prop("src", e.target.result);
                    logo_image.show();
                    dropzone.addClass('active');
                    dropzone.find('.fn_label').hide();
                };
            })(file);
            reader.readAsDataURL(file);

        } else {
            $(this).closest(".fn_dropzone").find('img.logo_image').hide().prop("src", "");
            $(this).closest(".fn_dropzone").find('.fn_label').show();
            $(this).closest(".fn_dropzone").removeClass('active');
        }
    }
    $(document).on('change', '.fn_dropinput', handleFileSelect);
}
*/
