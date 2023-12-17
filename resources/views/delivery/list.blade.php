<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/delivery.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&family=Roboto:ital,wght@0,300;1,100&display=swap" rel="stylesheet">
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
        <div class="head"  ><p >Địa Chỉ :</p> <p class="fw-bold">{{$order->user->address}}</p></div>
        <div  class="head" ><p >Số Điện Thoại :</p> <p class="fw-bold">{{$order->user->phone}}</p></div>
        <div class="head"  ><p >Tổng Tiền :</p> <p class="fw-bold">{{number_format($order->tongtien) }} đ</p></div>
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
        <form action="{{route('deliUpdateStatus')}}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$order->id}}">
        <button type="submit" class="btn btn-success btn-submit">Đã Giao Thành Công</button>
    </form>
    </div>
    </div>
    @endforeach
  
</body>
</html>