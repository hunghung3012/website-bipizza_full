$(document).ready(function(){
    // Handle the change event on checkboxes with class "category"
    $(".category").change(function(){
      filter();
    });
    $(".price_condition_submit").click(function(){
        filter();
      });
      $(".find_input_submit") .click(function(){
        filter();
      });
      $('.find_input').keydown(function(event){
        if(event.which == 13)
            filter();
      });
    function filter() {
        
        var selectedValues = $(".category:checked").map(function(){
            return $(this).val();
          }).get();
          var findInput = $('.find_input').val();
          var price_from = $(".price_from").val();
          var price_to = $(".price_to").val();
          var price = {"from":price_from,"to":price_to};
    
          // Check if price_to is not empty
          if (price_to !== "") {
              var price = {"from": price_from, "to": price_to};
          } else {
              var price = {"from": price_from};
          }
          if(selectedValues.length == 0 && price_from=="" && price_to=="" && findInput=="") {
            $('.pagination').show();
          }else  $('.pagination').hide();
          $.ajax({
            type: "POST",
             url: "http://127.0.0.1:8000/api/menu/",
             data : JSON.stringify({ selectedValues: selectedValues, price:price,text:findInput }),
            success: function (response) {
               console.log(response.data);
              renderProduct(response,$(".list_pizza_row"));

            }
        });  
    }


    function renderProduct(list, menu) {
        const htmls = [];
        $.each(list, function(index, product) {
            htmls.push(renderListProduct(product, index));
        });
        menu.html(htmls.join(''));
    }
    
    function renderListProduct(product, index) {
        return `
        <a href="http://127.0.0.1:8000/detail_product/${product.id})" class="menu_item col l-4 m-6 c-12">
            <div class="item_pizza">
                <div class="item_pizza_img">
                    <img src="${product.hinhanh}" alt="" />
                </div>
                <div class="item_pizza_text display_flex">
                    <div class="pizza_costname">
                        <p class="pizza_cost_name">${product.tensanpham}</p>
                        <p class="pizza_cost_text">${product.gia}đ</p>
                    </div>
                    <div class="pizza_heart_icon">
                        <i class="fa-regular fa-heart"></i>
                    </div>
                </div>
                <div class="pizza_star-container">
                    <ul class="pizza_star">
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                        <li><i class="fa-solid fa-star"></i></li>
                    </ul>
                </div>
            </div>
        </a>`;
    }












  });

