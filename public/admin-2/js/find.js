
$(document).ready(function () {
    $("input.form-control").on("input", function() {
        var inputValue = $(this).val().toLowerCase();
        
        // Lặp qua từng hàng của bảng
        $(".body tr").each(function() {
            var rowText = $(this).text().toLowerCase();
            
            // Hiển thị hoặc ẩn dựa trên sự khớp với giá trị nhập vào
            $(this).toggle(rowText.indexOf(inputValue) > -1);
        });
    });
});