<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $product;
    private $order;
    private $user;
  
    function __construct()
    {
      $this->product = new ProductModel();
      $this->order = new OrderModel();
      $this->user = new UserModel();
    }
    public function dashboardPageAdmin() {
     $products = $this->product->renderMenu();
     $numOfOrder = 0;
     $revenue = 0;
     $orders =   $this->order ->getOrder();
     foreach($orders as $order) {
        if(date("Y-m-d", strtotime($order->ngaytao)) ==date("Y-m-d")) {
            $numOfOrder++;
        }
     }
     foreach($orders as $order) {
        if(date("Y-m-d", strtotime($order->ngaytao)) == date("Y-m-d") && $order->trangthai =="Đã Giao") {
            $revenue += $order->tongtien;
        }
     }
      $users =  $this->user->getUser();
        $data =(object) [
            "numOfProduct" => count($products ),
            "numOfOrder" => $numOfOrder,
            "numOfUser" =>  count($users ),
            "revenue" => number_format($revenue ) ."đ"
        ];
      
        return view('admin.dashboard.dashboard',compact('data'));

    }
    public function data_chart_dashboard() {
        $today = now();
        $revenueData = $this->order->dashboard( $today );
       
    return   $revenueData;
  
    }
}
