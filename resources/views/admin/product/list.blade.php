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
    <h2 class="mb-3">Danh Sách Sản Phẩm</h2>
    <div>
        <a href="{{route('admin.product.add')}}" class="mb-3 btn btn-primary"><i class="fa-solid fa-circle-plus"></i> Thêm Sản Phẩm</a>
    </div>
    @if(session('msg'))
    <div class="alert alert-{{session('type')}}">{{session('msg')}}</div>
    @endif
    <table class=" table ">
        <tr> 
            <th>ID</th>
            <th>Hình Ảnh</th>
            <th>Tên Sản Phẩm</th>
            <th>Giá</th>
            <th>Số Lượng</th>          
            <th>Mô Tả</th>
            <th>Ngày Thêm</th>
            <th>Danh Mục</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
        <tbody class="body">
        @foreach($products as $index=>$product)
            
       
        <tr >
            <td class="align-middle">{{$product->id}}</td>
            <td class="td_img">
                <div>
                <img src="{{$product->hinhanh}}" alt="">
            </div>
            </td>
            <td class="align-middle">{{$product->tensanpham}}</td>
            <td class="align-middle">{{number_format($product->gia) }}</td>
            <td class="align-middle">x{{$product->soluong}}</td>
            <td class="align-middle ">
                <div class="mota">
                 {!! $product->mota !!}
                </div>
            </td>
            <td class="align-middle">{{$product->ngaythem}}</td>
            <td class="align-middle">{{$product->tendanhmuc}}</td>
            <td>
                <a href="{{route("admin.product.edit",$product->id)}}" class="btn btn-warning"><i class="fa-solid fa-scissors"></i></a>
            </td>
            <td><a onclick="return confirm('Bạn có chắc chắn muốn xóa {{$product->tensanpham}} không?')" href="{{route("admin.product.delete",$product->id)}}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a></td>
        </tr>
       
        @endforeach
    </tbody>
    </table>
</div>
<script src="/admin-2/js/find.js"></script>

@endsection

