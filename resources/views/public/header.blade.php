
@php
    $products = Cart::content();
@endphp
<div class="wrapper">
  <div id="header">
    <div class="more_menu">
      <i class="fa-solid fa-bars bar_mobile_icon"></i>
      <div class="select_nav_mobile">
        <span class="remove"><i class="fa-solid fa-xmark"></i></span>
        <a href="{{ route('renderHome') }}"><p>Home</p></a>
        <a  href="{{ route('renderMenu') }}"><p>Menu</p></a>
        <a  href="{{ route('blog') }}"><p>Blog</p></a>
        <a  href="#"><p>Store</p></a>
        <a  href="{{ route('aboutus') }}"><p>About us</p></a>
      
      </div>
    </div>
    <a href="{{ route('renderHome') }}" class="header_logo">
      <i class="fa-solid fa-pizza-slice icon_logo"></i>
      <span>PIZZA</span>
    </a>

    <ul class="main_menu">
      <li class="menu_item item-home ">
        <a data-menu-item="item1"  href="{{ route('renderHome') }}" >Home</a>
      </li>
      <li class="menu_item  item-menu">
        <a data-menu-item="item2"  href="{{ route('renderMenu') }}">Menu</a>
      </li>
      <li class="menu_item">
        <a data-menu-item="item3"  href="{{ route('blog') }}">Blog</a>
      </li>
      <li class="menu_item"><a href="#">Store</a></li>
      <li class="menu_item"><a data-menu-item="item4"  href="{{ route('aboutus') }}">About us</a></li>
    </ul>
    <div class="infor_account logo_cart">
      @if(Auth::check()) 
      <div class="quantity__cart">
        <i class="fa-solid fa-cart-shopping"></i>
        <p class="quantity__cart-infor">{{count( $products)}}</p>
      </div>
      
     
      <div class="account">
        <div class="option_account">
          <a href="{{route('renderOrder')}}" >
            <p>Đơn Hàng</p></a>
          <a href="{{route('logout')}}">
            <p>Đăng Xuất</p></a>
        </div>
      </div>
      @else
      
      <a class="login_button" href="{{route('pageLogin')}}">Đăng Nhập</a>
        
      
      </div>
          
      @endif
    </div>
  </div>

  <div class="cart">
    <div class="cart__header">
      <div class="button__back">
        <i class="fa-solid fa-arrow-left"></i>
      </div>

      <div class="cart__title">Giỏ hàng</div>

      <div class="cart__quanlity">
        SL : <span class="quanlity">{{Cart::count()}}</span>
      </div>
    </div>

    <div class="cart_body">
      <div class="list__cart">
        @foreach($products as $index=>$product)
        {{-- Item --}}
        <div class="item__cart">
          <div class="item__cart-content">
            <div class="item__cart-img">
                <img src="{{$product->options->hinhanh}}" alt="">
            </div>
            <div class="item__cart-info">
                <div class="cart__info-name">{{$product->name}}</div>
                <div class="cart__info-subname">Food</div>
                <div class="cart__info-price">{{number_format( $product->price*$product->qty)}}đ</div>
            </div>
        </div>
        <div class="setting__quantily">
            <div class="setting__quantily-btn">
                <div class="number__quantily">x{{$product->qty}}</div>
            </div>

            <div class="setting__quantily-remove">
              <a href="{{route('deleteProduct',$product->rowId)}}">
                <button class="btn__remove">
                    <i class="fa-solid fa-trash"></i>
                </button>
              </a>
            </div>
        </div>
</div>
@endforeach
        {{--  --}}
      </div>
    </div>
    <div class="cart__footer">
      <div class="cart__total">
        <span class="cart__total-title"> Tổng tiền :</span>

        <span class="cart__total-content">  {{Cart::subtotal()}} VNĐ </span>
      </div>

      <a href="{{ route('renderCart') }}"
        ><button class="button__buy">Xem chi tiết giỏ hàng</button></a
      >
    </div>
  </div>
</div>
  <!-- Menu and cart END -->