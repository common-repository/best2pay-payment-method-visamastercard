jQuery(document).ready(function ($) {
    $('#button_best2pay_complete').on('click', function () {
        let data = {
            action: 'best2pay_make_complete',
            best2pay_nonce_value: $("#nonce_best2pay_complete").val(),
            order_id: $('#post_ID').val()
        };

        let result = confirm("Списать захолдированные средства?");

        if (result) {
            jQuery.post("/?wc-api=best2pay_complete_action", data, function (response) {
                alert(JSON.parse(response).message);

                document.location.reload(true);
            });
        }
    })
});