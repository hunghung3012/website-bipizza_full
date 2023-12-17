<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductModel extends Model
{
    use HasFactory;
    protected  $table="sanpham";
    
    public function listCart() {
        return Cart::content();
    }
    public function addProduct($data) {
        return Cart::add($data['id'], $data['tensanpham'],$data['quantity'] , $data['gia'], 0, ['detail' => $data['detail'],'hinhanh' =>$data['hinhanh']]);
    }
    public function deleteProduct($id) {
        return Cart::remove($id);
    }
    public  function getProduct($id) {
        return Cart::get($id);
    }
    public function updateProduct($data) {
        return Cart::update($data['rowID'],$data);
    }
    function renderHome($condition) {
        return DB::table($this->table)
        ->join('danhmuc', 'sanpham.iddanhmuc', '=', 'danhmuc.id')
        ->whereIn('tendanhmuc',$condition)
        ->select('sanpham.*')
        ->get();
    }

    function renderMenu() {
        return DB::table($this->table)
        ->join('danhmuc', 'sanpham.iddanhmuc', '=', 'danhmuc.id')
        ->select('sanpham.*','tendanhmuc')
        ->get();
    }
    function renderMenuFilter($id,$price,$name,$quantity) {
        return DB::table($this->table)
        ->whereIn('iddanhmuc',$id)
        ->whereBetween('gia', [$price['from'], $price['to']])
        ->where('tensanpham', 'LIKE', '%' . $name . '%')
        ->get();
       
    }

    function renderCondition($condition) {
        $result = DB::table($this->table)
        ->join('danhmuc', 'sanpham.iddanhmuc', '=', 'danhmuc.id')
        ->where('sanpham.id', '=', $condition)
        ->select('sanpham.*', 'danhmuc.tendanhmuc')
        ->first();
        return  $result;
    }
    // admin
    function renderListProductAdmin($oderby,$condition) {
        return DB::table($this->table)
        ->join('danhmuc', 'sanpham.iddanhmuc', '=', 'danhmuc.id')
        ->orderBy($oderby,$condition)
        ->select('sanpham.*','tendanhmuc')
        ->get();
    }
    public function deleteProductAdmin($id) {
        return DB::table($this->table)->where('id', $id)->delete();
    }
    public function addProductAdmin($data) {
        return DB::table($this->table)->insertGetId($data);
    }
    public function updateProductAdmin($data) {
        return DB::table($this->table)
        ->where('id',$data['id'])
        ->update($data);
    }
    public function getCategory() {
        return DB::table('danhmuc')->get();
    }
    public function getCategoryCondition($id) {
        return DB::table('danhmuc')
        ->where('id',$id)
        ->first();
    }
}
