<?php

namespace App\Http\Controllers;

use App\Models\CommentModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $model;
    function __construct()
    {
      $this->model = new CommentModel();
    }
    public function addComment(Request $request) {
       
        $data = [
            'idsanpham' =>$request->id,
            'noidung' =>$request->content,
            'idkhachhang' =>Auth::id()
        ];
        $this->model->addCommentAdmin($data);
        $user = new UserModel();
        $name = $user->getUserCondition(Auth::id())->name;
       return  $name;
    }
}
