<?php

namespace App\Http\Controllers;

use App\Models\CouponModel;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    private $model;
  function __construct()
  {
    $this->model = new CouponModel();
  }
  public function listCouponAdmin($condition="DESC") {
    $coupons = $this->model->getCoupon();
    
     foreach($coupons as $coupon) {
        if($coupon->soluot==0 || strtotime($coupon->ngayketthuc)<time() ) {
            $coupon->text = "Hết";
            $coupon->alert = "danger";
        }else {
            $coupon->text = "Còn";
            $coupon->alert = "success";
        }
     }
    return view('admin.coupon.list',compact('coupons'));
  }
  
  public function addCouponPageAdmin() {
    return view('admin.coupon.add');
  }
  public function editCouponPageAdmin($id) {
    $coupon =  $this->model->getCouponCondition($id);

    return view('admin.coupon.edit',compact('coupon'));
  }
  public function addCouponAdmin(Request $request) {
    $request->validate(
      [
        "name"=> 'required',
        "money" => 'required',
        "type" => 'required',
        "turn" => 'required',
        "day_start" => 'required',
        "day_end" => 'required',

      ],[
        "name.required" => "Không để trống mã giảm",
        "money.required" => "Không để trống tiền",
        "type.required" => "Không để trống loại",
        "turn.required" => "Không để trống lượt",
        "day_start.required" => "Không để trống ngày bắt đầu",
        "day_end.required" => "không để trống mục ngày kết thúc "
      ] );
      // Lấy value sao khi validate
      $data = [
        "magiam" => $request->name,
        "sotien" => $request->money,
        "loai" => ($request->type=="0")?"Cố Định":"Phần Trăm",
        "soluot" => $request->turn,
        "ngaybatdau" =>$request->day_start ,
        "ngayketthuc" =>$request->day_end,
        

      ];
 
      $this->model->addCouponAdmin($data);
      return redirect()->route("admin.coupon.list")->with(['msg'=>"thêm phiếu giảm giá thành công",'type'=>'success']);
      
      
  }
  public function editCouponAdmin(Request $request ) {
    $request->validate(
        [
            "name"=> 'required',
            "money" => 'required',
            "type" => 'required',
            "turn" => 'required',
            "day_start" => 'required',
            "day_end" => 'required',
    
          ],[
            "name.required" => "Không để trống mã giảm",
            "money.required" => "Không để trống tiền",
            "type.required" => "Không để trống loại",
            "turn.required" => "Không để trống lượt",
            "day_start.required" => "Không để trống ngày bắt đầu",
            "day_end.required" => "không để trống mục ngày kết thúc "
          ] );
      // Lấy value sao khi validate
      $data = [
        "magiam" => $request->name,
        "sotien" => $request->money,
        "loai" => ($request->type=="0")?"Cố Định":"Phần Trăm",
        "soluot" => $request->turn,
        "ngaybatdau" =>$request->day_start ,
        "ngayketthuc" =>$request->day_end,

      ];
      $id = $this->model->updateCouponAdmin($data);
      return redirect()->route('admin.coupon.list')->with(['msg'=>"Cập nhật thành công","type"=>"success"]);
    
      
      
  }
  public function deleteCouponAdmin($id) {
    if(!empty($this->model->getCouponCondition($id)) ) {
    $this->model->deleteCouponAdmin($id);
    return redirect()->route('admin.coupon.list')->with(['msg'=>"xóa Phiếu giảm giá thành công",'type'=>'success']);
    }else {
      return redirect()->route('admin.coupon.list')->with(['msg'=>"không tìm thấy danh mục :(",'type'=>'danger']);
    }
  }
}
