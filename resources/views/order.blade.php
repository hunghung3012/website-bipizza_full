
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="/css/order.css">
  
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7a3de78148.js" crossorigin="anonymous"></script>
    <script src="js/navfoot.js" defer></script>
    <script src="js/order.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    

   
</head>
<body>
    <div  class="back-home">
        <a class="text-dark" href="{{route('renderHome')}}"><i class="fa-solid fa-backward"></i>  Quay Về </a>
    </div>
 
    <div class="order_announce">
        THÔNG TIN ĐƠN HÀNG CỦA BẠN:
    </div>
    <br>
    @if (session('msg'))
    <div class="msg alert alert-{{ session('type') }}">{{ session('msg') }}</div>
@endif
<div class="all-order">
    <div class="type-of-order col-2">
        <p class="line"></p>
        <a href="{{route('renderOrder')}}">Tất Cả</a>
        <a href="{{route('renderOrder',['wait'])}}">Chờ-Xác Nhận</a>
        <a href="{{route('renderOrder',["delivering"])}}">Đang Giao</a>
        <a href="{{route('renderOrder',["success"])}}">Đã Giao</a>
        <a  href="{{route('renderOrder',["cancel"])}}">Đã Hủy</a>
        
    </div>
    <div class="order_container col-10">
    <div class="order_information">
        
            
        
     

        {{-- Item --}}
        @foreach ($products as $index=>$product)

       
      
        <div class="order_item">
            <div class="client_infor">
                <div class="order_title">
                    Đơn Hàng {{$index+1}}
                   </div>
                
              
            </div>
            <table class="table  table-striped  table_delivery">
                <tr>
                    <td class="font-weight-bold" scope="col">Địa Chỉ</td>
                    <td>{{$product->diachi}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold"  scope="row">Số Điện Thoại</td>
                    <td>{{$product->sodienthoai}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold"  scope="col">Tên</td>
                    <td>{{$user->name}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold"  scope="col">Phương Thức</td>
                    <td>{{$product->phuongthuc}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold"  scope="col">Trạng Thái</td>
                    <td ><p class="alert alert-{{$product->annouce}}">{{$product->trangthai}}</p></td>
                </tr>
           </table>
            <div class="list_order">
                <table  class="table table-striped">
                    <tr>
                        <th>Hình Ảnh</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Đơn Giá</th>
                        <th>Số Lượng</th>
                        <th>Ghi chú</th>
                        <th>Tổng</th>
                    </tr>
                    @foreach ($products1 as $index1=>$product1)
                    @if($product->id == $product1->idhoadon)
                    <tr>
                        <td><img src="{{$product1->hinhanh}}" alt=""></td>
                        <td>{{$product1->tensanpham}}</td>
                        <td>{{number_format($product1->dongia)}}</td>
                        <td>{{$product1->soluong}}</td>
                        <td>{{$product1->ghichu}}</td>
                        <td>{{number_format($product1->gia)}}đ</td>
                    </tr>
                    @endif
                    @endforeach
                   </table>
                
            </div>
            <div class="button_total">
               @if($product->trangthai=="Chờ" || $product->trangthai=="Chuẩn Bị") 
                <a  href="{{route('cancelOrder',[$product->id])}}" class="order_button_cancel btn btn-danger ">Hủy Đơn Hàng</a>
                @endif
                @if($product->trangthai=="Đã Giao") 
                <button value="{{$product->id}}"  id="rating-button" class="order_button_rating btn btn-warning ">Đánh Giá Sản Phẩm</button>
                @endif
              
                <p class="order_total_price">
                    @if($product->giamgia!=0)
                    <span class="text text-success" >Giảm giá:  {{number_format($product->giamgia) }}đ</span><br>
                    @endif
                    <span>Tổng tiền:</span> {{number_format($product->tongtien) }}đ
                 
                </p>
                
            </div>

          
        </div>
        @if($product->trangthai=="Đã Giao")   
        <div class="rating-container rating-{{$product->id}}" >
           <p class="off-rating"> <i class="fa-solid fa-x"></i></p>
            <p class="text-center alert alert-success">Đánh Giá Sản Phẩm</p>
        @foreach ($products1 as $index1=>$product1)
        @if($product->id == $product1->idhoadon)
        <div class="rating-item">
            <form action="{{route('detail_product',$product1->idsanpham)}}">
                
                @csrf
        <table class="table table-striped">
            <tr>
                <th>Hình Ảnh</th>
                <th>Tên Sản Phẩm</th>
                <td>Đi Đến Đánh Giá</td>
            </tr>
        <tr>
            <td><img class="img-rat" src="{{$product1->hinhanh}}" alt=""></td>
            <td>{{$product1->tensanpham}}</td> 
            <td><button class="btn btn-success" type="submit"><i class="fa-solid fa-check"></i></button></td>
         </tr>
        </table>
       
      
    </form>
    </div>
      
        @endif
        @endforeach
    </div>
    @endif
        @endforeach
        
        {{-- End --}}
        {{-- <p class="text_announce">KHÔNG CÓ ĐƠN MUA CỦA BẠN </p> --}}
    </div></div>
</div>
<div class="overlay"></div>

</body>
<script>
    $(document).ready(function() {
        
     
        $('.order_button_rating').click(function() {
            var x = $(this).val();
            $('.rating-'+x+'').show();
            $('.overlay ').show();
        }) 
        $('.off-rating').click(function() {
            $('.rating-container').hide();
            $('.overlay ').hide();
        })
        $('.overlay ').click(function() {
            $('.rating-container').hide();
            $(this).hide();
        });
    }) 
</script>
</html>