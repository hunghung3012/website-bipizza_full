<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CommentModel extends Model
{
    use HasFactory;
    protected  $table="binhluan";
    public function getComment() {
        return DB::table($this->table)->get();
    }
    public function getCommentCondition($id) {
        return DB::table($this->table)
        ->where('id',$id)
        ->first();
    }
    // ADmin
    public function deleteCommentAdmin($id) {
        return DB::table($this->table)->where('id', $id)->delete();
    }

    public function addCommentAdmin($data) {
        return DB::table($this->table)->insertGetId($data);
    }
    public function updateCommentAdmin($data) {
        return DB::table($this->table)
        ->where('magiam',$data['magiam'])
        ->update($data);
    }
    function renderListCommentAdmin($oderby,$condition) {
        return DB::table($this->table)
        ->orderBy($oderby,$condition)
        ->get();
    }
    function addReponseCommentAdmin($data) {
        return DB::table('chi_tiet_binh_luan')->insertGetId($data);
    }
    function getReponseCommentAdmin($id) {
        return DB::table('chi_tiet_binh_luan')
        ->where('idbinhluan',$id)
        ->get();
    }
}
