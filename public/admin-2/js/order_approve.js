$(document).ready(function() {

    $(".cancel-button").click(function() {
        $(".cancel_question").show();
        $(".cancel_noneDetail").val($(this).val())
    });
    $(".cancel_question .remove").click(function() {
        $(".cancel_question").hide();
    });
    $(".cancel_detail").click(function() {
        $(".cancel_text").show();
        $(".cancel_question").hide();
        $(".id-hidden").val($(".cancel_noneDetail").val());
    });
    $(".cancel_text .back").click(function() {
        $(".cancel_text").hide();
        $(".cancel_question").show();
    });



    $(".btn-approve").click(function() {

        var buttonValue = $(this).val();
        var url = "http://127.0.0.1:8000/api/order/approve/"+buttonValue;
        let orderStatusTd = $(this).closest("tr").find(".order-status");
        var notice = $('.notice');
        console.log(url);
        $.ajax({
            type: "GET",
             url: "http://127.0.0.1:8000/api/order/approve/"+buttonValue,
            success: function (response) {
                orderStatusTd.text("Chuẩn Bị");
                $(".notice_text span").text("Duyệt Thành Công");
                notice.addClass('active');
                setTimeout(function() {
                    notice.removeClass('active');
                }, 500); 
               
            }
        });
    })

    $(".cancel_noneDetail").click(function() {
        var notice = $('.notice');
        var orderStatusTd = $("td:contains('"+$(this).val()+"')").closest("tr").find(".order-status");
        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/api/order/cancel/",
           
            data:{'id':$(this).val()},
            success: function (response) {
                $(".cancel_question").hide();
                orderStatusTd.text("Đã Hủy");
                $(".notice_text span").text("Hủy Thành Công"); 
                notice.addClass('active');
                setTimeout(function() {
                    notice.removeClass('active');
                }, 500); 

               
            }
        });
    })

    $('.cancel_text .submit').click(function() {
        var notice = $('.notice');
        let id =  $('.id-hidden').val();
        var orderStatusTd = $("td:contains('" + id + "')").closest("tr").find(".order-status");

        
       var content  = editor.getData();;
     
       $(".cancel_text").hide();
       orderStatusTd.text("Đã Hủy");
       $(".notice_text span").text("Hủy Thành Công");
       notice.addClass('active');
       setTimeout(function() {
           notice.removeClass('active');
       }, 500); 
        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/api/order/cancelWithEmail/",
            data: {'content' : content ,'id':id},
            
            success: function (response) {
            }
        });
    })



    
   
    

     


})





