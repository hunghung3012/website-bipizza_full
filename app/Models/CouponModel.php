<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CouponModel extends Model
{
    use HasFactory;
    protected  $table="giamgia";
    public function getCoupon() {
        return DB::table($this->table)->get();
    }
    public function getCouponCondition($magiam) {
        return DB::table($this->table)
        ->where('magiam',$magiam)
        ->first();
    }
    // ADmin
    public function deleteCouponAdmin($id) {
      
        return DB::table($this->table)->where('magiam', $id)->delete();
    }

    public function addCouponAdmin($data) {
        return DB::table($this->table)->insertGetId($data);
    }
    public function updateCouponAdmin($data) {
        return DB::table($this->table)
        ->where('magiam',$data['magiam'])
        ->update($data);
    }
    function renderListCouponAdmin($oderby,$condition) {
        return DB::table($this->table)
        ->orderBy($oderby,$condition)
        ->get();
    }

  
}
