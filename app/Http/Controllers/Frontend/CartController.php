<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\ProductProperty;


class CartController extends Controller
{
    public function cart_show(){
        $categories = Category::where('status','1')->get();
        $brands = Brand::where('status','1')->get();

        $cart = session()->get('cart', []);
        $sliders = Slider::where('status','1')->get();
        // dd($cart);
        $setting = Setting::first();
        return view('frontend.pages.cart',compact('categories','brands','cart','sliders','setting'));
    }


    public function add_cart(Request $request){
        $product_id = $request->product_id;
        $property_id = $request->property_id;
        $price_product = $request->price_product;
        $product_name = $request->product_name;
       

        $product_property = ProductProperty::where('product_id', $product_id)
        ->where('property_id', $property_id)
        ->first();
    
        $product_image = $product_property->image;        
       

        $cart = session()->get('cart', []);

        // Generate a unique key for the product in the cart
        $cartKey = $product_id . '_' . $property_id;

        // Check if the product is already in the cart
        if (array_key_exists($cartKey, $cart)) {
            // If yes, update the quantity or other information as needed
            $cart[$cartKey]['quantity'] += 1; // Example: Increase the quantity by 1
        } else {
            // If no, add the product to the cart
            $cart[$cartKey] = [
                'product_id' => $product_id,
                'property_id' => $property_id,
                'price_product' => $price_product,
                'product_name' => $product_name,
                'product_image' => $product_image,
                'quantity' => 1, // Initial quantity
            ];
        }

        // Store the updated cart back in the session
        session()->put('cart', $cart);

        return response()->json(['success' => true]);
    }

    public function remove_item_cart(Request $request){
        $product_id = $request->product_id;
        $property_id = $request->property_id;
        $cart = session()->get('cart', []);
    
        // Tạo khóa duy nhất cho sản phẩm trong giỏ hàng
        $cartKey = $product_id . '_' . $property_id;
    
        if (array_key_exists($cartKey, $cart)) {
            // Nếu có, xóa sản phẩm khỏi giỏ hàng
            unset($cart[$cartKey]);
             // Cập nhật giỏ hàng trong session
            session()->put('cart', $cart);

            $updatedTotalAmount  = 0;
            foreach($cart as $item){
                $updatedTotalAmount += $item['price_product'] * $item['quantity'];
            }
            return response()->json(['success' => true,  'updated_total_amount' => $updatedTotalAmount]);
        }
        return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng.']);
    }

    public function plus_quantity_cart(Request $request)
{
    $product_id = $request->product_id;
    $property_id = $request->property_id;
    $quantity = $request->quantity;

    $product_property = ProductProperty::where('product_id', $product_id)
    ->where('property_id', $property_id)
    ->first();

    $product_quantity = $product_property->quantity;    


    $cart = session()->get('cart', []);

    // Create a unique key for the product in the cart
    $cartKey = $product_id . '_' . $property_id;

    if (array_key_exists($cartKey, $cart)) {
        // If the product is in the cart, update the quantity
        if($quantity >  $product_quantity){
            return response()->json(['success' => true, 'message' => 'sản phẩm đã hết hàng']);
        }else{
            $cart[$cartKey]['quantity'] = $quantity;
            // Update the cart in the session
            session()->put('cart', $cart);
            $updatedTotalAmount  = 0;
            foreach($cart as $item){
                $updatedTotalAmount += $item['price_product'] * $item['quantity'];
            }
            return response()->json(['success' => true,  'updated_total_amount' => $updatedTotalAmount]);
        }
       
    }

    return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng.']);
}


   
  
    

}
