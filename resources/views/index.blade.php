@extends('layouts.layout1') 
@section('title', "Bi Pizza")  
@section('css')
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&family=Roboto:ital,wght@0,300;1,100&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/navfoot.css" />
<link rel="stylesheet" href="css/grid.css" />
@endsection
@section('js')
<script src="https://kit.fontawesome.com/7a3de78148.js" crossorigin="anonymous"></script>

<script src="js/index.js" defer></script>

@endsection   
<div class="loader"></div>
<div class="all_container">


@section('content')

<div class="slider">
  <div class="slider_text_container l-8">
    <p class="slider_text_first">Bi's Pizza Paradise</p>
    <p class="slider_text_second">
      Hãy đến và Trải nghiệm cùng nhau với thiên đường Pizza. 
    </p>
  </div>

  <div class="list">
    <div class="item">
      <video src="video\video_1.mp4" autoplay muted loop></video>
    </div>
    <div class="item">
      <video src="video\video_2.mp4" autoplay muted loop></video>
    </div>
    <div class="item">
      <video src="video\video_3.mp4" autoplay muted loop></video>
    </div>
    <div class="item">
      <video src="video\video_1.mp4" autoplay muted loop></video>
    </div>
    <div class="item">
      <video src="video\video_2.mp4" autoplay muted loop></video>
    </div>
  </div>
  <div class="buttons">
    <button id="prev"><</button>
    <button id="next">></button>
  </div>
  <ul class="dots">
    <li class="active"></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
  </ul>
</div>

