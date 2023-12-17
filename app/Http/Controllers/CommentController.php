<?php

namespace App\Http\Controllers;

use App\Models\CommentModel;
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
            'noidung' =>$request->comment_content,
            'idkhachhang' =>Auth::id()
        ];
        $this->model->addCommentAdmin($data);
        return redirect()->back();
    }
}
