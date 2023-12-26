<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function profile(){
        $id= Auth::user()->id;
        $user = User::find($id);
       return view("admin.profile",compact("user"));
    }

    public function uploadProfile(Request $request){
        $id= Auth::user()->id;
        $data = User::find($id);
        $data->name=$request->name;
        $data->email=$request->email;
        $data->phone=$request->phone;
        $data->address=$request->address;
        
        if($request->file('image')){
            // Kiểm tra và xóa hình ảnh cũ
            if ($data->image) {
                $oldImagePath = public_path('admin/image/' . $data->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalExtension();
            $file->move(public_path('admin/image'),$filename);
            $data['image'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Thông tin quản lí cập nhật thành công',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function ChangePassword(){
        return view('admin.changePassword');
    }

    public function UpdatePassword(Request $request){
        $request->validate([
            'old_password'=>'required',
            'new_password'=>'required|confirmed'
        ]);

        if(!Hash::check($request->old_password, auth::user()->password)){
            $notification = array(
                'message' => 'Nhập sai mật khẩu',
                'alert-type' => 'warning'
            );
            return back()->with($notification);
        }

        User::whereId(auth()->user()->id)->update([
            'password'=> Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Đổi mật khẩu thành công',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

}
