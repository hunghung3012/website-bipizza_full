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
        $id  = $this->model->addCommentAdmin($data);
        $user = new UserModel();
        $name = $user->getUserCondition(Auth::id())->name;
        
       return  ["name"=>$name,"id"=>$id];
    }
    public function addReponseComment(Request $request) {
        $data = [
            'idbinhluan' =>$request->id,
            'noidung' =>$request->content_response,
            'idkhachhang' =>Auth::id()
        ];
        $this->model->addReponseCommentAdmin($data);
        $user = new UserModel();
        $name = $user->getUserCondition(Auth::id())->name;
       return  $name;

    }
    public function showReponseComment(Request $request) {
        
       $reponse_comment = $this->model->getReponseCommentAdmin($request->id);
        $user = new UserModel();
        foreach( $reponse_comment as $value) {
      $value->nameOfUser = $user->getUserCondition($value->idkhachhang)->name;
   }
       return  $reponse_comment;

    }
   
}
