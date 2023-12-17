@extends('layouts.layout1') 
@section('title', "Cart")  
@section('css')
<link rel="stylesheet" href="css/navfoot.css">
<link rel="stylesheet" href="css/cart.css">
<link rel="stylesheet" href="/css/grid.css">

@endsection
@section('js')
<script src="https://kit.fontawesome.com/7a3de78148.js" crossorigin="anonymous"></script>
{{-- <script src="js/navfoot.js" defer></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/cart.js" defer></script>
@endsection   


@section('content')
<div class="intro">
  <img
    src="https://s1.1zoom.me/b6152/819/Pizza_Tomatoes_547600_1920x1080.jpg"
    alt=""
  />
  <p class="intro_text">
    <span class="text_title">Cart</span>
    <span class="text_sub"
      >Thanh Toán <br /><span class="special_text">Nhanh Chóng</span></span
    >
  </p>
</div>

  <div class="shopping-cart">
      <!-- Title -->
      @if($errors->any())
      <div class="alert_again">
        <i class="fa-regular fa-circle-xmark alert"></i>
        <div>
          THÔNG TIN SAI,
          <br> Vui Lòng Nhập Lại  
        </div></div>
     @endif
      <!-- Product #1 -->
     
      @foreach($products as $index=>$product)
     
      <div class="item">
     
        <div class="item_detail">
        <div class="image">
          <img src="{{$product->options->hinhanh}}" alt="" />
        </div>
        <div class="description">
          <span class="name_text">{{$product->name}}</span>
          <span class="subName_text">White</span>
        </div>
      </div>
     <form>
        @csrf
        <div class="quantity display_flex">
          <p class="quantity_button down"><i class="fa-solid fa-minus"></i></p>
          <input type="hidden" name="id_row" value="{{$product->rowId}}">
          <input type="number" name="name" class="number_input" value="{{$product->qty}}" min="1" max="{{$product->max}}"
           data-id-row="{{$product->rowId}}">
            <p class="quantity_button up"><i class="fa-solid fa-plus"></i></p>
        </div>
      </form>
        <div class="total-price">{{number_format( $product->price*$product->qty)}}đ</div>
      
        <div class="like_delete">
          <span class="button_like"><i class="fa-solid fa-heart"></i></span>
          
            <a href="{{route('deleteProduct',$product->rowId)}}"><span class="button_delete"><i class="fa-sharp fa-solid fa-trash"></i></span></a>
          
        </div>

      </div> 
   
@endforeach
      
    </div>
    
    <div class="shopping-pay display_flex ">
      <div class="arrow">
        <i class="fa-solid fa-circle-chevron-right"></i>
      </div>
      <div class="coupon">
       
        <p class="coupon_title shopping_title">
          COUPON
        </p>
        
          
      <div class="coupon_text">
        
          
        <p>Enter your coupon code if you have one</p>
        <form >
         
        <div class="coupon-input_button">
          <input type="text"placeholder="Enter here" spellcheck="false">
          <button class="coupon_button" name="button">CHECK</button>
          @csrf
        </div>
      </form>
      
      </div>
 
  
    </div>

      <div class="cart_total">
        <p class="shopping_title">THANH TOÁN</p>
        <div class="on_total">
          <div class="sub_total">
            <span >Tổng tiền</span>
            <span class="sub_total_item">{{Cart::subtotal()}}đ</span>
            <input value="{{Cart::subtotal()}}" type="hidden" class="subTotal_value">
          </div>
          <div class="coupon_total">
            <span >Voucher</span>
            <span class="coupon_total_item">0đ</span>
          </div>
          <div class="ship">
            <span>Phí Ship</span>
            <span class="ship_item">Free</span>
          </div>
        </div>
        <div class="under_total">
          <div class="total">
          <span>Tổng tiền cần thanh toán</span>
          <span class="total_item">{{Cart::total()}}đ</span>
        </div>
          <p><button>THANH TOÁN NGAY</button>
            
          </p>
        </div>
      </div>
    </div>
 

    
    <div class="notice">
      <div class="notice_text">
        <i class="fa-solid fa-circle-xmark"></i>
        <span >Thêm sản phẩm thành công</span>
      </div>
  </div>
  
<form action="{{route('processOder')}}" method="POST">
  @csrf
  <div class="delivery">
    <input type="hidden" name="coupon" class="coupon-input-hidden" value="0">
    <input type="hidden" name="coupon_turn" class="id-input-hidden" value="0">
    <p class="mb-3 delivery_check_title">Thông Tin Giao Hàng</p>
    <p class="title_d">Địa Chỉ :</p>
    <input class="mb-3 delivery_text" type="text" name="address" value="{{old('address') ?? $user->address}}">
    @error('address')
        <p class="alert-danger">{{$message}}</p>
    @enderror
    <p class="title_d">Số Điện Thoại</p>
    <input class="mb-3 delivery_text" type="text" name="phone" value="{{old('phone') ?? $user->phone}}">
    @error('phone')
    <div class="alert-danger">{{$message}}</div>
@enderror
    <p class="mb-3">Vui lòng chọn hình thức thanh toán</p>
    <div class="mb-3">    
        <input type="radio" name="payment" value="transfer" id="transfer-input" class="transfer-input delivery_radio">
        <label for="transfer-input">Chuyển Khoản Online</label>
        <div class="qr">
            <img src="\images\qrbi.png" alt="">
        </div>
    </div>

    <div class="mb-3">    
        <input type="radio" name="payment" value="receive" id="receive-input" class="receive-input delivery_radio" checked="checked"> 
        <label for="receive-input">Thanh Toán Khi Nhận Hàng </label> 
    </div>
   <button type="submit" class="submit-btn">Hoàn Thành Thông Tin</button>
    <button class="off">
        <i class="fa-solid fa-xmark"></i>
    </button>
</div>
</form>

  
    <div class="overlay"></div>

    {{-- <div class="notice_sucess">
      <div class="notice_sucess_text">
        <i class="fa-solid fa-truck"></i>
        <span >Thanh Toán Thành Công,<br>Chờ chúng tôi, Cảm ơn bạn</span>
      </div>
      <div class="back_home">
        <a href="index.html">Quay Lại Trang Chinh</a>
      </div>
  </div> --}}
</div></div>
  <div class="loader"></div>
     
@endsection