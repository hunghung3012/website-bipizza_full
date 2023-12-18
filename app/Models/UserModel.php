<?php

namespace App\Models;
use App\Http\Controllers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    use HasFactory;
    protected  $table="users";
    public function getUser() {
        return DB::table($this->table)->get();
    }
    public function getUserCondition($id) {
        return DB::table($this->table)
        ->where('id',$id)
        ->first();
    }
    public function deleteUserAdmin($id) {
        return DB::table($this->table)->where('id', $id)->delete();
    }
    function renderListUserAdmin($oderby,$condition) {
        return DB::table($this->table)
        ->orderBy($oderby,$condition)
        ->get();
    }
    public function addUserAdmin($data) {
        return DB::table($this->table)->insertGetId($data);
    }

    public function updateUserAdmin($data) {
        return DB::table($this->table)
        ->where('id',$data['id'])
        ->update($data);
    }
    public function getUserConditionEmail($email) {
        return DB::table($this->table)
        ->where('user',$email)
        ->first();
    }
}
