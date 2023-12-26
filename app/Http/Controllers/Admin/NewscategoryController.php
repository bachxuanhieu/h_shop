<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newscategory;
use Illuminate\Support\Facades\Validator;

class NewscategoryController extends Controller
{
    public function index(){
        $newscategory = Newscategory::all();
        return view('admin.newscategory.index',compact('newscategory'));
    }

    public function create(){
        return view('admin.newscategory.create');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'desc' => ['required'],
        
        ]);
    
        if ($validator->passes()) {
            $newscategory = new Newscategory();
            $newscategory->name = $request->name;
            $newscategory->desc = $request->desc;
            $newscategory->status = $request->status;
    
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = date('YmdHi').'.'.$file->getClientOriginalExtension();
                $file->move(public_path('admin/image/newscategory'),$filename);
                $newscategory->image = $filename;
            }
    
            $newscategory->save();
    
            $notification = [
                'message' => 'Thêm danh mục thành công',
                'alert-type' => 'success',
            ];
    
            return redirect('admin/newscategory')->with($notification);
        } else {
            $notification = [
                'message' => 'Thêm danh mục thất bại',
                'alert-type' => 'error',
            ];
    
            return redirect()->back()->with($notification);
    
        }
    }

}
