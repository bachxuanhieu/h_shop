<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Setting;
class SettingController extends Controller
{
    public function index(){
        $settings = Setting::all();
        return view('admin.setting.index',compact('settings'));
    }

    public function create(){
        return view('admin.setting.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'website_name' => ['required', 'string', 'max:100'],
            'website_url' => ['required', 'string', 'max:100'],
        
        ]);
    
        if ($validator->passes()) {
            $setting = new Setting();
            $setting->website_name = $request->website_name;
            $setting->website_url = $request->website_url; 
            $setting->page_title = $request->page_title; 
            $setting->address = $request->address; 
            $setting->phone = $request->phone; 
            $setting->email = $request->email; 
            $setting->facebook = $request->facebook; 
            $setting->twitter = $request->twitter; 
            $setting->instagram = $request->instagram; 
            $setting->youtube = $request->youtube; 
            $setting->save();
    
            $notification = [
                'message' => 'Thêm thông tin thành công',
                'alert-type' => 'success',
            ];
    
            return redirect('admin/setting')->with($notification);
            } else {
                $notification = [
                    'message' => 'Thêm thông tin thất bại',
                    'alert-type' => 'error',
            ];
    
            return redirect()->back()->with($notification);
        }
    }
}
