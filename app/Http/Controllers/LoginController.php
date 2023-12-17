<?php

namespace App\Http\Controllers;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class LoginController extends Controller
{
    private $users  ;
    function __construct()
    {
        $this->users = new UserModel();
    }
    public function checkLoginUser(Request $request) {
        // Auth::attempt()
    }
    public function pageLogin() {
        return view('login');
    }
    public function checkUserLogin(Request $request) {
        $request->validate(
            [
                "email" => "required",
                "password"=>"required"
            ],
            [
                "email.required" => "Không Được Nhập Thiếu Trường Này",
                "email.email" => "Nhập Đúng Định Dạng Email",
                "password.required" => "Không Được Nhập Thiếu Trường Này"
            ]
            );
            Auth::attempt(['user'=>$request->email,"password"=>$request->password]);

            if(Auth::check()) return redirect()->route("renderHome");
            else return redirect()->route("pageLogin")->with('msg',"Sai Tài Khoản Hoặc Mật Khẩu");
        
    }

    public function logout() {
        Auth::logout();
        return redirect()->route("pageLogin");
    }

    public function addUser(Request $request ) {
        $request->validate(
            [
                "email_su" => "required",
                "password_su"=>"required",
                "name_su" => "required",
                "address_su" => "required",
                "phone_su"=>"required",
            ],
            [
                "email_su.required" => "Không Được Nhập Thiếu Email",
                "password_su.required" => "Không Được Nhập Thiếu PassWord",
                "name_su.required" => "Không Được Nhập Thiếu Tên",
                "address_su.required" => "Không Được Nhập Thiếu Trường Địa Chỉ",
                "phone_su.required" => "Không Được Nhập Thiếu Số Điện Thoại",

            ]
            );
        $data = [
            "user" => $request->email_su,
            "password" =>bcrypt($request->password_su),
            "name" =>$request->name_su,
            "phone" =>$request->phone_su,
            "address" =>$request->address_su,
            
           

        ];
        $this->users->addUserAdmin($data);
        return redirect()->route("login")->with(["user"=>$request->email_su,"password" =>$request->password_su ]);
    }
   
    // admin
    public function pageLoginAdmin() {
        return view('admin/login');
    }
    public function loginAdmin(Request $request) {
        $request->validate(
            [
                "email" => "required",
                "password"=>"required"
            ],
            [
                "email.required" => "Không Được Nhập Thiếu Trường Này",
                "email.email" => "Nhập Đúng Định Dạng Email",
                "password.required" => "Không Được Nhập Thiếu Trường Này"
            ]
            );
            Auth::guard('admin')->attempt(['user'=>$request->email,"password"=>$request->password]);
            if(Auth::guard('admin')->check()) return redirect()->route("admin.product.list");
            else return redirect()->route("pageLoginAdmin")->with('msg',"Sai Tài Khoản Hoặc Mật Khẩu");
            
            
    }
    public function logoutAdmin() {
        Auth::guard('admin')->logout();
        return redirect()->route("loginAdmin");
        
    }
}
