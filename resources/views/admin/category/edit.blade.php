@extends('admin.layouts.layout2')
@section('title', 'Product List')
@section('css')
    <link rel="stylesheet" href="/admin-2/css/product.css">
@endsection
@section('content')
    <div class="list-product-container">
        <h2 class="mb-3">Sửa Sản Phẩm</h2>
        @if(session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
        @endif
        <form action="{{ route('admin.category.postedit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$category->id}}">
            <table class="table table-add">
                
                
                <tr>
                    <td>Tên Danh Mục</td>
                    <td><input class="form-control" name="name" type="text"
                            value="{{ old('name') ?? $category->tendanhmuc }}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>Tag</td>
                    <td><input class="form-control" name="tag" type="text"  
                        value="{{ old('tag') ?? $category->tag }}">
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
