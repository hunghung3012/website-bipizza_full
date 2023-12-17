@extends('admin.layouts.layout2')
@section('title','Product List')
@section('css')
<link rel="stylesheet" href="/admin-2/css/product.css">

@endsection
@section('content') 
<div class="list-product-container">
    <h2 class="mb-3">Thêm Danh Mục</h2>
    <form action="{{route('admin.category.postadd')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <table class="table table-add">
       
        <tr>
            <td>Tên Danh Mục</td>
            <td><input class="form-control" name="name" type="text" value="{{old('name')}}">
                @error('name')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror</td>
            
        </tr>
        
        <tr>
            <td>Tag</td>
            <td><input class="form-control" name="tag" type="text" value="{{old('tag')}}">
                @error('tag')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror</td>
        </tr>
      <tr>
        <td colspan="2"><button type="submit" class="btn btn-success float-right">Thêm Sản Phẩm</button></td>
        
      </tr>
    </table>
  
  
    


    </form>
  
</div>
@endsection


