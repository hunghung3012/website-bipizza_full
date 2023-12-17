$(document).ready(function () {
    setTimeout(function () {
        $(".loader").hide();
        $(".all_container").css("filter", "blur(0)");
    }, 500);

    const list_cart = $(".shopping-cart");
    const sub_total = $(".sub_total .sub_total_item");
    const voucher = $(".coupon_total_item");
    const totalItem = $(".total_item");
    const buttonTotal = $(".under_total button");
    const ship_item = $(".ship_item");
    const buttonCoupon = $(".coupon-input_button button");
    const inputCoupon = $(".coupon-input_button input");
    const formDelivery = $(".delivery");
    const noticeSucess = $(".notice_sucess");
    const overlay = $(".overlay");
    const coupon_input_hidden = $(".coupon-input-hidden");
    const id_input_hidden = $(".id-input-hidden");
    var conpon_temp = 0;

    // Kiểm tra mã giảm giá
    buttonCoupon.click(function (event) {
      event.preventDefault();
        const notice = $(".notice_text span");
        if (inputCoupon.val() == "") {
            showNotice(notice, "Vui Lòng Nhập Mã");
        } else {
         
            var coupon = inputCoupon.val();
            
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/renderCart/checkCoupon",
                data: {
                    coupon: coupon,
                    _token: $('.coupon-input_button').find('input[name="_token"]').val()
                },
                success: function (response) {
                   

                    if (!response.valid) {
                        showNotice(notice, response.msg);
                    } else {
                        voucher.text(response.money_coupon);
                      
                        totalItem.text(formatNumber(response.total) )

                        coupon_input_hidden.val(response.coupon_temp);
                        id_input_hidden.val(response.magiam);
                        $(".arrow").addClass("active");
                        setTimeout(function () {
                            $(".arrow").removeClass("active");
                        }, 500);
                    }
                },
            });
        }
    });



    $(".number_input").change(function () {
        var id_row = $(this).data("id-row");
        var quantity = $(this).val();
        var totalPriceElement = $(this).closest('.item').find('.total-price');
        $.ajax({
  
            type: "POST",
            url: "http://127.0.0.1:8000/renderCart/chageQuantity",
            data: {
                id_row: id_row,
                quantity: quantity,
                _token: $('input[name="_token"]').val(),
            },
            success: function (response) {
                console.log(formatNumber(response.product.qty*response.product.price));
                totalPriceElement.text(formatNumber(response.product.qty*response.product.price))
                sub_total.text(response.total)
                console.log(response);
                if(inputCoupon.val() != "") {
                  buttonCoupon.click();
                }
            },
        });
    });
    inputCoupon.keydown(function (event) {
        if (event.key === "Enter") {
            checkCoupon();
        }
    });
    function formatNumber(number) {
      var numberString = number.toString();
      var formattedNumber = numberString.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      return formattedNumber+"đ";
  }

    function checkCoupon() {
        const notice = $(".notice_text span");
        if (inputCoupon.val() == "") {
            showNotice(notice, "Vui Lòng Nhập Mã");
        } else {
            let bool = false;
            let price = 0;
            $.each(voucher_list, function (index, item) {
                if (item.name == inputCoupon.val().toUpperCase()) {
                    bool = true;
                    price = item.value;
                }
            });
            if (bool) {
                $(".arrow").addClass("active");
                setTimeout(function () {
                    $(".arrow").removeClass("active");
                }, 500);
                voucher.text(convert(-price));
                inputCoupon.val("");
                total();
            } else {
                showNotice(notice, "Mã Không Hợp Lệ");
            }
        }
    }

    function showNotice(notice, text) {
        notice.text(text);
        notice.parent().parent().addClass("active");
        setTimeout(function () {
            notice.parent().parent().removeClass("active");
        }, 1000);
    }

    $(".off").click(function (event) {
        event.preventDefault();
        formDelivery.hide();
        overlay.removeClass("active");
    });
    buttonTotal.click(function () {
        formDelivery.show();
        overlay.addClass("active");
    });

    const qrDiv = $(".qr");
    $(".transfer-input").change(function () {
        qrDiv.css("display", "block");
    });

    $(".receive-input").change(function () {
        qrDiv.css("display", "none");
    });

    const quantityCart = $(".quantity__cart");
    const cartContainer = $(".cart");

    const backCart_button = $(".button__back");

    quantityCart.click(() => {
        cartContainer.addClass("active");
        overlay.addClass("active");
    });

    function hideCart() {
        cartContainer.removeClass("active");
        overlay.removeClass("active");
        formDelivery.hide()
    }

    overlay.click(hideCart);  
  
    backCart_button.click(hideCart);

    const infor_icon = $(".infor_account .account");
    const option_account = $(".option_account");

    infor_icon.click(function () {
        option_account.toggleClass("active");
    });

  
});
