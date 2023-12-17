@extends('admin.layouts.layout2')
@section('title', 'Product List')
@section('css')
    <link rel="stylesheet" href="/admin-2/css/product.css">
@endsection
@section('content')
    <div class="list-product-container">
        <h2 class="mb-3">Sửa Người Dùng</h2>
        @if (session('msg'))
            <div class="alert alert-success">{{ session('msg') }}</div>
        @endif
        <form action="{{ route('admin.user.postedit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
            <table class="table table-add">


                <tr>
                    <td>User</td>
                    <td><input class="form-control" name="user" type="text"
                            value="{{ old('user') ?? $user->user }}"  readonly>
                        @error('user')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input class="form-control" name="password" type="text"
                            value="{{ old('password') ?? $user->password }} "  readonly>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </td>

                </tr>
                <tr>
                    <td>Tên Khách Hàng</td>
                    <td><input class="form-control" name="name" type="text"
                            value="{{ old('name') ?? $user->name }}">
                        @error('tag')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </td>

                </tr>
                <tr>
                    <td>Số Điện Thoại</td>
                    <td><input class="form-control" name="phone" type="text"
                            value="{{ old('phone') ?? $user->phone }}">
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </td>

                </tr>
                <tr>
                    <td>Địa Chỉ</td>
                    <td><input class="form-control" name="address" type="text"
                            value="{{ old('address') ?? $user->address }}">
                        @error('tag')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </td>

                </tr>
              
                <tr>
                    <td colspan="2"><button type="submit" class="btn btn-success float-right">Cập Nhật</button></td>

                </tr>


            </table>



        </form>

    </div>
@endsection
