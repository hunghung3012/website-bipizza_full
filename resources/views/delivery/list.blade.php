<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/delivery.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&family=Roboto:ital,wght@0,300;1,100&display=swap" rel="stylesheet">
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
    
    <style>
       
    </style>
</head>
<body>
    <p class="alert alert-warning text-center align-middle fw-bold">Đơn Hàng Hôm Nay</p>
    @if(session('msg'))
    <p class="alert alert-success">{{session('msg')}}</p>
    @endif
    @foreach ($orders as $index=>$order)
    <div class="order-item">
        <div class="order_index ">Đơn Hàng {{$index+1}}</div>
        <div class="order-item-detail">
        <div class="head" ><p  >Tên :</p> <p class="fw-bold">{{$order->user->name}}</p></div>
        <div class="head"  ><p >Địa Chỉ :</p> <p class="fw-bold">{{$order->diachi}}</p></div>
        <div  class="head" ><p >Số Điện Thoại :</p> <p class="fw-bold">{{$order->user->phone}}</p></div>
        <div class="head"  ><p >Tổng Tiền :</p> <p class="fw-bold">{{number_format($order->tongtien) }} đ</p></div>
        <div class="head"  ><p >Id đơn hàng :</p> <p class="fw-bold">{{$order->id}}</p></div>
        <input type="hidden" id="address_user" value="{{$order->diachi}}">
        
        <table class="table table-striped table-detail">
            <tr>
                <th>Hình Ảnh</th>
                <th>Tên Sản Phẩm</th>
                <th>Đơn Giá</th>
                <th>Số Lượng</th>
                <th>Ghi chú</th>
                <th>Tổng</th>
            </tr>
            @foreach ($products1 as $index1=>$product1)
            @if($order->id == $product1->idhoadon)
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
        </table>

            <button class="find_address_button  btn-submit mb-2">
                <i class="fa-solid fa-location-dot"></i>
            </button>
            <span class="x">Tìm Địa Chỉ</span>
   <div class="button_approve">
        <form action="{{route('deliUpdateStatus')}}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$order->id}}">
        <button type="submit" class="btn btn-success btn-submit">Đã Giao Thành Công</button>
    </form>
    <form action="{{route('deliCancelOrder')}}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{$order->id}}">
    <button type="submit" class="btn btn-danger btn-submit">Không Thành Công</button>
</form>
    </div>
</div>
    </div>
    @endforeach
    <div class="annouce-container">
        <p class="h7">Đang Chuyển Hướng</p>
        <div class="dot-container">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    
    </div>
  <div class="overlay"></div>
</body>
<script>
    $(document).ready(function() {
        var annouce_container = $('.annouce-container');
        var overlay = $('.overlay');
        annouce_container.hide();
        overlay.click(function() {
            annouce_container.hide()
            overlay.hide()
        })
        $('.find_address_button').click(function() {
        //   
            annouce_container.show();
            overlay.show();
// 
           var address = $(this).closest('.order-item-detail').find('#address_user').val();
           console.log(address);
            var apiUrl = 'https://nominatim.openstreetmap.org/search?format=json&q=' + address;
        //     navigator.geolocation.getCurrentPosition(function(position) {
        //      var latitude_current = position.coords.latitude;
        //     var longitudecurrent = position.coords.longitude;
        //      console.log("Latitude: " + latitude);
        //      console.log("Longitude: " + longitude);
        // })

            // $.ajax({
            //     url: apiUrl,
            //     method: 'GET',
            //     dataType: 'json',
            //     success: function(data) {
            //         if (data && data.length > 0) {
            //             var lat = parseFloat(data[0].lat);
            //             var lon = parseFloat(data[0].lon);
            //             let address  =`https://www.google.com/maps/dir/15.975298,108.252194/${lat},${lon}/`;
            //             window.open(address, '_blank'); ;
            //             console.log(address);
            //         } else {
            //             alert('Không tìm thấy địa chỉ này')
            //         }
            //     },
            //     error: function(error) {
            //         alert('Không tìm thấy địa chỉ này')
            //     }
            // });
            fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
    if (data && data.length > 0) {
      var { lat, lon } = data[0];
      var address = `https://www.google.com/maps/dir/15.975298,108.252194/${lat},${lon}/`;
      window.open(address, '_blank');
      console.log(address);
    } else {
      alert('Không tìm thấy địa chỉ.');
    }
  })
  .catch(error => console.error('Error:', error));
        });
    });
</script>
</html>