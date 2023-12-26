<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order_item;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Slider;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){
        $categories = Category::where('status','1')->get();
        $brands = Brand::where('status','1')->get();
        $sliders = Slider::where('status','1')->get();
        if( Auth::user()){
            $orders = Order::where('user_id', Auth::user()->id)->get();
        }else{
            $orders="";
        }
      
        $setting = Setting::first();
        return view('frontend.pages.order',compact('categories','sliders','brands','orders','setting'));
    }
    public function viewOrder($id){
        $categories = Category::where('status','1')->get();
        $brands = Brand::where('status','1')->get();
        $sliders = Slider::where('status','1')->get();
        $order = Order::find($id);
        $order_items = Order_item::where('order_id',$id)->get();
        $setting = Setting::first();
        return view('frontend.pages.viewOrder',compact('categories','brands','order','order_items','setting','sliders'));
    }

    public function edit_info(Request $request, $id){
        {
            $order = Order::find($id);
            if (!$order) {
                return redirect()->back()->with('error', 'Đơn hàng không tồn tại');
            }
            $request->validate([
                'fullname' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'address' => 'required',
            ]);
            $order->fullname = $request->fullname;
            $order->email = $request->email;
            $order->phone = $request->phone;
            $order->address = $request->address;
            $order->save();
            return redirect()->back()->with('success', 'Thông tin đơn hàng đã được cập nhật thành công');
        }
    }

    public function deleteOrder($orderId)
    {
        $order = Order::find($orderId);
    
        if (!$order) {
            return response()->json(['message' => 'Không tìm thấy đơn hàng'], 404);
        }
        $orderItems = Order_item::where('order_id', $orderId)->get();
        foreach ($orderItems as $orderItem) {
            $orderItem->delete();
        }

        $order->delete();
    
        return response()->json(['message' => 'Hủy đơn hàng thành công'], 200);
    }
    
}
