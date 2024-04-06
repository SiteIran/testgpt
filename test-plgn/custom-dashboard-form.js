jQuery(document).ready(function($) {
    $('#custom-dashboard-form').submit(function(e) {
        e.preventDefault();

        // var formData = $(this).serialize();
        // formData += '&nonce=' + ajax_object.nonce;
        var formData = $(this).serialize();
        formData += '&nonce=' + $('#nonce').val(); // اضافه کردن مقدار nonce به داده‌های ارسالی

        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: formData,
            success: function(response) {
                $('#form-message').html('<div class="notice notice-success"><p>' + response.data + '</p></div>');
            },
            error: function(xhr, status, error) {
                console.log(error);

                $('#form-message').html('<div class="notice notice-error"><p>An error occurred while submitting the form</p></div>');
            }
        });
    });
});
