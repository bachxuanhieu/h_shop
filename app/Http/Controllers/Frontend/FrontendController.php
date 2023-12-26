<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Property;
use App\Models\Subcategory;
use App\Models\Setting;
use App\Models\News;
use App\Models\Newscategory;
// use Illuminate\Pagination\Paginator;

class FrontendController extends Controller
{
    public function index(){
        $categories = Category::where('status','1')->get();
        $brands = Brand::where('status','1')->get();
        $sliders = Slider::where('status','1')->get();
        $setting = Setting::first();
        $product_trending = Product::where('trending', '1')->take(8)->get();

        $product_cosmetics = Product::where('status','1')->where('category_id','2')->get();

       

        $news = News::where('status','1')->get();
      
       return view('frontend.index',compact('categories','brands','product_trending','sliders','product_cosmetics','setting','news'));
    }

    public function searchProducts(Request $request)
    {
        
        $keyword = $request->input('keyword');
      
        if($request->keyword){
            $requestProducts = Product::where('name','LIKE','%'.$keyword.'%')->get();
            $categories = Category::where('status','1')->get();
            $brands = Brand::where('status','1')->get();
            $sliders = Slider::where('status','1')->get();
            $setting = Setting::first();
            return view('frontend.pages.search',compact('requestProducts','categories','brands','sliders','keyword','setting'));
           
        }else{

            $notification = [
                'message' => 'Không tìm thấy sản phẩm',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
           
        }
    }

    
    public function categoryPro($slug){
        $category = Category::where('status','1')->where('slug',$slug)->get();
        $categoryProducts = Product::where('status','1')->where('slug',$slug)->paginate(6);
        $categories = Category::where('status','1')->get();
        $brands = Brand::where('status','1')->get();
        $sliders = Slider::where('status','1')->get();
        $properties = Property::where('status','1')->get();
        $setting = Setting::first();
        return view('frontend.pages.categoryProduct',compact('categoryProducts','sliders','categories','brands','properties','setting','category'));
           
    }

    public function subPro($subId){
        $subcategory = Subcategory::where('status','1')->where('id',$subId)->get();
        $subProducts = Product::where('status','1')->where('subcategory_id',$subId)->get();
        $categories = Category::where('status','1')->get();
        $brands = Brand::where('status','1')->get();
        $sliders = Slider::where('status','1')->get();
        $properties = Property::where('status','1')->get();
        $setting = Setting::first();
        return view('frontend.pages.subProduct',compact('subProducts','sliders','categories','brands','subcategory','properties','setting'));
           
    }

    public function brandPro($brandId){
        $brand = Brand::where('status','1')->where('id',$brandId)->get();
        // $subProducts = Product::where('status','1')->where('subcategory_id',$subId)->get();
        $categories = Category::where('status','1')->get();
        $brands = Brand::where('status','1')->get();
        $sliders = Slider::where('status','1')->get();
        $properties = Property::where('status','1')->get();
        $brandProducts = Product::where('status','1')->where('brand_id',$brandId)->get();
        $setting = Setting::first();
        return view('frontend.pages.brandProduct',compact('brandProducts','sliders','categories','brands','brand','properties','setting'));
           
    }

    public function products(){
        $products = Product::where('status','1')->paginate(6);
        $categories = Category::where('status','1')->get();
        $brands = Brand::where('status','1')->get();
        $sliders = Slider::where('status','1')->get();
        $properties = Property::where('status','1')->get();
        $setting = Setting::first();
        return view('frontend.pages.products',compact('products','sliders','categories','brands','properties','setting'));
    }

    public function productView($productId){
        $product = Product::find($productId);
        $related_products = Product::where('status','1')->where('brand_id',$product->brand_id)->get();
        // dd($product);
        $categories = Category::where('status','1')->get();
        $brands = Brand::where('status','1')->get();
        $sliders = Slider::where('status','1')->get();
        $properties = Property::where('status','1')->get();
        $setting = Setting::first();
        return view('frontend.pages.productView',compact('product','sliders','categories','brands','properties','related_products','setting'));

    }

    public function contact(){
        $categories = Category::where('status','1')->get();
        $brands = Brand::where('status','1')->get();
        $sliders = Slider::where('status','1')->get();
      
        $setting = Setting::first();
        return view('frontend.pages.contact',compact('sliders','categories','brands','setting'));
    }

    public function filter_products(Request $request){
        $selectedPriceRanges = $request->input('selectedPriceRanges');
        $filteredProducts = Product::with('productImages')
        ->where(function ($query) use ($selectedPriceRanges) {
            foreach ($selectedPriceRanges as $range) {
                $query->orWhereBetween('selling_price', [$range['start'], $range['end']]);
            }
        })
        ->get();
        return response()->json($filteredProducts);
    }

    public function filterProducts(Request $request)
    {
        // Lấy dữ liệu từ request
        $selectedCapacities = $request->input('selectedCapacities');

        // Thực hiện logic lọc sản phẩm
        $filteredProducts = Product::with(['productProperties', 'productImages'])
        ->whereHas('productProperties', function ($query) use ($selectedCapacities) {
            $query->whereIn('property_id', $selectedCapacities);
        })
        ->get();

        // Trả về kết quả dưới dạng JSON
        return response()->json($filteredProducts);
    }

    public function news(){
        $categories = Category::where('status','1')->get();
        $brands = Brand::where('status','1')->get();
        $sliders = Slider::where('status','1')->get();
        $setting = Setting::first();
        $news = News::where('status','1')->get();
        $newscategory = Newscategory::where('status','1')->get();
        return view('frontend.pages.news',compact('categories','brands','sliders','setting','news','newscategory'));
    }
    public function ViewNew($id){
        $categories = Category::where('status','1')->get();
        $brands = Brand::where('status','1')->get();
        $sliders = Slider::where('status','1')->get();
        $setting = Setting::first();
        $new = News::find($id);
      
        return view('frontend.pages.ViewNew',compact('categories','brands','sliders','setting','new'));
    }
}
