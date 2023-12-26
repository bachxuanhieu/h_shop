<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;
use Illuminate\Support\Facades\Validator;

class PromotionController extends Controller
{
    public function index(){
        $promotions = Promotion::all();
        return view('admin.promotion.index',compact('promotions'));
    }

    public function create(){
        return view('admin.promotion.create');
    }

    public function store(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
            'code' => ['required', 'string', 'max:100'],
            'discount_percentage' => ['required'],
            'expiration_date' => ['required'],
        
        ]);
        if ($validator->passes()) {
       
        $promotion = new Promotion();
        $promotion->code = $request->input('code');
        $promotion->discount_percentage = $request->input('discount_percentage');
        $promotion->expiration_date = $request->input('expiration_date');
        $promotion->status = $request->input('status');

      
        $promotion->save();

       
        $notification = [
            'message' => 'Thêm mã khuyễn mãi thành công',
            'alert-type' => 'success',
        ];

        return redirect('admin/promotion')->with($notification);
        } else {
            $notification = [
                'message' => 'Thêm mã khuyễn mãi thất bại',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }
}
