<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\NewscategoryController;
use App\Http\Controllers\Admin\NewController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PromotionController;
use Illuminate\Support\Facades\Route;

Auth::routes();


Route::controller(App\Http\Controllers\Frontend\FrontendController::class)->group(function () {


    Route::get('/','index');
    Route::get('/search','searchProducts');
    Route::get('/category/{slug}','categoryPro');
    Route::get('/product_sub/{sub_id}','subPro');
    Route::get('/product_brand/{brand_id}','brandPro');
    Route::get('/products','products');
    Route::get('/productView/{productId}','productView');
    Route::get('/contact','contact');
    Route::post('/filter-products','filter_products');
    Route::post('/filterProducts','filterProducts');
    Route::get('/news','news');
    Route::get('/news/{id}','ViewNew');


});

Route::controller(App\Http\Controllers\Frontend\CommentController::class)->group(function () {
    Route::post('/cm_store','cm_store');
});

Route::controller(App\Http\Controllers\Frontend\ContactController::class)->group(function () {
    Route::post('/SendMessage','SendMessage');
});

Route::controller(App\Http\Controllers\Frontend\OrderController::class)->group(function () {
    Route::get('/order','index');
    Route::get('/viewOrder/{id}','viewOrder');
    Route::post('/order/edit_info/{id}','edit_info');
    Route::delete('/order/{orderId}','deleteOrder');
    Route::post('/apply_discount','apply_discount');

});


Route::controller(App\Http\Controllers\Frontend\CartController::class)->group(function () {
    Route::get('/cart','cart_show');
    Route::post('/add_cart','add_cart');
    Route::post('/remove_item_cart','remove_item_cart');
    Route::post('/plus_quantity_cart','plus_quantity_cart');
  
});
Route::controller(App\Http\Controllers\Frontend\CheckoutController::class)->group(function () {
    Route::get('/checkout','index');
    Route::post('/checkout/getDistrict','getDistrict');
    Route::post('/checkout/getWards','getWards');
    Route::post('/checkout/Payment_upon_delivery','Payment_upon_delivery');   
    Route::post('/checkout/Pay_via_momo','Pay_via_momo');   
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [App\Http\Controllers\Admin\AdminController::class,'profile'])->name('admin.profile');
    Route::post('/profile/uploadProfile', [App\Http\Controllers\Admin\AdminController::class,'uploadProfile'])->name('admin.profile.uploadProfile');
    Route::get('/change_password', [App\Http\Controllers\Admin\AdminController::class,'ChangePassword'])->name('admin.change.password');
    Route::post('/update_password', [App\Http\Controllers\Admin\AdminController::class,'UpdatePassword'])->name('admin.update.password');

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('admin.category');
        Route::get('/category/create', 'create')->name('admin.category.create');
        Route::post('/category', 'store')->name('admin.category.store');
        Route::get('/category/edit/{categoryId}', 'edit')->name('admin.category.edit');
        Route::put('/category/{categoryId}', 'update')->name('admin.category.update');
        Route::delete('/category/{categoryId}','delete')->name('admin.category.delete');
       
    });

    Route::controller(SubcategoryController::class)->group(function () {
        Route::get('/subcategory', 'index')->name('admin.subcategory');
        Route::get('/subcategory/create', 'create')->name('admin.subcategory.create');
        Route::post('/subcategory', 'store')->name('admin.subcategory.store');
        Route::get('/subcategory/edit/{subId}', 'edit')->name('admin.subcategory.edit');
        Route::put('/subcategory/{subId}', 'update')->name('admin.subcategory.update');
        Route::delete('/subcategory/{subId}','delete')->name('admin.subcategory.delete');

    });

    
    Route::controller(BrandController::class)->group(function () {
        Route::get('/brand', 'index')->name('admin.brand');
        Route::get('/brand/create', 'create')->name('admin.brand.create');
        Route::post('/brand', 'store')->name('admin.brand.store');
        Route::get('/brand/edit/{brandId}', 'edit')->name('admin.brand.edit');
        Route::put('/brand/{brandId}', 'update')->name('admin.brand.update');
        Route::delete('/brand/{brandId}','delete')->name('admin.brand.delete');

    });

    Route::controller(PropertyController::class)->group(function () {
        Route::get('/property', 'index')->name('admin.property');
        // Route::get('/brand/create', 'create')->name('admin.brand.create');
        Route::post('/property', 'store')->name('admin.property.store');
        // Route::get('/brand/edit/{brandId}', 'edit')->name('admin.brand.edit');
        // Route::put('/brand/{brandId}', 'update')->name('admin.brand.update');
        // Route::delete('/brand/{brandId}','delete')->name('admin.brand.delete');
    });


      
    Route::controller(ProductController::class)->group(function () {
        Route::get('/product', 'index')->name('admin.product');
        Route::get('/product/create', 'create')->name('admin.product.create');
        Route::get('/product/getSubcategory/{category_id}', 'getSubcategory')->name('admin.product.getSubcategory');
        Route::post('/product', 'store')->name('admin.product.store');
        Route::get('/product/edit/{productId}', 'edit')->name('admin.product.edit');

        Route::post('product/addPropertyProduct/{product_id}','addPropertyProduct');
        Route::post('product/deletePropertyProduct/{id}','deletePropertyProduct');
        Route::put('/product/{productId}', 'update')->name('admin.product.update');

        Route::post('/product-property/{id}','update_property');


        Route::delete('/product/{productId}','delete')->name('admin.product.delete');

    });


      // sliders
      Route::controller(SliderController::class)->group(function () {
        Route::get('/sliders', 'index');
        Route::get('/sliders/create', 'create');
        Route::post('/sliders', 'store');
        // Route::get('/sliders/{slider}/edit','edit');
        // Route::put('/sliders/{slider}','update');
        // Route::get('sliders/{slider}/delete','destroy');

    });
    Route::controller(OrderController::class)->group(function () {
        Route::get('/order', 'index');
        Route::get('/viewOrder/{order_id}', 'viewOrder');
        Route::post('/order_confirmation/{id}', 'Order_confirmation');
        Route::post('/filterOrdersByDate', 'filterOrdersByDate');
        

    });


    Route::controller(SettingController::class)->group(function () {
        Route::get('/setting', 'index');
        Route::get('/setting/create', 'create');
        Route::post('/setting', 'store');
    });

    Route::controller(NewscategoryController::class)->group(function () {
        Route::get('/newscategory', 'index');
        Route::get('/newscategory/create', 'create');
        Route::post('/newscategory', 'store');
    });

    Route::controller(NewController::class)->group(function () {
        Route::get('/news', 'index');
        Route::get('/news/create', 'create');
        Route::post('/news', 'store');
       
    });

    Route::controller(ContactController::class)->group(function () {
        Route::get('/contact', 'index');
        Route::post('/send-reply-email', 'sendReplyEmail');
        Route::get('/test-mail','testmail');
       
       
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index');
      
    });

    Route::controller(PromotionController::class)->group(function () {
        Route::get('/promotion', 'index');
        Route::get('/promotion/create', 'create');
        Route::post('/promotion', 'store');
    });





});