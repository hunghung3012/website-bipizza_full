@extends('admin.layouts.layout2')
@section('title','Product List')
@section('css')
<link rel="stylesheet" href="/admin-2/css/product.css">
<link rel="stylesheet" href="/admin-2/css/order.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
@section('content') 
<div class="list-product-container">
    <div class="findx mb-3">
        <input class="form-control" type="text" placeholder="Nhập Tìm Kiếm">
      
    </div>
    <h2 class="mb-3">Đơn Hàng Chờ Duyệt</h2>
    
    @if(session('msg'))
    <div class="alert alert-{{session('type')}}">{{session('msg')}}</div>
    @endif
    
    <table class=" table ">
        <tr> 
            <th>ID</th>
            <th>Tên Khách Hàng</th>
            <th>Địa Chỉ</th>
            <th>Số Điện Thoại</th>
            <th>Tổng Tiền</th>
            <th>Phương Thức Chuyển</th>
            <th>Ngày Tạo</th>
            <th>Trạng Thái</th>
            <th>Chi Tiết</th>
            <th>Duyệt</th>
            <th>Hủy</th>
        </tr>
        <tbody class="body">
        @foreach($orders as $index=>$order)
            
       
        <tr >
            <td class="align-middle">{{$order->id}}</td>
            <td class="align-middle">{{$order->nameOfUser}}</td>
            <td class="align-middle">{{$order->diachi }}</td>
            <td class="align-middle">{{$order->sodienthoai}}</td>
            <td class="align-middle">{{number_format($order->tongtien)}}đ</td>
            <td class="align-middle"><div class="alert alert-{{$order->type}}"> {{$order->phuongthuc}}</div></td>
            <td class="align-middle">{{$order->ngaytao}}</td>
            <td class="align-middle text-center order-status">{{$order->trangthai}}</td>
            <td class="align-middle text-center">
                <a href="{{route("admin.order.detail",$order->id)}}" class="btn btn-dark">
                    <i class="fa-solid fa-circle-info"></i>
                </a>
            </td>
            <td class="align-middle text-center">
                <button value="{{$order->id}}" class="btn btn-success btn-approve">
                    <i class="fa-solid fa-circle-check"></i>
                </button>
            </td>

            {{-- <td class="align-middle text-center">
                <a href="{{route("admin.order.approve",$order->id)}}" class="btn btn-success">
                    <i class="fa-solid fa-circle-check"></i>
                </a>
            </td> --}}
            <td class="align-middle text-center">
                {{-- href="{{route("admin.order.cancel",$order->id)}}" --}}
                <button value="{{$order->id}}" class="btn btn-danger cancel-button ">
                    <i class="fa-solid fa-ban"></i>
                </button>
            </td>
        </tr>
       
        @endforeach
    </tbody>
    </table>
</div>
<div class="notice alert alert-success">
    <div class="notice_text">
      <span >Duyệt Thành Công</span>
    </div>
</div>

<div class="cancel_question border border-dark">
    <button class="cancel_detail w-100 btn btn-warning">Hủy, Kèm nội dung</button>
    <button 
        class="cancel_noneDetail w-100 btn btn-danger">Hủy, Không kèm nội dung</button>
    <button class="btn btn-danger remove"><i class="fa-solid fa-minus"></i></button>
</div>
<div class="cancel_text">
        <input type="hidden" name="id_reason" class="id-hidden" >
        <textarea class="text_editor" id="editor" name="reason"  cols="30" rows="10"></textarea>
        <button class="submit btn btn-warning float-right">Xác Nhận</button>
    <button class="back btn btn-danger"><i class="fa-solid fa-minus"></i></button>
</div>
@endsection
{{-- <script src="/admin-2/js/order.js"></script>
 --}}
 <script>
    // Function to save scroll position to localStorage
    function saveScrollPosition() {
      localStorage.setItem('scrollPosition', window.scrollY);
    }

    // Function to restore scroll position from localStorage
    function restoreScrollPosition() {
      const savedScrollPosition = localStorage.getItem('scrollPosition');
      if (savedScrollPosition !== null) {
        window.scrollTo(0, savedScrollPosition);
        localStorage.removeItem('scrollPosition'); // Remove the stored scroll position after restoring
      }
    }

    // Event listener for saving scroll position when the user scrolls
    window.addEventListener('scroll', saveScrollPosition);

    // Event listener for restoring scroll position when the page is loaded
    window.addEventListener('load', restoreScrollPosition);
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/42.0.0/classic/ckeditor.js"></script>
  <script src="/admin-2/js/order_approve.js"></script>

