<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::all();
        return view('admin.brand.index',compact('brands'));
    }

    public function create(){
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.brand.create',compact('categories','subcategories'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'desc' => ['required', 'string', 'max:200'],
            'category_id' => ['required'],
           
        ]);
    
        if ($validator->passes()) {
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->desc = $request->desc;
            $brand->status = $request->status;
            $brand->category_id = $request->category_id;
            $brand->subcategory_id = $request->subcategory_id;
    
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = date('YmdHi').'.'.$file->getClientOriginalExtension();
                $file->move(public_path('admin/image/brand'),$filename);
                $brand->image = $filename;
            }
    
            $brand->save();
    
            $notification = [
                'message' => 'Thêm danh mục con thành công',
                'alert-type' => 'success',
            ];
    
            return redirect('admin/brand')->with($notification);
        } else {
            $notification = [
                'message' => 'Thêm danh mục con thất bại',
                'alert-type' => 'error',
            ];
    
            return redirect()->back()->with($notification);
        }
    }

    public function delete($brandId){
        $brand = Brand::find($brandId);

        if (!$brand) {
            return response()->json(['message' => 'Không tìm thấy danh mục'], 404);
        }
        // xóa hình
        if ($brand->image) {
            $oldImagePath = public_path('admin/image/brand/' . $brand->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        // Thực hiện xóa
        $brand->delete();

        return response()->json(['message' => 'Xóa danh mục thành công'], 200);
    }

    public function edit($brandId){
        $categories = Category::all();
        $brand = Brand::find($brandId);
        return view('admin.brand.edit',compact('brand','categories'));
    }

    public function update(Request $request, $brandId){
        $brand = Brand::find($brandId);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'desc' => ['required', 'string', 'max:200'],
            'category_id' => ['required'],
           
        ]);
    
        if ($validator->passes()) {
            $brand->name = $request->name;
            $brand->desc = $request->desc;
            $brand->status = $request->status;
            $brand->category_id = $request->category_id;
            // $brand->subcategory_id = $request->subcategory_id;
    
            if ($request->hasFile('image')) {

                if ($request->hasFile('image')) {
                    if ($brand->image) {
                        $oldImagePath = public_path('admin/image/brand/' . $brand->image);
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                }

                $file = $request->file('image');
                $filename = date('YmdHi').'.'.$file->getClientOriginalExtension();
                $file->move(public_path('admin/image/brand'),$filename);
                $brand->image = $filename;
            }
    
            $brand->update();
    
            $notification = [
                'message' => 'Chỉnh sửa danh mục con thành công',
                'alert-type' => 'success',
            ];
    
            return redirect('admin/brand')->with($notification);
        } else {
            $notification = [
                'message' => 'Chỉnh sửa danh mục con thất bại',
                'alert-type' => 'error',
            ];
    
            return redirect()->back()->with($notification);
        }

    }
}
