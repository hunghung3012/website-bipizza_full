<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;

class DetailOrderModel extends Model
{
    use HasFactory;
    protected  $table="chi_tiet_hoa_don";
    public function addOrder($data,$id_order) {
        $id =  DB::table($this->table)->insertGetId(
            [
                'idhoadon' =>$id_order,
                'idsanpham' =>$data->id,
                'soluong'=>$data->qty,
                'gia' =>$data->price*$data->qty,
                'ghichu'=> $data->options->detail,
            ]
        );
    }
    public function getOrderDetailCondition($id) {
        $result = DB::table($this->table) 
        ->join('sanpham', 'sanpham.id', '=', "$this->table.idsanpham")
        ->where('idhoadon',$id)
        ->select("$this->table.*", 'sanpham.hinhanh','sanpham.tensanpham','sanpham.gia as dongia')
        ->get();
        return $result;
    }
    public function inforDetailOrder() {
        $result = DB::table($this->table)
        ->join('sanpham', 'sanpham.id', '=', "$this->table.idsanpham")
        ->select("$this->table.*", 'sanpham.hinhanh','sanpham.tensanpham','sanpham.gia as dongia')
        ->get();
        return  $result;
    }
    
}
