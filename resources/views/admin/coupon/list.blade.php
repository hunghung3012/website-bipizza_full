@extends('admin.layouts.layout2')
@section('title','Product List')
@section('css')
<link rel="stylesheet" href="/admin-2/css/product.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
@section('content') 
<div class="list-product-container">
    <div class="findx mb-3">
        <input class="form-control" type="text" placeholder="Nhập Tìm Kiếm">
      
    </div>
    @php
    $i=0
    @endphp
    <h2 class="mb-3">Danh Sách Phiếu Giảm Giá</h2>
    <div>
        <a href="{{route('admin.coupon.add')}}" class="mb-3 btn btn-primary"><i class="fa-solid fa-circle-plus"></i> Thêm Phiếu Giảm Giá</a>
    </div>
    @if(session('msg'))
    <div class="alert alert-{{session('type')}}">{{session('msg')}}</div>
    @endif
    <table class=" table ">
        <tr> 
            <th>STT</th>
            <th>Mã Giảm</th>
            <th>Số Tiền</th>
            <th>Loại</th>
            <th>Số Lượt</th>
            <th>Ngày Bắt Đầu</th>
            <th>Ngày Kết Thúc</th>
            <th>Trạng Thái</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
        <tbody class="body">
        @foreach($coupons as $index=>$coupon)
            
       
        <tr >
            <td class="align-middle">{{$i++}}</td>
            <td class="align-middle">{{$coupon->magiam}}</td>
            <td class="align-middle">{{$coupon->sotien }}</td>
            <td class="align-middle">{{$coupon->loai}}</td>
            <td class="align-middle">{{$coupon->soluot}}</td>
            <td class="align-middle">{{$coupon->ngaybatdau}}</td>
            <td class="align-middle">{{$coupon->ngayketthuc}}</td>
            <td class="align-middle"><div class="alert alert-{{ $coupon->alert}}">{{ $coupon->text}}</div></td>
            <td>
                <a href="{{route("admin.coupon.edit",$coupon->magiam)}}" class="btn btn-warning"><i class="fa-solid fa-scissors"></i></a>
            </td>
            <td><a 
                onclick="return confirm(`Xóa Phiếu Giảm Giá Này?`)"
                
                href="{{route("admin.coupon.delete",$coupon->magiam)}}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a></td>
        </tr>
       
        @endforeach
       </tbody>
    </table>
</div>
<script src="/admin-2/js/find.js"></script>

@endsection

