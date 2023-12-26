<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::all();
        return view('admin.slider.index',compact('sliders'));
    }

    public function  create(){
        return view('admin.slider.create');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
        
        ]);
    
        if ($validator->passes()) {
            $slider = new Slider();
            $slider->name = $request->name;
            $slider->desc = $request->desc;
            $slider->status = $request->status;
    
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = date('YmdHi').'.'.$file->getClientOriginalExtension();
                $file->move(public_path('admin/image/sliders'),$filename);
                $slider->image = $filename;
            }
    
            $slider->save();
    
            $notification = [
                'message' => 'Thêm thanh trượt thành công',
                'alert-type' => 'success',
            ];
    
            return redirect('admin/sliders')->with($notification);
        } else {
            $notification = [
                'message' => 'Thêm danh mục thất bại',
                'alert-type' => 'error',
            ];
    
            return redirect()->back()->with($notification);
        }
    }
}
