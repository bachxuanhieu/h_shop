<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Product;
class CommentController extends Controller
{
    public function cm_store(Request $request){
      
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:200'],
            'email' => ['required', 'string', 'max:200'],
            'content' => ['required', 'string'], // Thêm 'content' vào danh sách kiểm tra
        ]);
        $product_id = $request->product_id;
       
       
        if($validator->passes()){
            $product = Product::find($product_id);
            $comment = $product->productComments()->create([
                'name' => $request->name,
                'email' => $request->email,
                'content' => $request->content,
            ]);
            
            $response = [
                'status' => 'success',
                'message' => 'Đã để lại bình luận',
                'name' => $request->name,
                'email'  => $request->email,
                'content' => $request->content,
                'created_at' => $comment->created_at->format('Y-m-d H:i:s'),
            ];
    
            return response()->json($response);
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Bình luận thất bại',
            ];
    
            return response()->json($response);
        }
    }
    
}
