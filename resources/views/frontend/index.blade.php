@extends('layouts.index')

@section('title')
Trang chủ
@endsection

@section('content')
    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Sản phẩm chính hãng</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Miễn phí giao hàng</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14 ngày đổi trả</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Hỗ trợ 24/7</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->


  


    <!-- Offer Start -->
    <div class="container-fluid offer pt-5">
        <div class="row px-xl-5">
            @foreach ($categories as $category)
                <div class="col-md-6 pb-4">
                    <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                        <img src="{{asset('admin/image/category/'.$category->image)}}" width="100%"  height="100%">
                        <div class="position-relative" style="z-index: 1;">
                            <h5 class="text-uppercase text-primary mb-3">Khuyến mãi</h5>
                            <h1 class="mb-4">{{$category->name}}</h1>
                            <a href="{{url('/category/'.$category->slug)}}" class="btn btn-outline-primary py-md-2 px-md-3">Mua sắm ngay</a>
                        </div>
                    </div>
                </div>
            @endforeach
            
        </div>
    </div>
    <!-- Offer End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Sản phẩm thịnh hành</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            @foreach ($product_trending as $pro)
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                       
                        @if (isset($pro->productImages[0]))
                        <a href="{{url('/productView/'.$pro->id)}}"><img class="img-fluid w-100" src="{{asset($pro->productImages[0]->image)}}" alt="{{$pro->name}}"></a>
                        @else
                       không có hình ảnh
                       @endif
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{$pro->name}}</h6>
                        <div class="d-flex justify-content-center">
                            <h6>{{ number_format($pro->old_price)}}đ</h6><h6 class="text-muted ml-2"><del>{{ number_format($pro->selling_price)}}đ</del></h6>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
           
          
        </div>
    </div>
    <!-- Products End -->
  
  <!-- Categories Start -->
  <div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        @foreach ($categories as $category)
            
       
            @foreach ($category->subcategory as $sub)
                <div class="col-lg-3 col-md-6 pb-1">
                    <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                        <a  href="{{url('/product_sub/'.$sub->id)}}" class="cat-img position-relative overflow-hidden mb-3">
                            <img class="img" src="{{asset('admin/image/subcategory/'.$sub->image)}}" height="200px" alt="">
                        </a>
                        <h5 class="font-weight-semi-bold m-0">{{$sub->name}}</h5>
                    </div>
                </div>
            @endforeach

        @endforeach
       
        
    </div>
</div>
<!-- Categories End -->
  

    <!-- Products Start -->
    {{-- <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Mỹ phẩm</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            @foreach ($product_cosmetics as $pro)
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        @if (isset($pro->productImages[0]))
                        <a href="{{url('/productView/'.$pro->id)}}"><img class="img-fluid w-100" src="{{asset($pro->productImages[0]->image)}}" alt="{{$pro->name}}"></a>
                        @else
                       không có hình ảnh
                       @endif
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{$pro->name}}</h6>
                        <div class="d-flex justify-content-center">
                            <h6>{{$pro->old_price}}</h6><h6 class="text-muted ml-2"><del>{{$pro->selling_price}}</del></h6>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach    
           
        </div>
    </div> --}}
    <!-- Products End -->


    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Bài viết</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    @foreach ($news as $i)
                    <div class="vendor-item border p-4">
                        <a href="{{url('/news/'.$i->id)}}"><img src="{{asset('admin/image/news/'.$i->image)}}" width="200px" height="100px" alt=""></a>
                        <p>{{$i->name}}</p>
                    </div>
                    @endforeach
                   
                </div>
            </div>
        </div>
    </div>



@endsection