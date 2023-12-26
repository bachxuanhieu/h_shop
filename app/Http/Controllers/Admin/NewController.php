<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newscategory;
use App\Models\News;
use Illuminate\Support\Facades\Validator;


class NewController extends Controller
{
    public function index(){
        $news = News::all();
        return view('admin.new.index',compact('news'));
    }
    public function create(){
        $newscategory = Newscategory::all();
        return view('admin.new.create',compact('newscategory'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:200'],
        ]);
        if($validator->passes()){
            $newscategory = Newscategory::findOrFail($request->input('newscategory_id'));
            $new = $newscategory->new()->create([
                'name'=> $request->name,
                'desc'=> $request->desc,
                'newscategory_id'=>$request->newscategory_id,
                'author'=>$request->author,
                'status'=>$request->status,
            ]);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = date('YmdHi').'.'.$file->getClientOriginalExtension();
                $file->move(public_path('admin/image/news'), $filename);
                $new->image = $filename;
            }
            $new->save();
            $notification = [
                'message' => 'Thêm bài viết thành công',
                'alert-type' => 'success',
            ];
    
            return redirect('admin/news')->with($notification);
            // dd($request->all()) ;
          
        }else{
            $notification = [
                'message' => 'Thêm bài viết thất bại',
                'alert-type' => 'error',
            ];
    
            return redirect()->back()->with($notification);
         
        }
    }
}
