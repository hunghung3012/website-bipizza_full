<?php

namespace App\Http\Controllers;

use App\Models\CouponModel;
use App\Models\OrderModel;
use App\Models\DetailOrderModel;
use App\Models\ProductModel;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class OrderController extends Controller
{
    private $product;
    private $order;
    private $detail_order;
    private $user;
    private $coupon;
    function __construct()
    {
        $this->product = new ProductModel;
        $this->order = new OrderModel;
        $this->detail_order = new DetailOrderModel;
        $this->user = new UserModel;
        $this->coupon = new CouponModel();
    }
    public function renderOrder($condition = "normal"){
    $user_id = Auth::id();
    
    // Sử dụng Eloquent Relationships để lấy đơn hàng của người dùng
    $order = $this->order->getOrderUser($user_id);

    switch ($condition) {
        case 'normal':
            $products = $order;
            break;
        case 'wait':
            $products = collect($order)->filter(function ($value) {
                return in_array($value->trangthai, ['Chờ', 'Chuẩn Bị']);
            });
            break;
        case 'cancel':
            $products = collect($order)->where('trangthai', 'Đã Hủy');
            break;
        case 'delivering':
            $products = collect($order)->where('trangthai', 'Đang Giao');
            break;
        case 'success':
            $products = collect($order)->where('trangthai', 'Đã Giao');
            break;
        default:
            $products = $order;
            break;
    }

    $products1 = $this->detail_order->inforDetailOrder();

    // Sử dụng mảng ánh xạ thay vì switch
    $statusColors = [
        'Chờ' => 'secondary',
        'Chuẩn Bị' => 'primary',
        'Đang Giao' => 'warning',
        'Đã Giao' => 'success',
        'Đã Hủy' => 'danger',
    ];

    foreach ($products as $product) {
        $product->annouce = $statusColors[$product->trangthai] ?? 'secondary';
    }

    $user = Auth::user();
    return view('order', compact('products', 'products1', 'user'));
}

    public function processOder(Request $request)
    {
   
        $request->validate(
            [
                'address' => 'required|max:400',
                "phone" => 'required'
            ],
            [
                'address.required' => "Không được để trống địa chỉ",
                'address.max' => "Không được ghi quá :min ký tự",
                "phone.required" => 'Không được để trống số điện thoại'

            ]
        );
  
        $list_product = $this->product->listCart();
        // Insert zô hoadon
        $total =floatval(str_replace(['$', ','], '', Cart::subtotal()))-$request->coupon;
        if($total<0) $total = 0;
        if($this->coupon->getCouponCondition($request->coupon_turn)) {
            $data = [
                'magiam' => $request->coupon_turn,
                'soluot' => $this->coupon->getCouponCondition($request->coupon_turn)->soluot-1
            ];
            $this->coupon->updateCouponAdmin($data);
            
        };
       
        $data = [
            'idkhachhang' => Auth::id(),
            'diachi' => $request->address,
            'sodienthoai' =>  $request->phone,
            'phuongthuc' => ($request->payment == "transfer") ? 'Chuyển Khoản' : 'Tiền Mặt',
            'giamgia' =>  $request->coupon,
            'tongtien' => $total
        ];
        $id_order = $this->order->addOrder($data);
        // Ở trên đã hoàn thành việc add hóa đơn
        // giờ phải add zô chi tiết hóa đơn
        foreach ($list_product as $index => $product) {
            $this->detail_order->addOrder($product, $id_order);
            $data = [
                "id" =>$product->id,
                "soluong" => $this->product->renderCondition($product->id)->soluong-$product->qty,
            ];
            $this->product->updateProductAdmin( $data  );
        }
        Cart::destroy();
        return redirect()->route('renderOrder');
    }
    
    public function ajaxcheckCoupon(Request $request)
    {
   
        $coupon = $this->coupon->getCouponCondition($request->coupon);
        $total = floatval(str_replace(['$', ','], '', Cart::subtotal()));
        if (!isset($coupon)) {
            return ['valid' => false, 'msg' => 'Không Tồn Tại Mã'];
        }
        $ngayBatDau = strtotime($coupon->ngaybatdau);
        $ngayKetThuc = strtotime($coupon->ngayketthuc);
        if ($coupon->soluot <= 0) {
            return ['valid' => false, 'msg' => 'Đã Hết Lượt Sử Dụng'];
        } else if ($ngayBatDau > time() || $ngayKetThuc < time()) {
            return ['valid' => false, 'msg' => 'Đã Hết Hạn Hoặc Chưa Bắt Đầu'];
        } else {
         
            $money_coupon = $coupon->sotien;
            $coupon_detail = "";
            $coupon_temp = 0;
            if ($coupon->loai == "Cố Định") {
                $total = $total - $money_coupon;
                $coupon_temp = $money_coupon;
            } else {
                $coupon_detail = "(-".$money_coupon."%)";
                $coupon_temp = $money_coupon * $total/ 100;
                $total = $total - $money_coupon * $total / 100;
               
                
              
            }
            if($total<0) $total=0;
           
            return [
                'valid' => true,
                'money_coupon' => number_format($coupon_temp) . "đ".$coupon_detail ,
                'total' => $total,
                'coupon_temp'=>$coupon_temp,
                'magiam'=>$coupon->magiam,
               
            ];
        }
    }
    public function cancelOrder($id)
    {
        if (!empty($this->order->getOrderCondition($id))) {
            $this->order->updateOrderAdmin(['id' => $id, "trangthai" => "Đã Hủy"]);

            // Sửa lại số lượng sản phẩm
          $details = $this->detail_order->getOrderDetailCondition($id);
          foreach($details as $detail) {
              $data1 = [
                  "id" =>$detail->idsanpham,
                  "soluong" => $this->product->renderCondition($detail->idsanpham)->soluong+$detail->soluong,
              ];
              $this->product->updateProductAdmin( $data1 );
          }
          // 
            return redirect()->route('renderOrder')->with(['msg' => "Hủy Đơn Hàng thành công", 'type' => 'success']);
        } else {
            return redirect()->route('renderOrder')->with(['msg' => "không tìm thấy Đơn Hàng :(", 'type' => 'danger']);
        }
    }
    //   admin
    public function listOrderAllAdmin()
    {
        $orders = $this->order->getOrder();
        foreach ($orders as $order) {
            $order->nameOfUser = $this->user->getUserCondition($order->idkhachhang)->name;
            $order->type = ($order->phuongthuc == "Tiền Mặt") ? "success" : "warning";
        }

        return view('admin.order.list_all', compact('orders'));
    }
    public function listOrderDeliAdmin()
    {
        $temp = [];
        $orders = $this->order->getOrder();
        foreach ($orders as $order) {
            if ($order->trangthai == "Chuẩn Bị") {
                $temp[] = $order;
            }
        }
        $orders = $temp;
        foreach ($orders as $order) {
            $order->nameOfUser = $this->user->getUserCondition($order->idkhachhang)->name;
            $order->type = ($order->phuongthuc == "Tiền Mặt") ? "success" : "warning";
        }

        return view('admin.order.list_deli', compact('orders'));
    }
    public function listOrderApproveAdmin() {
        $temp = [];
        $orders = $this->order->getOrder();
        foreach ($orders as $order) {
            if ($order->trangthai == "Chuẩn Bị" || $order->trangthai == "Chờ") {
                $temp[] = $order;
            }
        }
        $orders = $temp;
        foreach ($orders as $order) {
            $order->nameOfUser = $this->user->getUserCondition($order->idkhachhang)->name;
            $order->type = ($order->phuongthuc == "Tiền Mặt") ? "success" : "warning";
        }

        return view('admin.order.list_approve', compact('orders'));
    }
    public function cancelOrderAdmin($id)
    {
        return  $this->updateStatusOrder($id, "Đã Hủy", ["sucess" => "Hủy Thành Công", "danger" => "Hủy Không Thành Công"]);
    }
    public function approveOrderAdmin($id)
    {
        return   $this->updateStatusOrder($id, "Chuẩn Bị", ["sucess" => "Duyệt Thành Công", "danger" => "Duyệt Không Thành Công"]);
    }
    public function updateStatusOrder($id, $atr, $status)
    {
        if ($this->order->getOrderCondition($id)) {
            $data = [
                "id" => $id,
                "trangthai" => $atr
            ];
            $this->order->updateOrderAdmin($data);
            return redirect()->back()->with(['msg' => $status['sucess'], 'type' => "success"]);
        } else {
            return redirect()->back()->with(['msg' => $status['danger'], 'type' => "danger"]);
        }
    }
    public function detailOrderAdmin($id)
    {
        $order = $this->order->getOrderCondition($id);
        $order->nameOfUser = $this->user->getUserCondition($order->idkhachhang)->name;
        $details = $this->detail_order->getOrderDetailCondition($id);

        return view('admin.order.detail', compact('order', 'details'));
    }
    public function ajaxApproveOrderAdmin($id)
    {
        $this->order->getOrderCondition($id);
        $data = [
            "id" => $id,
            "trangthai" => "Chuẩn Bị"
        ];
        $this->order->updateOrderAdmin($data);
        return $data;
    }
    public function ajaxDeliOrderAdmin($id)
    {
        $this->order->getOrderCondition($id);
        $data = [
            "id" => $id,
            "trangthai" => "Đang Giao"
        ];
        $this->order->updateOrderAdmin($data);
        return $data;
    }
    public function ajaxCancelOrderAdmin(Request $request)
    {
        $this->order->getOrderCondition($request->id);
        $data = [
            "id" => $request->id,
            "trangthai" => "Đã Hủy",
         
        ];
        $this->order->updateOrderAdmin($data);
          // Sửa lại số lượng sản phẩm
          $details = $this->detail_order->getOrderDetailCondition($request->id);
          foreach($details as $detail) {
              $data1 = [
                  "id" =>$detail->idsanpham,
                  "soluong" => $this->product->renderCondition($detail->idsanpham)->soluong+$detail->soluong,
              ];
              $this->product->updateProductAdmin( $data1 );
          }
          // 
        return response()->json(['status' => 'success', 'message' => 'Hủy Thành Công']);
    }
    public function ajaxCancelEmailOrderAdmin(Request $request)
    {
        $content = $request->content;
        Mail::send("mail.cancel", compact('content'), function ($email) {
            $email->subject("Hủy Đơn Hàng");
            $email->to("vonhathung3012@gmail.com", "Bizza");
        });
        $this->order->getOrderCondition($request->id);
        $data = [
            "id" => $request->id,
            "trangthai" => "Đã Hủy"
        ];

        $this->order->updateOrderAdmin($data);
        // Sửa lại số lượng sản phẩm
        $details = $this->detail_order->getOrderDetailCondition($request->id);
        foreach($details as $detail) {
            $data1 = [
                "id" =>$detail->idsanpham,
                "soluong" => $this->product->renderCondition($detail->idsanpham)->soluong+$detail->soluong,
            ];
            $this->product->updateProductAdmin( $data1 );
        }
        // 
        return response()->json(['status' => 'success', 'message' => 'Hủy Thành Công']);
    }

    public function testup()
    {
    }
    // Delivery
    public function pageListDeli()
    {
        $orders = $this->order->getOrder();
        $products1 = $this->detail_order->inforDetailOrder();
        $index = 0;
        $temp = [];
        foreach ($orders as $order) {
            $order->user = $this->user->getUserCondition($order->idkhachhang);
            if ($order->trangthai == "Đang Giao") {
                $temp[] =  $order;
            }
        };
        $orders = $temp;
        $index = 0;
        return view('delivery.list', compact('orders', 'products1', 'index'));

        // return view('delivery.list',compact('orders'));
    }
    public function deliUpdateStatus(Request $request)
    {
        $this->order->getOrderCondition($request->id);
        $data = [
            "id" =>  $request->id,
            "trangthai" => "Đã Giao"
        ];
        $this->order->updateOrderAdmin($data);
        return redirect()->back()->with('msg', "Cập Nhật Thành Công");
    }
    public function getSubTotal()
    {
        $product = Cart::get('cf72fc87e094e20ddbcb165a12e0a620');
        dd($product)  ;
    }
}
