<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Slider;
use App\Models\Setting;
use App\Models\ProductProperty;
use App\Models\Promotion;
class CheckoutController extends Controller
{
    public function index(){
        $categories = Category::where('status','1')->get();
        $brands = Brand::where('status','1')->get();
        $provinces = Province::all();
        $sliders = Slider::where('status','1')->get();
        $cart = session()->get('cart', []);
        $setting = Setting::first();
        return view('frontend.pages.checkout',compact('categories','brands','sliders','provinces','cart','setting'));
    }
    public function getDistrict(Request $request)
    {
        $province_id = $request->province_id;
        $districts = District::where('province_id',$province_id)->get();
        if ($districts) {
            header('Content-Type: application/json');
            echo json_encode($districts);
        } else {
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'Không có province_id được cung cấp.'));
        }
    }

    public function getWards(Request $request)
    {
        $district_id = $request->district_id;
        $wards = Ward::where('district_id',$district_id)->get();
        if ($wards) {
            header('Content-Type: application/json');
            echo json_encode($wards);
        } else {
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'Không có province_id được cung cấp.'));
        }
    }

    public function Payment_upon_delivery(Request $request) {
        if (auth()->check()) {
            $user_id = auth()->user()->id;
        } else {
            return response()->json(['success' => true,'message' => 'Bạn hãy đăng nhập trước để dễ dàng quản lý đơn hàng']);
        }
    
        $order = new Order();
        $order->user_id = $user_id;
        $order->fullname = $request->fullname;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->code = mt_rand(1000, 9999);
        $order->status = "Đang chờ xử lý";
        $order->payment_mode = "Thanh toán khi nhận hàng";
        $order->save();
    
        $cart = session()->get('cart', []);
    
        foreach ($cart as $item) {
           
                $order_item = $order->orderItems()->create([
                'product_id' => $item['product_id'],
                'property_id' => $item['property_id'],
                'quanlity' => $item['quantity'],
                'price' => $item['price_product'],
                'image' => $item['product_image'],
            ]);
        $this->decrementProductPropertyQuantity($item['product_id'], $item['property_id'], $item['quantity']);
        }
        session()->forget('cart');
        return response()->json(['success' => true,'message' => 'Bạn đã đặt hàng thành công']);
    }
    protected function decrementProductPropertyQuantity($product_id, $property_id, $quantity) {
        $productProperty = ProductProperty::where('product_id', $product_id)
            ->where('property_id', $property_id)
            ->first();
    
        if ($productProperty) {
            // Trừ đi số lượng
            $newQuantity = max(0, $productProperty->quantity - $quantity);
            $productProperty->update(['quantity' => $newQuantity]);
        }
    }


    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function Pay_via_momo(Request $request){
        if (auth()->check()) {
            $user_id = auth()->user()->id;
        } else {
            return response()->json(['success' => true,'message' => 'Bạn hãy đăng nhập trước để dễ dàng quản lý đơn hàng']);
        }

        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $i){
            $total += $i['quantity'] * $i['price_product'];
        }
       
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

            $orderInfo = "Thanh toán qua MoMo";
            $amount = "10000";
            $orderId = rand(0, 9999);
            $redirectUrl = "http://127.0.0.1:8000/checkout";
            $ipnUrl = "http://127.0.0.1:8000/checkout";
            $extraData = "";
                $partnerCode = $partnerCode;
                $accessKey = $accessKey;
                $serectkey = $secretKey;
                $orderId = $orderId; // Mã đơn hàng
                $orderInfo = $orderInfo;
                $amount = $total;
                $ipnUrl = $ipnUrl;
                $redirectUrl = $redirectUrl;
                $extraData = $extraData;

                $requestId = time() . "";
                $requestType = "payWithATM";
                // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
                //before sign HMAC SHA256 signature
                $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                $signature = hash_hmac("sha256", $rawHash, $serectkey);
                $data = array(
                    'partnerCode' => $partnerCode,
                    'partnerName' => "Test",
                    "storeId" => "MomoTestStore",
                    'requestId' => $requestId,
                    'amount' => $amount,
                    'orderId' => $orderId,
                    'orderInfo' => $orderInfo,
                    'redirectUrl' => $redirectUrl,
                    'ipnUrl' => $ipnUrl,
                    'lang' => 'vi',
                    'extraData' => $extraData,
                    'requestType' => $requestType,
                    'signature' => $signature
                );

                $order = new Order();
                $order->user_id = $user_id;
                $order->fullname = $request->fullname;
                $order->email = $request->email;
                $order->phone = $request->phone;
                $order->address = $request->address;
                $order->code = mt_rand(1000, 9999);
                $order->status = "Đang chờ xử lý";
                $order->payment_mode = "Thanh toán qua MOMO";
                $order->save(); // Lưu đơn hàng để có thể có ID
            
                $cart = session()->get('cart', []);
            
                foreach ($cart as $item) {
                    // Không cần phải gán 'order_id' ở đây
                        $order_item = $order->orderItems()->create([
                        'product_id' => $item['product_id'],
                        'property_id' => $item['property_id'],
                        'quanlity' => $item['quantity'],
                        'price' => $item['price_product'],
                        'image' => $item['product_image'],
                    ]);
                $this->decrementProductPropertyQuantity($item['product_id'], $item['property_id'], $item['quantity']);
                }
                session()->forget('cart');

              
                $result =$this->execPostRequest($endpoint, json_encode($data));
                $jsonResult = json_decode($result, true);  // decode json
            
                //Just a example, please check more in there
            
                if (isset($jsonResult['payUrl'])) {
                    return response()->json(['success' => true, 'payUrl' => $jsonResult['payUrl']]);
                } else {
                    return response()->json(['success' => false, 'message' => 'Không có payUrl trong kết quả từ Momo']);
                }

        
    }

    public function apply_discount(Request $request)
    {
        $Code = $request->input('Code');

        // Kiểm tra xem mã giảm giá có tồn tại không
        $promotion = Promotion::where('code', $Code)->first();

        if (!$promotion) {
            return response()->json(['success' => false, 'message' => 'Mã giảm giá không tồn tại']);
        }

        if ($promotion->expiration_date && now() > $promotion->expiration_date) {
            return response()->json(['success' => false, 'message' => 'Mã giảm giá đã hết hạn']);
        }

        $discountPercentage = $promotion->discount_percentage;
        // Xử lý mã giảm giá, ví dụ: lấy giảm giá dạng phần trăm
    
        return response()->json(['success' => true, 'message' => 'Mã giảm giá áp dụng thành công', 'discount_percentage' => $discountPercentage]);
    }


    
    
}
