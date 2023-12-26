<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact; 
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;



class ContactController extends Controller
{
    public function index(){
        $messages = Contact::all();
        return view('admin.contact.index',compact('messages'));
    }
    public function sendReplyEmail(Request $request)
    {
        // Validate input if needed
    
        $customerEmail = $request->customerEmail;
        $emailContent = $request->emailContent;
    
        // Gửi email
        // Mail::send(['text' => 'emails.test'], ['content' => $emailContent], function($email) use ($customerEmail) {
        //     $email->to($customerEmail, 'Bạch Xuân Hiếu')
        //           ->subject('Trả lời thắc mắc của khách hàng');
        // });
        Mail::send([], [], function($email) use ($customerEmail, $emailContent) {
            $email->to($customerEmail, 'Bạch Xuân Hiếu')
                  ->subject('Trả lời thắc mắc của khách hàng')
                  ->html($emailContent);
        });
        return response()->json(['success' => true]);
    }

    public function testmail(){
        $name = "Bạch Xuân Hiếu";
        Mail::send('emails.test',compact('name'), function($email){
            $email->to('chandoi19008198@gmail.com','Bạch Xuân Hiếu');
        });
    }
}
