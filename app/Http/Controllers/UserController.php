<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    private $model;
    function __construct()
    {
        $this->model = new UserModel;
    }
    public function listUserAdmin($condition = "DESC")
    {
        $users = $this->model->renderListUserAdmin("create_at", $condition);
        return view('admin.user.list', compact('users'));
    }

    public function addUserPageAdmin()
    {
        return view('admin.user.add');
    }
    public function editUserPageAdmin($id)
    {
        $user =  $this->model->getUserCondition($id);

        return view('admin.user.edit', compact('user'));
    }
    public function addUserAdmin(Request $request)
    {
      
        return redirect()->route("admin.user.list")->with(['msg' => "thêm sản phẩm thành công", 'type' => 'success']);
    }
    public function editUserAdmin(Request $request)
    {
       
        $request->validate(
            [
                "password" => 'required',
                "name" => 'required',
                "phone" => 'required|digits:10',
                "address" => 'required',
            

            ],
            [
                "password.required" => "Không để trống danh mục",
                "name.required" => "không để trống tên khách hàng",
                "phone.required" => "Không để trống số điện thoại",
                "address.required" => "không để trống mục địa chỉ "
                
            ]
        );
        // Lấy value sao khi validate
        $data = [
            "id" => $request->id,
            "password" => $request->password,
            "name"=>$request->name,
            "phone"=> $request->phone,           
            "address" => $request->address

        ];
        $id = $this->model->updateUserAdmin($data);
        return redirect()->back()->with('msg', "Cập nhật thành công");
    }
    public function deleteUserAdmin($id)
    {
        if (!empty($this->model->getUserCondition($id))) {
            $this->model->deleteUserAdmin($id);
            return redirect()->route('admin.user.list')->with(['msg' => "xóa Người Dùng thành công", 'type' => 'success']);
        } else {
            return redirect()->route('admin.user.list')->with(['msg' => "không tìm thấy Người Dùng :(", 'type' => 'danger']);
        }
    }
   


}
