<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\CommentModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;


use function PHPUnit\Framework\isNull;

class ProductController extends Controller
{
  private $model;
  private $category;
  private $comment;

  function __construct()
  {
    $this->model = new ProductModel;
    $this->category = new CategoryModel;
    $this->comment = new CommentModel();



  }
  public function renderHome()
  {
    $condition = ["Pizza", "Thức Ăn Khác"];
    $data = $this->model->renderHome($condition);
    $rand_data =  $this->randomArray($data->toArray(), 5);
    foreach ($rand_data as $value) {
      $fullname = $this->processName($value->tensanpham);
      $value->fisrt = $fullname->first;
      $value->name = $fullname->name;
    }
    return view('index', compact('rand_data'));
  }
  public function renderMenu()
  {
    $data = $this->model->renderMenu();
    $categorys = $this->category->getCategory();

    return view('menu', compact('data','categorys'));
  }
  public function detailProduct($id)
  {
    $data = $this->model->renderCondition($id);
    // Ngẫu nhiên đề nghị
    $condition = ["Pizza", "Combo", "Thức Ăn Khác", "Nước Uống"];
    $suggests = $this->model->renderHome($condition);
    $suggests =  $this->randomArray($suggests->toArray(), 15);
    // Số lượng theo cart
    $rowId = 0;
    $cart = Cart::content();
    $bool = false;
    foreach ($cart as $value) {
      if ($value->id == $data->id) {
        $bool = true;
        $rowId = $value->rowId;
        break;
      }
    }
    $max = ($bool) ? $data->soluong - Cart::get($rowId)->qty : $max = $data->soluong;
    // dd($max );
    // bình luận
    $comments = $this->comment->getComment();
    $user = new UserModel();
    foreach($comments as $comment) {
      $comment->nameOfUser = $user->getUserCondition($comment->idkhachhang)->name;
      $comment->reponseComment = $this->comment->getReponseCommentAdmin($comment->id);
    
    }

    return view('detail_product', compact('data', 'suggests', 'max','comments'));
  }
  public function addCart(Request $request)
  {
    $product = $this->model->renderCondition($request->id);
    $product->quantity = $request->quantity;
    $product->detail = $request->detail;
    // dd( $product );
    $data = (array)$product;
    $this->model->addProduct($data);

    return redirect()->route('renderCart');
    // ->with('msg',"Đã thêm  $product->tensanpham vào giỏ hàng");
  }
  public function renderCart()
  {
    $products =  $this->model->listCart();
    $user = Auth::user();
    foreach($products as $value) {
    $data = $this->model->renderCondition($value->id);
    $value->max  = $data->soluong;
    }
 
    return view('cart', compact('user','products'));
  }
  public function ajaxchageQuantity(Request $request) {
    // $request =(object) $request->json()->all();
    $data = [
      'rowID' => $request->id_row,
      'qty'=>$request->quantity
    ];
    $this->model->updateProduct($data);
     $product = Cart::get($request->id_row);
     $total = Cart::subtotal();

    return   ['product'=>$product,'total'=>$total];
    

  }
  public function deleteProduct($id)
  {
    $this->model->deleteProduct($id);
    return redirect()->back();;
  }

  
  public function randomArray($data, $size)
  {
    $random_index = array_rand($data, $size);
    foreach ($random_index as $value)
      $array_rand[] = (object)  $data[$value];
    return  $array_rand;
  }
  public function processName($name)
  {
    $fullname = explode(' ', $name);
    $first = $fullname[0];
    unset($fullname[0]);
    $name = implode(' ', $fullname);
    return (object) ['first' =>  $first, 'name' => $name];
  }
  
