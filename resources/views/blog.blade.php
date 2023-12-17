@extends('layouts.layout1') 
@section('title', "Blog")  
@section('css')
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&family=Roboto:ital,wght@0,300;1,100&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/navfoot.css">
<link rel="stylesheet" href="css/blog.css">
<link rel="stylesheet" href="css/grid.css">
@endsection
@section('js')
<script src="https://kit.fontawesome.com/7a3de78148.js" crossorigin="anonymous"></script>
<script src="js/navfoot.js" defer></script>
@endsection   
     
@section('content')
<div class="test_ani">
  <div class="intro">
      <img src="https://images6.alphacoders.com/912/912620.jpg" alt="">
      <p class="intro_text">
          <span class="text_title">BLOG</span><br>
          <span class="text_sub">Nơi ước mơ được <br> GIAO LƯU và CHIA SẺ</span>
      </p>
  </div>
  <div class="intro_sub">
      <p class="intro_sub_item1">Chuyện Nhà</p>
      <p class="intro_sub_item2">Nơi bên lề, những lời tâm sự và chia sẻ của nghề  <br> Hãy lắng nghe, cảm nhận, đồng hành cùng chúng tôi</p>

  </div>

  <div class="find-topic_button display_flex">
      <p>#BLOG</p>
      <p>#KhoiNghiep</p>
      <p>#TatCa</p>
  </div>
  <div class="target_container">
      <div class="target_container grid wide">
          
          <p class="target_title title animation_item animate_item-left ">Chia Sẻ <span>Kinh Nghiệm</span> </p>
          
          <div class="target row">
              <div class="target_item item1 col l-4 m-6 c-12 animation_item animate_item-left">
                  <div class="item_img item1">
                      <img src="images\blog\pv3.jpg" alt="">
                  </div>
                  <div class="item_text item1">
                      <p class="item_text_title">Hành <span>Trình</span></p>
                      <p class="text">Chia sẻ về bước đi của doanh nghiệp trong thời đại mới.Những trang bị, hành trang,...</p>
                  </div>
              </div>
  
              <div class="target_item item2  col l-4 m-6 c-12 animation_item animate_item-top">
                  <div class="item_img item1">
                      <img src="images\blog\pv1.jpg" alt="">
                  </div>
                  <div class="item_text item1 ">
                      <p class="item_text_title">Sáng <span>Tạo</span></p>
                      <p class="text">Những phương pháp để khởi nghiệp sáng tạo, là kinh nghiệm của những nhà lãnh đạo,...</p>
                  </div>
              </div>
  
              <div class="target_item item3   col l-4 m-6 c-12 animation_item animate_item-right">
                  <div class="item_img item1">
                      <img src="images\blog\pv2.jpg" alt="">
                  </div>
                  <div class="item_text item1">
                      <p class="item_text_title">Tìm <span>Tòi</span></p>
                      <p class="text">Những hiểu biết về sự đam mê, tìm tòi tạo nên giá trị cho bản thân, mở rộng cơ hội,...</p>
                  </div>
              </div>
          </div>
  
         
          </div>
      </div>




  
  <div class="blog_item2">
      <p class="title_blog thanhDoc">
          BLOG
      </p>
  <div class="blog_item2_body">
      <div class="post_item">
        <img class="larger" src="images\blog\blog (3).jpg" alt="">
        <div class="item-text main  display_flex d-column">
          <p class="item_date">November 16</p>
          <p class="item_title">Khác Biệt Tạo Nên Chất Lượng</p>
          <p class="item_description">Sự khác biệt và độc đáo trong sản phẩm, dịch vụ hoặc cách thức hoạt động của một doanh nghiệp là yếu tố quan trọng để tạo ra chất lượng</p>
        </div> </div>

        <div class="post_item">
          <img src="images\blog\blog (2).jpg" alt="">
          <div class="item-text side display_flex d-column">
            <p class="item_date">November 16</p>
            <p class="item_title">Hiện Đại Hay Truyền Thống</p>
            <p class="item_description">Lựa chọn phong cách phù hợp sẽ là một cơ hội mở ra cho bạn cho chính hiện tại.</p>
          </div>
      </div>
          <div class="post_item">
              <img src="images\blog\blog (1).jpg" alt="">
              <div class="item-text side display_flex d-column">
                <p class="item_date">June 12</p>
                <p class="item_title">Hương Vị Bằng Mắt</p>
                <p class="item_description">Ngon là 4, và đẹp là 6, thay đổi tạo nên sự đổi mới </p>
              </div>
          </div>
              <div class="post_item">
                  <img src="images\blog\blog (1).png" alt="">
                  <div class="item-text side display_flex d-column">
                    <p class="item_date">December 15</p>
                    <p class="item_title">Khó khăn trong tìm kiếm</p>
                    <p class="item_description">Bản thân mở rộng hiểu biết, trải nghiệm, nâng cao ..</p>
                  </div>
              </div>
    </div>
  </div>

    
  <div class="gmail_blog display_flex d-column ">
      <div class="gmail_text display_flex d-column animation_item animate_item-left">
          <span>Lắng Nghe</span>
          <span>Câu Chuyện</span>
          <span>Của Bạn</span>
      </div>
      <div class="gmail_input  display_flex animation_item animate_item-top">
          <input type="text" class="gmail_imput" placeholder="example@gmail.com">
          <p class="gmail_button">Liên hệ</p>
      </div>
  </div>
  <div class="blog_item3">
      <p class="title_blog thanhDoc">
          Khởi Nghiệp
      </p>
      <div class="blog_item3_body">
         
          <div class="post_item3">
            <img class="larger" src="images\blog\kn1.jpg" alt="">
            <div class="item-text main  display_flex d-column">
              <p class="item_date">May 19</p>
              <p class="item_title">Khó Khăn Tìm Kiếm Đầu Tư?</p>
              <p class="item_description">Lượng vốn cần thiết cho một doanh nghiệp phát triển là thiết yếu, một trong những cách phổ biến nhằm đủ nguồn lực </p>
            </div> </div>
            <div class="post_item3">
              <img src="images\blog\kn2.png" alt="">
              <div class="item-text side display_flex d-column">
                <p class="item_date">May 23</p>
                <p class="item_title">Dễ hay Khó?</p>
                <p class="item_description">Tầm nhìn của doanh nghiệp là mũi tên của sự phát triển .</p>
              </div>
          </div>
              <div class="post_item3">
                  <img src="images\blog\kn1.png" alt="">
                  <div class="item-text side display_flex d-column">
                    <p class="item_date">March 12</p>
                    <p class="item_title">Đồng minh</p>
                    <p class="item_description">Đồng đội hỗ trợ sẽ góp 50% sức mạnh vào sức phát triển, có thể giảm thời gian, chi phí, cũng như tăng tính sáng tạo,..  </p>
                  </div>
              </div>
                  <div class="post_item3">
                      <img src="images\blog\kn4.png" alt="">
                      <div class="item-text side display_flex d-column">
                        <p class="item_date">November 03</p>
                        <p class="item_title">Tầm Nhìn</p>
                        <p class="item_description">Sự lựa chọn hiện tại phải đảm bảo cho sự phát triển trong tương lai, đảm bảo sự phát triển bền vững,dài hạn.</p>
                      </div>
                  </div>
        </div>
  </div>
</div>
<div class="blog_item1 ">

      <div class="blog_item1_grid grid wide ">
          <div class="row">
          <div class="item1_img col l-6 m-12 c-12">
              <img class="img-fit" src="images\blog\blog3.png" alt="">
          </div>
          <div class="item1_text col l-6 m-12 c-12">
              <!-- <p class="title">HI</p> -->
              <p class="item1_text_sub">
                  <p class="sub1">
                      HAYPR Minimal
                  </p>
                  <p  class="sub2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla alias ea delectus ad eius? Facilis, eveniet?</p>
                      <p  class="sub3">SPECS</p>
                      <p  class="sub4">
                          Case 41mm
                          <br>Saphia Lorem, ipsum dolor.
                      </p>
                      <button  class="sub5">BUY NOW</button>
                  </p>
                  
          </div>
      </div>
      </div>
  </div>
  <div class="overlay"></div>
@endsection