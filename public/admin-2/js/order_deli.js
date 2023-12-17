$(document).ready(function() {
    $(".btn-delivery").click(function() {

        var buttonValue = $(this).val();
        let orderStatusTd = $(this).closest("tr").find(".order-status");
        var notice = $('.notice');
 
        $.ajax({
            type: "GET",
             url: "http://127.0.0.1:8000/api/order/deli/"+buttonValue,
            success: function (response) {
                orderStatusTd.text("Đang Giao");
                $(".notice_text span").text("Đơn Hàng Đang Giao");
                notice.addClass('active');
                setTimeout(function() {
                    notice.removeClass('active');
                }, 500); 
               
            }
        });
    })

})