  // admin
  public function  listProductAdmin($condition="DESC") {
    $products = $this->model->renderListProductAdmin("ngaythem",$condition);
    return view('admin.product.list',compact('products'));
  }
  public function addProductPageAdmin() {
    $categorys =  $this->model->getCategory();
    return view('admin.product.add',compact('categorys'));
  }
  public function editProductPageAdmin($id) {
    $categorys =  $this->model->getCategory();
    $product = $this->model->renderCondition($id);
    // dd($product );
    return view('admin.product.edit',compact('categorys','product'));
  }
  public function editProductAdmin(Request $request ) {
    $request->validate(
      [
        "category"=> 'required|exists:danhmuc,id',
        "name" => 'required',
        "price" => 'required|integer',
        "quantity" => 'required|integer',
        "detail" =>'required'

      ],[
        "category.required" => "Chọn Danh Mục",
        "category.exists"=>"Không Tồn Tại Danh Mục",
        "name.required" => "Không được nhập thiếu trường tên",
        "price.required" => "Không được nhập thiếu trường giá",
        "quantity.required" => "Không được nhập thiếu số lượng",
        "detail.required" => "Không được nhập thiếu trường mô tả",
      ] );
      // dd($request);
      // Lấy value sao khi validate
      $picture_file = $request->file('picture'); 
      if(!empty($picture_file))      
      $dir = $this->processDirFile($picture_file,$request);
      else $dir = $request->picture_hidden;
      
      $data = [
        "id"=> $request->id,
        "tensanpham" => $request->name,
        "gia" =>$request->price,
        "soluong" =>$request->quantity,
        "hinhanh"=>$dir,
        "mota"=>trim($request->detail) ,
        "iddanhmuc"=> $request->category
      ];
      $id = $this->model->updateProductAdmin($data);
      return redirect()->back()->with('msg',"Cập nhật thành công");
    
      
      
  }

  public function addProductAdmin(Request $request ) {
    $request->validate(
      [
        "category"=> 'required|exists:danhmuc,id',
        "name" => 'required',
        "price" => 'required|integer',
        "quantity" => 'required|integer',
        "picture"=>'required',
        "detail" =>'required'

      ],[
        "category.required" => "Chọn Danh Mục",
        "category.exists"=>"Không Tồn Tại Danh Mục",
        "name.required" => "Không được nhập thiếu trường tên",
        "price.required" => "Không được nhập thiếu trường giá",
        "quantity.required" => "Không được nhập thiếu số lượng",
        "picture.required" => "Không được nhập thiếu ảnh ",
        "detail.required" => "Không được nhập thiếu trường mô tả",
      ] );
      // Lấy value sao khi validate
      $picture_file = $request->file('picture');      
      $dir = $this->processDirFile($picture_file,$request);
      $data = [
        "tensanpham" => $request->name,
        "gia" =>$request->price,
        "soluong" =>$request->quantity,
        "hinhanh"=>$dir,
        "mota"=>$request->detail,
        "iddanhmuc"=> $request->category
      ];
      $id = $this->model->addProductAdmin($data);
      return redirect()->route("admin.product.list")->with(['msg'=>"thêm sản phẩm thành công",'type'=>'success']);
      
      
  }
  
  public function deleteProductAdmin($id) {
    if(!empty($this->model->renderCondition($id)) ) {
    $this->model->deleteProductAdmin($id);
    return redirect()->route('admin.product.list')->with(['msg'=>"xóa sản Phẩm thành công",'type'=>'success']);
    }else {
      return redirect()->route('admin.product.list')->with(['msg'=>"không tìm thấy người dùng :(",'type'=>'danger']);
    }
  }
  // public function findDirImg($id) {
  //     $dir = "/images/menu/"; 
  //     $category = $this->model->getCategoryCondition($id);
  //     return $dir.$category->tag.'/';  
  // }
  public function processDirFile($picture_file,$request) {
      $dir = "/images/menu/"; 
      $category = $this->model->getCategoryCondition($request->category);
      $dir = $dir.$category->tag.'/';  

      $ext = $picture_file->extension();
      $picture_file->move(public_path($dir) ,$request->name.'.'.$ext );
      $dir = $dir.$request->name.'.'.$ext;
      return $dir;
  }
  public function ajaxMenuFilter(Request $request) {
    $data = $request->json()->all();
    $category  = $this->category->getCategory(); 
    $all = [];
    foreach($category as $value) {
      $all[] = $value->id;
    }
   
    $selectedValues = (count($data['selectedValues'])>0) ?$data['selectedValues']:$all;
    $price['from'] = (isset($data['price']['from']))?(int)$data['price']['from']:0;
  
    if (isset($data['price']['to'])) {
      $price['to'] = (int) $data['price']['to'];
      $x =  $this->model->renderMenuFilter($selectedValues, $price,$data['text'],9);
  } else {
    $price['to'] = 100000000;
      // If 'to' does not exist, perform the query without whereBetween
      $x = $this->model->renderMenuFilter($selectedValues, $price,$data['text'],9);
  }
   foreach($x as $value) {
    $value->gia = number_format($value->gia );
   }
    return $x;

  }

}
