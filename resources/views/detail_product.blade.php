@extends('layouts.layout1') 
@section('title', "Cart")  
@section('css')
<link rel="stylesheet" href="/css/navfoot.css">
<link rel="stylesheet" href="/css/grid.css">
<link rel="stylesheet" href="/css/detail_product.css">
<link rel="stylesheet" href="/css/menu.css">
@endsection
@section('js')
<script src="https://kit.fontawesome.com/7a3de78148.js" crossorigin="anonymous"></script>
<script src="/js/navfoot.js" defer></script>
@endsection   

<div class="overlay"></div>
@section('content')
<div class="intro ">
  <img
    src="https://s1.1zoom.me/b6152/819/Pizza_Tomatoes_547600_1920x1080.jpg"
    alt=""
  />
  <p class="intro_text">
    <span class="text_title"> {{$data->id}}</span>
    <span class="text_sub"
      >Lựa Chọn Món Ăn <br /><span class="special_text">TUYỆT</span> Cú
      Mèo</span
    >
  </p>
</div>     

<form action="{{route('addCart')}}" method="POST">
 
  <div class="infor_product_container">
      <input type="hidden" name="id" value="{{$data->id}}">
        <div class="infor_product_img  ">
          <img src="{{$data->hinhanh}}" alt="">
        </div>
        <div class="infor_product_text ">
          <div class="name_title">{{$data->tensanpham}}</div>
          <div class="subname_title sub_text">{{$data->tendanhmuc}}</div>
          <div class="note sub_text">
            <div class="note_title">Ghi chú:</div>
            <textarea name="detail" id="" >Không</textarea>
          </div>
          <div class="addCart">
          <p class="quantity_title sub_text">Số Lượng Khẩu Phần</p>
          <div class="quality_price display_flex">
              <div class="quantity display_flex">
                <p class="quantity_button down"><i class="fa-solid fa-minus"></i></p>
                <input type="number" name="quantity" value="1" min="1" max="{{$max}}">
                <p class="quantity_button up"><i class="fa-solid fa-plus"></i></p>
              </div>
              <p class="price">{{number_format($data->gia,0,",",".")}}đ</p>
          </div>
          @if($data->soluong>0) 
          <div class="addCart_button">
            
            <button type="submit">THÊM VÀO GIỎ HÀNG</button>

          
          </div>
          @else
          <div class="alert alert-danger">Hết Hàng</div>
          @endif
          <div class="detail_product sub_text">
            <p>Mô tả: {!!$data->mota!!}</p>
          </div>
        </div>
      
      </div>
    </div>
    @csrf
  </form>
<p class="text_choose">Lựa chọn thêm cho hôm nay</p>
  <div class="suggest_container">
    

    
{{--  --}}
@foreach($suggests as $id=>$suggest)
    <a href="{{route('detail_product',$suggest->id)}}" class="suggest_item">
      <div class="suggest_item_img">
        <img src="{{$suggest->hinhanh}}" alt="">
      </div>
      <div class="suggest_item_name">
        {{$suggest->tensanpham}}
      </div>
      <div class="suggest_item_price">
        {{number_format($suggest->gia)}}
      </div>
    </a>
    
@endforeach

    

</div>
<p class="text_choose">Bình Luận</p>
<form action="{{route('addComment')}}" method="POST">
  @csrf
<div class="comment_container">
  <input type="hidden" name="id" value="{{$data->id}}">
  @foreach($comments as $comment) 
  @if( $comment->idsanpham == $data->id)
  <div class="comment_item">
    <div class="avatar_name">
      <div><img src="/images/dog.avif" alt=""></div>
      <div><span class="text fw-bold">{{$comment->nameOfUser}}</span></div>
    </div>
    <div class="comment_content">
      {{$comment->noidung}}
    </div>
    
  </div>
  @endif
  @endforeach
  <p>Bình Luận Của Bạn</p>
  <div class="comment">
    <textarea name="comment_content" id="" cols="30" rows="5"></textarea>
  </div>
  <button class="comment_submit" type="submit">Xác Nhận</button>

</div>
</form>
@endsection 
 



     