@extends('admin.layouts.layout2')
@section('title', 'Product List')
@section('css')
    <link rel="stylesheet" href="/admin-2/css/product.css">
    <link rel="stylesheet" href="/admin-2/css/order.css">
   
@endsection
@section('content')
    <div class="list-product-container">
        <h2 class="mb-3">Chi Tiết Đơn Hàng</h2>

        @if (session('msg'))
            <div class="alert alert-{{ session('type') }}">{{ session('msg') }}</div>
        @endif
        
        <div class="order_container">
            <div>
                <p>Tên Khách Hàng <b>{{$order->nameOfUser}} </b></p>
            </div>
            <div class="order_information">
                <table class="table">
                    <tr>
                        <th>Hình Ảnh</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Đơn Giá</th>
                        <th>Số Lượng</th>
                        <th>Ghi chú</th>
                        <th>Tổng</th>
                    </tr>
                    @foreach($details as $item)
                    <tr>
                        <td class="td_img">
                            <div>
                            <img src="{{$item->hinhanh}}" alt="">
                        </div>
                        </td>
                        <td>{{$item->tensanpham}}</td>
                        <td>{{number_format($item->dongia)}}đ</td>
                        <td>{{$item->soluong}}</td>
                        <td>{{$item->ghichu}}</td>
                        <td>{{number_format($item->gia)}}đ</td>
                    </tr>
                    @endforeach
                </table>

            </div>
        </div>
</div>



    @endsection
   
