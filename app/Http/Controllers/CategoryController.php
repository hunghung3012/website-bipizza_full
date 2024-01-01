<?php

namespace App\Http\Controllers;
use App\Models\CategoryModel;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
private $model;
  function __construct()
  {
    $this->model = new CategoryModel;
  }
  public function listCategoryAdmin($condition="DESC") {
    $categorys = $this->model->renderListCategoryAdmin("ngaythem",$condition);
    foreach($categorys as $value) {
        $value->quantity = count( $this->model->sizeOfCategory($value->id));
    }
    return view('admin.category.list',compact('categorys'));
  }
  
  public function addCategoryPageAdmin() {
    return view('admin.category.add');
  }
  public function editCategoryPageAdmin($id) {
    $category =  $this->model->getCategoryCondition($id);

    return view('admin.category.edit',compact('category'));
  }
  public function addCategoryAdmin(Request $request) {
    $request->validate(
      [
        "name"=> 'required',
        "tag" => 'required',

      ],[
        "name.required" => "Không để trống danh mục",
        "tag.required" => "không để trống mục tag "
      ] );
      // Lấy value sao khi validate
      $data = [
        "tendanhmuc" => $request->name,
        "tag" =>$request->tag,

      ];
      $this->model->addCategoryAdmin($data);
      return redirect()->route("admin.category.list")->with(['msg'=>"thêm sản phẩm thành công",'type'=>'success']);
      
      
  }
  public function editCategoryAdmin(Request $request ) {
    $request->validate(
      [
        "name"=> 'required',
        "tag" => 'required',

      ],[
        "name.required" => "Không để trống danh mục",
        "tag.required" => "không để trống mục tag "
      ] );
      // Lấy value sao khi validate
      $data = [
        "id"=>$request->id,
        "tendanhmuc" => $request->name,
        "tag" =>$request->tag,

      ];
      $id = $this->model->updateCategoryAdmin($data);
      return redirect()->route('admin.category.list')->with(['msg'=>"Cập nhật thành công","type"=>"success"]);
    
      
      
  }
  public function deleteCategoryAdmin($id) {
    if(!empty($this->model->getCategoryCondition($id)) ) {
    $this->model->deleteCategoryAdmin($id);
    return redirect()->route('admin.category.list')->with(['msg'=>"xóa Danh Mục thành công",'type'=>'success']);
    }else {
      return redirect()->route('admin.category.list')->with(['msg'=>"không tìm thấy danh mục :(",'type'=>'danger']);
    }
  }

}
