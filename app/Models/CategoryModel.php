<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoryModel extends Model
{
    use HasFactory;
    protected  $table="danhmuc";
    public function getCategory() {
        return DB::table($this->table)->get();
    }
    public function getCategoryCondition($id) {
        return DB::table($this->table)
        ->where('id',$id)
        ->first();
    }
    public function deleteCategoryAdmin($id) {
        DB::table('sanpham')->where('iddanhmuc', $id)->delete();
        return DB::table($this->table)->where('id', $id)->delete();
    }
    function renderListCategoryAdmin($oderby,$condition) {
        return DB::table($this->table)
        ->orderBy($oderby,$condition)
        ->get();
    }
    public function addCategoryAdmin($data) {
        return DB::table($this->table)->insertGetId($data);
    }
    public function updateCategoryAdmin($data) {
        return DB::table($this->table)
        ->where('id',$data['id'])
        ->update($data);
    }

    function sizeOfCategory($id) {
        return DB::table('sanpham')
        ->where('iddanhmuc',$id)
        ->get()
        ;
    }
}
