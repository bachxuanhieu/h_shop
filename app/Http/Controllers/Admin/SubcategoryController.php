<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Subcategory;
class SubcategoryController extends Controller
{
    public function index(){
        $subcategories = Subcategory::all();
        return view("admin.subcategory.index",compact("subcategories"));
    }

    public function create(){
        $categories = Category::all();
        return view("admin.subcategory.create",compact("categories"));
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'desc' => ['required', 'string', 'max:200'],
            'category_id' => ['required'],
           
        ]);
    
        if ($validator->passes()) {
            $subcategory = new Subcategory();
            $subcategory->name = $request->name;
            $subcategory->desc = $request->desc;
            $subcategory->status = $request->status;
            $subcategory->category_id = $request->category_id;
    
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = date('YmdHi').'.'.$file->getClientOriginalExtension();
                $file->move(public_path('admin/image/subcategory'),$filename);
                $subcategory->image = $filename;
            }
    
            $subcategory->save();
    
            $notification = [
                'message' => 'Thêm danh mục con thành công',
                'alert-type' => 'success',
            ];
    
            return redirect('admin/subcategory')->with($notification);
        } else {
            $notification = [
                'message' => 'Thêm danh mục con thất bại',
                'alert-type' => 'error',
            ];
    
            return redirect()->back()->with($notification);
        }
    }



    public function delete($subId){
        $subCategory = Subcategory::find($subId);

        if (!$subCategory) {
            return response()->json(['message' => 'Không tìm thấy danh mục'], 404);
        }
        // xóa hình
        if ($subCategory->image) {
            $oldImagePath = public_path('admin/image/subcategory/' . $subCategory->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        // Thực hiện xóa
        $subCategory->delete();

        return response()->json(['message' => 'Xóa danh mục thành công'], 200);
    }

    public function edit($subId){
        $subcategory = Subcategory::find($subId);
        $categories = Category::all();
        return view('admin.subcategory.edit',compact('subcategory','categories'));
    }

    public function update(Request $request, $subId){
        $subcategory = Subcategory::find($subId);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'desc' => ['required', 'string', 'max:200'],
            'category_id' => ['required'],
           
        ]);
    
        if ($validator->passes()) {
            $subcategory->name = $request->name;
            $subcategory->desc = $request->desc;
            $subcategory->status = $request->status;
            $subcategory->category_id = $request->category_id;
    
            if ($request->hasFile('image')) {

                if ($request->hasFile('image')) {
                    if ($subcategory->image) {
                        $oldImagePath = public_path('admin/image/subcategory/' . $subcategory->image);
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                }

                $file = $request->file('image');
                $filename = date('YmdHi').'.'.$file->getClientOriginalExtension();
                $file->move(public_path('admin/image/subcategory'),$filename);
                $subcategory->image = $filename;
            }
    
            $subcategory->save();
    
            $notification = [
                'message' => 'Chỉnh sửa danh mục con thành công',
                'alert-type' => 'success',
            ];
    
            return redirect('admin/subcategory')->with($notification);
        } else {
            $notification = [
                'message' => 'Chỉnh sửa danh mục con thất bại',
                'alert-type' => 'error',
            ];
    
            return redirect()->back()->with($notification);
        }

    }

}
