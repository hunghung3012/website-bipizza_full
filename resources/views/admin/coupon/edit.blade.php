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
        <form action="{{ route('admin.coupon.postedit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$coupon->id}}">
            <table class="table table-add">
                
                
                <tr>
                    <td>Mã Giảm</td>
                    <td><input class="form-control" name="name" type="text" value="{{old('name') ?? $coupon->magiam}}">
                        @error('name')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror</td>
                    
                </tr>
                
                <tr>
                    <td>Số Tiền</td>
                    <td><input class="form-control" name="money" type="text" value="{{old('money') ?? $coupon->sotien}}">
                        @error('money')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror</td>
                </tr>
                <tr>
                  <td>Loại</td>
                  <td>
                    <select class="form-select" name="type" id="">
                      <option value="0"  
                       {{ $coupon->loai == "Cố Định" ? 'selected' : '' }}>Cố Định</option>
                      <option value="1" {{ $coupon->loai == "Phần Trăm" ? 'selected' : '' }}>Phần Trăm</option>
                    </select>
                      @error('type')
                      <div class="alert alert-danger">{{$message}}</div>
                      @enderror</td>
              </tr>
              <tr>
                <td>Số Lượt</td>
                <td><input class="form-control" name="turn" type="number" value="{{old('turn') ?? $coupon->soluot}}">
                    @error('turn')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror</td>
            </tr>
            <tr>
              <td>Ngày Bắt Đầu</td>
              <td><input class="form-control" name="day_start" type="datetime-local" value="{{old('day_start') ?? $coupon->ngaybatdau}}">
                  @error('day_start')
                  <div class="alert alert-danger">{{$message}}</div>
                  @enderror</td>
          </tr>
          <tr>
            <td>Ngày Kết Thúc</td>
            <td><input class="form-control" name="day_end" type="datetime-local" value="{{old('day_end') ?? $coupon->ngayketthuc}}">
                @error('day_end')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror</td>
        </tr>
              <tr>
                <td colspan="7"><button type="submit" class="btn btn-success float-right"> Xác Nhận </button></td>
                
              </tr>
               

            </table>
          


        </form>

    </div>
@endsection
