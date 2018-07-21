$('.fn_task_preview').on('click', function () {
    var name = $('input[name="name"]').val();
    var email = $('input[name="email"]').val();
    var body = $('textarea[name="body"]').val();
    $('.fn_name').text(name);
    $('.fn_email').text(email);
    $('.fn_body').html(body);
    $('.fn_task_preview').fancybox();
});