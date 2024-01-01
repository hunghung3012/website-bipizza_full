<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderModel extends Model
{
    use HasFactory;
    protected  $table="hoadon";
    public function getOrderUser($id) {
        return DB::table($this->table)
        ->where("idkhachhang",$id)
        ->get();
    }
    public function addOrder($data) {
        $id_order =  DB::table($this->table)->insertGetId(
            [
                
                'idkhachhang' => $data['idkhachhang'],
                'sodienthoai' =>  $data['sodienthoai'],
                'diachi'=> $data['diachi'],
                'phuongthuc'=>$data['phuongthuc'],
                'giamgia'=>$data['giamgia'],
                'tongtien'=>(int)$data['tongtien']
            ]
        );
        return $id_order;
    }
    // public function inforOrder() {
    //     $result = DB::table($this->table)->get();
    //     return  $result;
    // }
    // public function inforDetailOrder( ) {
    //     $result = DB::table($this->table)
    //     ->join('chi_tiet_hoa_don', 'hoadon.id', '=', 'chi_tiet_hoa_don.idhoadon')
    //     // ->where('chi_tiet_hoa_don.idhoadon', '=', $condition)
    //     ->select( 'chi_tiet_hoa_don.*')
    //     ->get();
    //     return  $result;
    // }
    
    // admin
    public function getOrder() {
        return DB::table($this->table)->get();
    }
    public function getOrderCondition($id) {
        return DB::table($this->table)
        ->where('id',$id)
        ->first();
    }
    public function deleteOrderAdmin($id) {
        return DB::table($this->table)->where('id', $id)->delete();
    }
    function renderListOrderAdmin($oderby,$condition) {
        return DB::table($this->table)
        ->orderBy($oderby,$condition)
        ->get();
    }
    public function addOrderAdmin($data) {
        return DB::table($this->table)->insertGetId($data);
    }
    public function updateOrderAdmin($data) {
        return DB::table($this->table)
        ->where('id',$data['id'])
        ->update($data);
    }
    public function dashboard() {

    return DB::select("
    SELECT  DATE(ngaytao) AS day  , SUM(tongtien) AS total
    FROM hoadon 
    WHERE trangthai='Đã Giao'
    GROUP BY day DESC
    ORDER BY day 
    LIMIT 7");
    }
}
