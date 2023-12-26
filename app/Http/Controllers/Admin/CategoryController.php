<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view("admin.category.index",compact("categories"));
    }


    public function create(){
        return view("admin.category.create");
    }
    public function store(Request $request)
    {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:100'],
                'slug' => ['required', 'string', 'max:100'],
            
            ]);
        
            if ($validator->passes()) {
                $category = new Category();
                $category->name = $request->name;
                $category->slug = $request->slug;
                $category->status = $request->status;
        
                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $filename = date('YmdHi').'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('admin/image/category'),$filename);
                    $category->image = $filename;
                }
        
                $category->save();
        
                $notification = [
                    'message' => 'Thêm danh mục thành công',
                    'alert-type' => 'success',
                ];
        
                return redirect('admin/category')->with($notification);
            } else {
                $notification = [
                    'message' => 'Thêm danh mục thất bại',
                    'alert-type' => 'error',
                ];
        
                return redirect()->back()->with($notification);
            }
    }

    public function delete($categoryId){
        $category = Category::find($categoryId);

        if (!$category) {
            return response()->json(['message' => 'Không tìm thấy danh mục'], 404);
        }
        // xóa hình
        if ($category->image) {
            $oldImagePath = public_path('admin/image/category/' . $category->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        // Thực hiện xóa
        $category->delete();

        return response()->json(['message' => 'Xóa danh mục thành công'], 200);
    }

    public function edit($categoryId){
        $category = Category::find($categoryId);
        return view('admin.category.edit',compact('category'));
    }

    public function update(Request $request, $categoryId){
        $category = Category::find($categoryId);


        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'slug' => ['required', 'string', 'max:100'],
           
        ]);

        if ($validator->passes()) {
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
    
            if ($request->hasFile('image')) {
                if ($category->image) {
                    $oldImagePath = public_path('admin/image/category/' . $category->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $file = $request->file('image');
                $filename = date('YmdHi').'.'.$file->getClientOriginalExtension();
                $file->move(public_path('admin/image/category'),$filename);
                $category->image = $filename;
            }
    
            $category->update();
    
            $notification = [
                'message' => 'Chỉnh sửa danh mục thành công',
                'alert-type' => 'success',
            ];
    
            return redirect('admin/category')->with($notification);
        } else {
            $notification = [
                'message' => 'Chỉnh sửa danh mục thất bại',
                'alert-type' => 'error',
            ];
    
            return redirect()->back()->with($notification);
        }


    }
    

}