<div class="intro_product">
  <div class="grid wide">
    <div class="row">
      <div class="col l-5 m-12 c-12 animation_item animate_item-left">
        <div class="intro_img">
          <img src="images\index\slide.jpg" alt="" />
          <button class="button">Tìm Hiểu Ngay</button>
        </div>
      </div>
      <div class="col l-7 m-12 c-12 animation_item animate_item-right">
      <!-- List -->
      <div class="intro_menu row"> 
        @foreach($rand_data as $index=>$item) 
         
      <a href="{{route('detail_product',$item->id)}}"
       class="menu_item col l-4 m-6 c-12"
       target="_self">
            <div class="item_pizza">
              <div class="item_pizza_img">
                <img src="{{$item->hinhanh}}" alt="" />
              </div>
              <div class="item_pizza_text display_flex">
                <div class="pizza_costname">
                  <p class="pizza_cost_name">
                  <span>{{$item->fisrt}}</span>
                  {{$item->name}}
                    
                  </p>
                  <p class="pizza_cost_text">
                    <?php echo number_format($item->gia,0,",",".")."đ"?>
                  </p>
                </div>
                <div class="pizza_heart_icon">
                  <i class="fa-solid fa-heart"></i>
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
          </a>
          @endforeach
          <div class="menu_item col l-4 m-6 c-12">
                <div class="item_pizza item_pizza_sp">
                  <div class="img_item_pizza_sp">
                    <img src="/images/menu2.jpg" alt="">
                  </div>
                <p class="text_item_pizza_sp"><a href="menu.php">Xem thêm</a></p>
                </div>
        </div>`;
        </div>

        <!-- End -->
      </div>
    </div>
  </div>
</div>
<!-- <div class="menu_item col l-4 m-6 c-12">
                <div class="item_pizza item_pizza_sp">
                  <div class="img_item_pizza_sp">
                    <img src="images\menu\menu2.jpg" alt="">
                  </div>
                <p class="text_item_pizza_sp"><a href="">Xem thêm</a></p>
                </div>
              </div> -->

<div class="slider_second">
  <div class="grid wide">
    <div class="row">
      <div class="col l-6 m-12 c-12 animation_item animate_item-left">
        <div class="slider_second_title display_flex d-column">
          <p class="first_text">ĐẾN TỪ SỰ CHẤT LƯỢNG</p>
          <p class="second_text">
            <span class="hightlight_text">PIZZA</span> NGON NHẤT<br />TẠI
            ĐÂY!
          </p>
          <p class="text_">
            Bạn có biết không? Một miếng pizza không chỉ đơn giản là một
            món ăn mà nó còn là một trải nghiệm tuyệt vời đấy! Khi bạn
            cắn vào miếng pizza ấy, một thế giới vị ngon mở ra trước mắt
            bạn.
          </p>
          <div class="slider_second_button display_flex">
            <p class="button_1">ORDER NOW</p>
            <p class="button_2">
              SEE THE MENU
              <i class="fa-solid fa-angle-right"></i>
            </p>
          </div>
        </div>
      </div>
      <div class="col l-6 m-0 c-0">
        <div class="images_container animation_item animate_item-top">
          <div class="images">
            <div class="item" style="--i: 1">
              <img src="images\menu\pizza\pizza (9).png" />
            </div>
            <div class="item" style="--i: 2">
              <img src="images\menu\pizza\pizza (5).png" />
            </div>
            <div class="item" style="--i: 3">
              <img src="images\menu\pizza\pizza (6).png" />
            </div>
            <div class="item" style="--i: 4">
              <img src="images\menu\pizza\pizza (7).png" />
            </div>
            <div class="item" style="--i: 5">
              <img src="images\menu\pizza\pizza (8).png" />
            </div>
            <div class="item" style="--i: 6">
              <img src="images\menu\pizza\pizza (10).png" />
            </div>
          </div>
        </div>
        <button
          class="animation_item animate_item-right"
          id="slider_second_prev"
        >
          <i class="fa-solid fa-caret-left"></i>
        </button>
        <button
          class="animation_item animate_item-left"
          id="slider_second_next"
        >
          <i class="fa-solid fa-caret-right"></i>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- <div class="banner_container display_flex">
<div class="banner display_flex">
    <div class="banner_img">
        <img class="banner_img_item" src="images\banner_img.png" alt="">
    </div>
    <div class="banner_infor display_flex">
        <p class="banner_infor_title title">PIZZA <span>NGON TUYỆT HẢO</span></p>
        <p class="banner_infor_text text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Recusandae, sed! Minus, at laudantium doloremque voluptates eum voluptate laborum magnam porro et debitis temporibus maxime soluta perferendis modi ut ducimus maiores error. Dolore debitis laborum incidunt tempora architecto laboriosam non neque?</p>
        <button class="banner_infor_button" >Tìm hiểu ngay</button>
    </div>
</div>
</div> -->
<div class="banner_container">
  <div class="grid wide">
    <div class="banner row">
      <div
        class="banner_img col l-6 m-12 c-12 animation_item animate_item-left"
      >
        <img
          class="banner_img_item"
          src="images\banner_img1.png"
          alt=""
        />
      </div>
      <div
        class="banner_infor col l-6 m-12 c-12 animation_item animate_item-top"
      >
        <p class="banner_infor_title">
          NHANH TAY <br />
          VỚI <span class="specical_banner">ƯU ĐÃI </span>KHỦNG
        </p>
        <p class="banner_infor_title_second">
          Lựa chọn những ưu đãi <span>cực giá trị</span>
        </p>
        <p class="banner_infor_text">
          Pizza là một món ăn ngon tuyệt hảo mà không ai có thể cưỡng
          lại. Với những lớp bột mỏng và giòn, được phủ đầy ắp những
          nguyên liệu đa dạng và hương vị tuyệt vời, pizza là sự kết hợp
          hoàn hảo giữa các thành phần tạo nên một trải nghiệm ẩm thực
          đáng nhớ.
        </p>
        <button class="banner_infor_button">Tìm hiểu ngay</button>
      </div>
    </div>
  </div>
</div>

<div class="advantage">
  <div class="grid wide">
    <div class="advantage_title animation_item animate_item-top">
      <p>TẠI SAO CHỌN <span>CHÚNG TÔI</span></p>
    </div>
    <div class="advantage_item item1 row">
      <div
        class="item_images item1_images l-6 m-12 c-12 col animation_item animate_item-left"
      >
        <img
          src="https://aloride.com/wp-content/uploads/2022/03/1643110928.jpeg"
          alt=""
        />
      </div>
      <div
        class="item_text item1_text text l-6 m-12 c-12 col animation_item animate_item-right"
      >
        <p class="title">NHANH CHÓNG</p>
        <p class="detail_text">
          Đặt món không tốn nhiều thời gian, nhân viên tiệm pizza sẵn
          sàng ghi lại đơn hàng và mang đến sự thỏa mãn ngay lập tức.Quá
          trình vượt trội, luôn sẵn sàng hết nmmình vì bạn.
        </p>
        <p class="button_contact">LIÊN HỆ NGAY</p>
      </div>
    </div>

    <div class="advantage_item item2 row">
      <div
        class="item_text item1_text text l-6 m-12 c-12 col animation_item animate_item-right"
      >
        <p class="title">SANG TRỌNG</p>
        <p class="detail_text">
          Sự hòa quyện giữa sự sang trọng và gần gũi. Không gian là sự
          kết hợp tinh tế giữa các yếu tố hiện đại và truyền thống, tạo
          nên một không gian đẳng cấp nhưng vẫn mang đậm chất thân
          thiện, ấm cúng.
        </p>
        <p class="button_contact">LIÊN HỆ NGAY</p>
      </div>
      <div
        class="item_images item1_images animation_item animate_item-left l-6 m-12 c-12 col"
      >
        <img
          src="https://design-tribe.com/wp-content/uploads/2019/06/Design-Tribe-Restaurant-Online-Interior-Design-Colorful-Biophilic-Greenery.jpg"
          alt=""
        />
      </div>
    </div>
    <div class="advantage_item item3 row">
      <div
        class="item_images item1_images l-6 m-12 c-12 col animation_item animate_item-top"
      >
        <img src="images\pizza_advantage.jpg" alt="" />
      </div>
      <div
        class="item_text item1_text text l-6 m-12 c-12 col animation_item animate_item-left"
      >
        <p class="title">HIỆN ĐẠI</p>
        <p class="detail_text">
          Chúng tôi luôn đáp ứng các bạn theo những phương pháp hiện đại
          nhất, từ cách phục vụ đến từng món ăn của bạn.Hãy ghé thăm
          chúng tôi.
        </p>
        <p class="button_contact">LIÊN HỆ NGAY</p>
      </div>
    </div>
  </div>
</div>
<div class="target_container">
  <div class="target_container grid wide">
    <p class="target_title title animation_item animate_item-top">
      <span>MỤC TIÊU</span> CỦA CHÚNG TÔI
    </p>

    <div class="target row">
      <div
        class="target_item item1 col l-4 m-6 c-12 animation_item animate_item-top"
      >
        <div class="item_img item1">
          <img src="images\index\muctieu1.jpg" alt="" />
        </div>
        <div class="item_text item1">
          <p class="item_text_title"><span>Ngon </span>Miệng</p>
          <p class="text">
            Thức ăn đảm bảo về cả chất lượng, giúp quý khách sẽ luôn ngon miệng khi được trải nghiệm sản phẩm.
          </p>
        </div>
      </div>

      <div
        class="target_item item2 col l-4 m-6 c-12 animation_item animate_item-top"
      >
        <div class="item_img item1">
          <img src="images\index\muctieu3.png" alt="" />
        </div>
        <div class="item_text item1">
          <p class="item_text_title"><span>Hài</span> Lòng</p>
          <p class="text">
            Khách hàng cảm thấy hài lòng và hạnh phúc sau khi trải nghiệm sản phẩm và dịch vụ của chúng tôi. 
          </p>
        </div>
      </div>

      <div
        class="target_item item3 col l-4 m-6 c-12 animation_item animate_item-top"
      >
        <div class="item_img item1">
          <img src="images\index\muctieu2.jpg" alt="" />
        </div>
        <div class="item_text item1">
          <p class="item_text_title"><span>Uy </span>Tín</p>
          <p class="text">
            Đáp ứng các yêu cầu và mong đợi của khách hàng một cách đáng tin cậy.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- <div class="messages-customer_form display_flex ">
<div class="messages-customer c-5 col display_flex d-column   ">
    <p class="messages-customer_title title">
        THÔNG TIN CỦA BẠN
    </p>
    <div class="messages_input display_flex  d-column">
        <input type="text" class="item item1" placeholder="Họ Và Tên *">
        <input type="text" class="item item2" placeholder="Email của bạn...">
        <textarea class="item item3" placeholder="Lời nhắn của bạn"  ></textarea>
    </div>
    <div class="messages_button">
       <button class="messages_button_item">SEND MESSAGE</button> 
    </div>
</div>
<div class="messages_thanks c-5">
    <p class="message_thanks-title title">
        Ý KIẾN KHÁCH HÀNG
    </p>
    <p class="message_thanks-text text">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, at aliquam enim vel sapiente neque adipisci consequatur architecto modi cupiditate, nulla libero minus nemo iste quidem optio dolor placeat ipsum?
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, at aliquam enim vel sapiente neque adipisci consequatur architecto modi cupiditate, nulla libero minus nemo iste quidem optio dolor placeat ipsum?
    </p>
</div>
</div> -->

<div class="messages-customer_form">
  <div class="grid wide">
    <div class="row">
      <div
        class="messages-customer col l-6 m-12 c-12 animation_item animate_item-left"
      >
        <p class="messages-customer_title title">THÔNG TIN CỦA BẠN</p>
        <div class="messages_input display_flex d-column">
          <input
            type="text"
            class="item item1"
            placeholder="Họ Và Tên *"
          />
          <input
            type="text"
            class="item item2"
            placeholder="Email của bạn..."
          />
          <!-- <input type="text" class="item item3" placeholder="Lời nhắn của bạn"> -->
          <textarea
            class="item item3"
            placeholder="Lời nhắn của bạn"
          ></textarea>
        </div>
        <div class="messages_button">
          <button class="messages_button_item">SEND MESSAGE</button>
        </div>
      </div>
      <div
        class="messages_thanks col l-6 m-12 c-12 animation_item animate_item-right"
      >
        <p class="message_thanks-title title">Ý KIẾN KHÁCH HÀNG</p>
        <p class="message_thanks-text text">
          Mọi vấn đề xin hãy liên lạc cùng chúng tôi.
          Ý Kiến của bạn sẽ là tiềm năng để chúng tôi ngày càng hoàn thiện và phát triển trong tương lai
         

        </p>
      </div>
    </div>
  </div>
</div>

<div class="overlay"></div>
@endsection
