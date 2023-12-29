@extends('admin.layouts.layout2')
@section('title','Product List')
@section('css')
<link rel="stylesheet" href="/admin-2/css/product.css">
@endsection
@section('content') 
<div class="list-product-container">
    <h2 class="mb-3">Danh Sách Người Dùng</h2>
    {{-- <div>
        <a href="{{route('admin.user.add')}}" class="mb-3 btn btn-primary"><i class="fa-solid fa-circle-plus"></i> Thêm Người Dùng</a>
    </div> --}}
    @if(session('msg'))
    <div class="alert alert-{{session('type')}}">{{session('msg')}}</div>
    @endif
    <table class=" table ">
        <tr> 
            <th>ID</th>
            <th>User</th>
            {{-- <th>Password</th> --}}
            <th>Tên Khách Hàng</th>
            <th>Số Điện Thoại</th>
            <th>Địa Chỉ</th>
            <th>Ngày Tạo</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
        @foreach($users as $index=>$user)
            
       
        <tr >
            <td class="align-middle">{{$user->id}}</td>
            <td class="align-middle">{{$user->user}}</td>
            {{-- <td class="align-middle">{{$user->password }}</td> --}}
            <td class="align-middle">{{$user->name}}</td>
            <td class="align-middle">{{$user->phone}}</td>
            <td class="align-middle">{{$user->address}}</td>
            <td class="align-middle">{{$user->create_at}}</td>
            <td>
                <a href="{{route("admin.user.edit",$user->id)}}" class="btn btn-warning"><i class="fa-solid fa-scissors"></i></a>
            </td>
            <td><a 
                onclick="return confirm(`Bạn có chắc chắc xóa người dùng này?`)"
                
                href="{{route("admin.user.delete",$user->id)}}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a></td>
        </tr>
       
        @endforeach
    </table>
</div>
@endsection

