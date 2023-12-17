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
    <h2 class="mb-3">Danh Sách Danh Mục</h2>
    <div>
        <a href="{{route('admin.category.add')}}" class="mb-3 btn btn-primary"><i class="fa-solid fa-circle-plus"></i> Thêm Danh Mục</a>
    </div>
    @if(session('msg'))
    <div class="alert alert-{{session('type')}}">{{session('msg')}}</div>
    @endif
    <table class=" table ">
        <tr> 
            <th>ID</th>
            <th>Tên Danh Mục</th>
            <th>Tag</th>
            <th>Số Lượng Sản Phẩm</th>
            <th>Ngày Thêm</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
        <tbody class="body">
        @foreach($categorys as $index=>$category)
            
       
        <tr >
            <td class="align-middle">{{$category->id}}</td>
            <td class="align-middle">{{$category->tendanhmuc}}</td>
            <td class="align-middle">{{$category->tag }}</td>
            <td class="align-middle">{{$category->quantity}}</td>
            <td class="align-middle">{{$category->ngaythem}}</td>
            <td>
                <a href="{{route("admin.category.edit",$category->id)}}" class="btn btn-warning"><i class="fa-solid fa-scissors"></i></a>
            </td>
            <td><a 
                onclick="return confirm(`Xóa Danh Mục Sẽ Xóa Tất Cả Sản Phẩm Trong Danh Mục Này?`)"
                
                href="{{route("admin.category.delete",$category->id)}}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a></td>
        </tr>
       
        @endforeach
    </tbody>
    </table>
</div>
<script src="/admin-2/js/find.js"></script>
@endsection

