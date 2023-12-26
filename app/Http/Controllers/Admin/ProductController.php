<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductProperty;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Property;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
class ProductController extends Controller
{
    public function index(){
        $products = Product::orderBy("id","desc")->get();
        return view("admin.product.index",compact("products"));
    }

    public function create(){
        $categories = Category::where('status','1')->get();
        $brands = Brand::where('status','1')->get();
        $properties = Property::where('status','1')->get();
        return view("admin.product.create",compact("categories",'brands','properties'));
    }


    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:200'],
            // 'slug' => ['required', 'string', 'max:200'],
            // 'category_id'=> ['required', 'integer'],
            // 'brand_id'=> ['required', 'integer'],
            // 'small_desc'=> ['required','string'],
            // 'desc'=> ['required','string'],
            // 'old_price'=>['required']
        ]);
        if($validator->passes()){
            $category = Category::findOrFail($request->input('category_id'));
            $product = $category->product()->create([
                'name'=> $request->name,
                'slug'=> $request->slug,
                'category_id'=>$request->category_id,
                'brand_id'=>$request->brand_id,
                'subcategory_id'=>$request->subcategory_id,
                'small_desc'=>$request->small_desc,
                'desc'=>$request->desc,
                'old_price'=>$request->old_price,
                'selling_price'=>$request->selling_price,
                'trending'=>$request->trending,
                'status'=>$request->status,
            ]);
            if ($request->hasFile('image'))
            {
            $uploadPath='admin/products/';
                $i=1;
            foreach($request->file('image') as $imageFile)
            {
                $extention = $imageFile->getClientOriginalExtension();
                $filename = time().$i++.'.'.$extention;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath.$filename;
                $product -> productImages()->create([
                    'product_id'=>$product->id,
                    'image' => $finalImagePathName,
                ]);
            }
            }
            if($request->has('properties')) {
                foreach($request->properties as $property) {
                    if(isset($request->propertyQuantity[$property]) && isset($request->price_product[$property])) {
                        $productProperty=$product->productProperties()->create([
                            'product_id' => $product->id,
                            'property_id' => $property,
                            'quantity' => $request->propertyQuantity[$property],
                            'price_product' => $request->price_product[$property],
                        ]);
                        if ($request->hasFile('images.' . $property)) {
                            $image = $request->file('images.' . $property);
                            $imageName = 'property_' . $property . '_' . time() . '.' . $image->getClientOriginalExtension();
                            
                            // Lưu ảnh trong thư mục public/images (hoặc thay đổi đường dẫn theo ý muốn)
                            $image->move(public_path('admin/products/'), $imageName);
            
                            // Lưu tên ảnh vào cơ sở dữ liệu
                            $productProperty->update(['image' => $imageName]);
                        }
                    }
                }
            }
            
            $notification = [
                'message' => 'Thêm sản phẩm thành công',
                'alert-type' => 'success',
            ];
    
            return redirect('admin/product')->with($notification);
            // dd($request->all()) ;
          
        }else{
            $notification = [
                'message' => 'Thêm sản phẩm thất bại',
                'alert-type' => 'error',
            ];
    
            return redirect()->back()->with($notification);
         
        }
    }

    public function getSubcategory($category_id){
        $subcategory = Subcategory::where('category_id',$category_id)->get();
        if ($subcategory) {
            header('Content-Type: application/json');
            echo json_encode($subcategory);
        } else {
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'Không có nhãn hàng được cung cấp.'));
        }
    }

    public function edit($productId){
        $categories = Category::where('status','1')->get();
        $brands = Brand::where('status','1')->get();
        $product = Product::find($productId);

        $properties = Property::where('status','1')->get();
        
        return view('admin.product.edit',compact('product','categories','brands','properties'));
    }


    public function deletePropertyProduct($id){
        $propertyProduct = ProductProperty::find($id);
        $propertyProduct->delete();
        if ($propertyProduct) {  
            $reponse=[
                'success'=>'true'
            ];
        }else {
            $reponse=[
                'success'=>'error'
            ];
        }
        echo json_encode($reponse);

    }

    public function addPropertyProduct(Request $request, $product_id){
        $product = Product::find($product_id);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = 'property_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/products/'),$filename);
            $product->productProperties()->create([
                'property_id' =>  $request->property_id,
                'quantity' => $request->quantity,// Chỉnh sửa thành 'quantity' thay vì 'quanlity'
                'price_product' => $request->price_product,
                'image'=>$filename
            ]);
        }
       
        return response()->json(['success' => true]);
       
    }

    public function update_property(Request $request, $id){
        $productProperty = Product::findOrFail($request->product_id)
            ->productProperties()->where('id', $id)->first();
        if ($productProperty) {
            if($request->hasFile('image')){
                // Kiểm tra và xóa hình ảnh cũ
                if ($productProperty->image) {
                    $oldImagePath = public_path('admin/products/' . $productProperty->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $file = $request->file('image');
                $filename = 'property_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('admin/products/'),$filename);
                $productProperty->update([
                    'quantity' => $request->quantity,// Chỉnh sửa thành 'quantity' thay vì 'quanlity'
                    'price_product' => $request->price_product,
                    'image'=>$filename
                ]);
            }


            $productProperty->update([
                'quantity' => $request->quantity,// Chỉnh sửa thành 'quantity' thay vì 'quanlity'
                'price_product' => $request->price_product,
            ]);
    
            return response()->json(['message' => 'Cập nhật thành công']);
        } else {
            // Xử lý nếu không tìm thấy dữ liệu
            return response()->json(['message' => 'Cập nhật thất bại'], 404);
        }

    }

    public function update(Request $request, $product_id){

        $product = Category::findOrFail($request->category_id)
            ->product()->where('id', $product_id)->first();
            // echo($request->category_id);
            // dd($product);
        if ($product) {
            if ($request->hasFile('image')) {
                foreach ($product->productImages as $oldImage) {
                    unlink(public_path($oldImage->image));
                    $oldImage->delete();
                }
            }
    
            // Cập nhật thông tin sản phẩm
            $product->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'subcategory_id' => $request->subcategory_id,
                'small_desc' => $request->small_desc,
                'desc' => $request->desc,
                'old_price' => $request->old_price,
                'selling_price' => $request->selling_price,
                'trending' => $request->trending,
                'status' => $request->status,
            ]);
    
            // Thêm ảnh mới
            if ($request->hasFile('image')) {
                $uploadPath = 'uploads/products/';
                $i = 1;
                foreach ($request->file('image') as $imageFile) {
                    $extention = $imageFile->getClientOriginalExtension();
                    $filename = time() . $i++ . '.' . $extention;
                    $imageFile->move($uploadPath, $filename);
                    $finalImagePathName = $uploadPath . $filename;
                    $product->productImages()->create([
                        'product_id' => $product->id,
                        'image' => $finalImagePathName,
                    ]);
                }
            }
            $notification = [
                'message' => 'Chỉnh sửa sản phẩm thành công',
                'alert-type' => 'success',
            ];
    
            return redirect('admin/product')->with($notification);
        }else{
            $notification = [
                'message' => 'Chỉnh sửa sản phẩm thất bại',
                'alert-type' => 'error',
            ];
        
            return redirect()->back()->with($notification);
        }
    
       
    }
    
    public function delete($productId){
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Không tìm thấy danh mục'], 404);
        }
        // xóa hình
        if($product->productImages){
            foreach($product->productImages as $image){
                if(File::exists($image->image)){
                    File::delete($image->image);
                }
            }
        }
        $product->delete();
    
        return response()->json(['message' => 'Xóa sản phẩm thành công'], 200);
    }

}
