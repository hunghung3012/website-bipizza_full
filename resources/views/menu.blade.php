@extends('layouts.layout1') 
@section('title', "Menu")  
@section('css')
<link rel="stylesheet" href="css/menu.css" />
<link rel="stylesheet" href="css/navfoot.css" />
<link rel="stylesheet" href="css/grid.css" />
@section('js')
<script src="https://kit.fontawesome.com/7a3de78148.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- <script src="js/menu.js" defer></script> --}}


@endsection   
@if(session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
@section('content')
<div class="intro ">
  <img
    src="https://s1.1zoom.me/b6152/819/Pizza_Tomatoes_547600_1920x1080.jpg"
    alt=""
  />
  <p class="intro_text">
    <span class="text_title">Menu</span>
    <span class="text_sub"
      >Lựa Chọn Món Ăn <br /><span class="special_text">TUYỆT</span> Cú
      Mèo</span
    >
  </p>
</div>
<div class="menu_container">
  <div class="find">
    <input type="text" class="find_input active" placeholder="Nhập từ khóa">
    <button class="find_input_submit"><i class="fa-solid fa-magnifying-glass"></i></button>
 
  </div>
  <div class="select_type">
    <div class="select_button "> <i class="active fa-solid fa-bars"></i> </div>
    <div class="select_board">
      <ul class="select_board_list display_flex d-column">
        <li class="m-item active ">Tất cả</li>
        <li class="m-item">Combo</li>
        <li class="m-item">Pizza</li>
        <li class="m-item">Nước uống</li>
        <li class="m-item">Thức ăn khác</li>
      </ul>
    </div>
  </div>
  <div class="menu_wrapper">
    <div class="grid wide">
      <div class="row">
        <div class="sidebar col l-3 m-2 c-0 ">
          <p class="filter_text"> <i class="fa-solid fa-filter"></i> Bộ Lọc Tìm Kiếm</p>
     <div class="sidebar_item_container">
           <ul class="sidebar_item">
            <p>Theo Danh Mục</p>
            @foreach($categorys as $category)
            <li><input type="checkbox" class="form-group category" id="category_{{$category->tag}}" value="{{$category->id}}">
              <label for="category_{{$category->tag}}"> {{$category->tendanhmuc}}</label>
            </li>
            @endforeach
          </div>
          </ul>
          <hr style="width:60%">
          <div class="price_condition_container">
          <p class="price_condition_text">Khoảng Giá</p>
          <div class="price_condition">
          
            <input type="text" class="price_from" placeholder="₫ TỪ">
            <span>-</span>
            <input type="text" class="price_to" placeholder="₫ ĐẾN">
          </div>
          <div class="price_condition_submit"><button>Xác Nhận</button></div>
        </div>
         
           

         
        </div>
         
            
        <div class="col l-9 m-10 c-12 list_pizza_container ">
            <!-- DANH SACH THUC PHAM -->
       
            <!-- Danh SACH Pizza -->
        <div class="list_pizza  active">
            <p class="thanhDoc">Danh Sách Sản Phẩm</p>
              <div class="list_pizza_row row ">
                {{--  --}}
                @foreach ($data as $key=>$item)
                    
                
               <a href="{{route('detail_product',$item->id)}}" class="menu_item col l-4 m-6 c-12">
                  <div class="item_pizza">
                    <div class="item_pizza_img">
                      <img src="{{$item->hinhanh}}" alt="" />
                    </div>
                    <div class="item_pizza_text display_flex">
                        <div class="pizza_costname">
                         <p class="pizza_cost_name">{{$item->tensanpham}}</p>
                      <p class="pizza_cost_text">{{number_format($item->gia) }}đ</p>
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
                </a> 
                @endforeach
                {{--  --}}
              </div>
        </div>

       


        
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="infor_product_container"> -->


  </div>
  <div class="overlay"></div>

  <div class="notice">
    <div class="notice_text">
      <i class="fa-regular fa-circle-check"></i>
      <span >Thêm sản phẩm thành công</span>
    </div>
    <div class="go_to_cart">
      <a href="cart.html">Xem giỏ hàng</a>
    </div>

</div>

<script src="/js/menu-ajax.js"></script>
<script src="/js/chatbox-ajax.js"></script>
@endsection  