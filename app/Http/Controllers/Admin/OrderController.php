<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order_item;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('admin.order.index',compact('orders'));
    }

    public function viewOrder($order_id){
        // $order = Order::where('id',$order_id)->get();
        $order = Order::find($order_id);
        $order_items = Order_item::where('order_id',$order_id)->get();
        return view('admin.order.viewOrder',compact('order','order_items'));
        
    }

    public function Order_confirmation(Request $request, $id){
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['error' => 'Không tìm thấy đơn hàng'], 404);
        }
        $order->status = "Đã xác nhận";
        $order->save();
    
        return response()->json(['success' => true]);
    }

    public function filterOrdersByDate(Request $request){
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $startDateWithTime = $startDate .' 00:00:00';
        $endDateWithTime = $endDate . ' 23:59:59';

        $results = Order::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
        ->get();

        // echo $results;
        if ($results) {
            $response = [
                'status' => 'true',
                'orders' => $results,
            ];
         
        } else {
            $response = [
                'status' => 'error',
                'orders' => "",
            ];
        }
        echo json_encode($response);
    }
    
}
