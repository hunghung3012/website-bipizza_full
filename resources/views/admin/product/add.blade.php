@extends('admin.layouts.layout2')
@section('title','Product List')
@section('css')
<link rel="stylesheet" href="/admin-2/css/product.css">

@endsection
@section('content') 
<div class="list-product-container">
    <h2 class="mb-3">Thêm Sản Phẩm</h2>
    <form action="{{route('admin.product.postadd')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <table class="table table-add">
        <tr>
            <td>Danh Mục</td>
            <td>
                <select class="form-select" name="category" id="" >
                    <option selected value=""></option>
                    @foreach($categorys as $category)
                    <option  
                        {{old('category') == $category->id ? 'selected' : '' }}
                        value="{{$category->id}}">{{$category->tendanhmuc}}
                    </option>
                    @endforeach
                </select>
                @error('category')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </td>
        </tr>
        <tr>
            <td>Tên Sản Phẩm</td>
            <td><input class="form-control" name="name" type="text" value="{{old('name')}}">
                @error('name')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror</td>
            
        </tr>
        <tr>
            <td>Giá</td>
            <td><input class="form-control" name="price" type="text" value="{{old('price')}}">
                @error('price')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror</td>
        </tr>
        <tr>
            <td>Số Lượng</td>
            <td><input class="form-control" name="quantity" type="number" value="{{old('quantity')}}">
                @error('quantity')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror</td>
        </tr>
        <tr>
            <td>Hình Ảnh</td>
            <td><input class="form-control" name="picture" type="file" value="{{old('picture')}}">
                @error('picture')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror</td>
        </tr>
        <tr>
            <td>Mô tả</td>
           
              
        </tr>

    </table>
    <div class="editor_container" >
        <textarea class="form-control" name="detail" id="editor" cols="50" rows="50" >
            {{old('detail')}}
        </textarea>
        @error('detail')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <button type="submit" class="btn btn-success float-right">Thêm Sản Phẩm</button>
    </div>
    


    </form>
    
</div>
@endsection


