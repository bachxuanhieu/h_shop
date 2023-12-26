<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function SendMessage(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:200'],
            'email' => ['required', 'string', 'max:200'],
            'message' => ['required', 'string'], // Thêm 'content' vào danh sách kiểm tra
        ]);       
       
        if($validator->passes()){
            $message = new Contact();
            $message->name = $request->name;
            $message->email = $request->email;
            $message->message = $request->message;
           
            $message->save();
            $response = [
                'status' => 'success',
                'message' => 'Bình luận thành công',
            ];
    
 
    
            return response()->json($response);
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Bình luận thất bại',
                'errors' => $validator->errors(),
            ];
            return response()->json($response);
        }
    }
}
