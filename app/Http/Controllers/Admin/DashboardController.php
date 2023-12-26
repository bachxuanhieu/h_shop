<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\News;
class DashboardController extends Controller
{
    public function index(){
        $orderCount = Order::count();
        $productCount = Product::count();
        $userCount = User::count();
        $newCount = News::count();
        return view('admin.home',['orderCount'=>$orderCount,
                                'productCount'=>$productCount,
                                'userCount'=>$userCount,
                                'newCount'=>$newCount,
                            ]);
    }
}
