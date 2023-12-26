@extends('layouts.index')
@section('title')
 @foreach ($brand as $bra)
     {{$bra->name}}
 @endforeach

@endsection

@section('content')

<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        @foreach ($brand as $bra)
        <h1 class="font-weight-semi-bold text-uppercase mb-3">{{$bra->name}}</h1>
        @endforeach
        
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Shop</p>
        </div>
    </div>
</div>

<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        @include('layouts.inc.frontend.sidebar')
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12">
            <div class="row pb-3" id="productList">
                
                @foreach ($brandProducts as $pro)
                    
                <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
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
        </div>
        <!-- Shop Product End -->
    </div>
</div>

@endsection


@section('push_js')

<script>
$(document).ready(function () {
    var selectedPriceRanges = [];

    $('.price-checkbox').on('change', function () {
        var startPrice = parseFloat($(this).data('start'));
        var endPrice = parseFloat($(this).data('end'));

        if ($(this).prop('checked')) {
            selectedPriceRanges.push({ start: startPrice, end: endPrice });
        } else {
            selectedPriceRanges = selectedPriceRanges.filter(function (range) {
                return !(range.start === startPrice && range.end === endPrice);
            });
        }
        filterProducts(selectedPriceRanges);
    });

    function filterProducts(selectedPriceRanges) {
      
        $.ajax({
            url: '/filter-products', 
            type: 'POST',
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                selectedPriceRanges: selectedPriceRanges
            },
            success: function (data) {
                console.log();
                $('#productList').empty();
                if (Array.isArray(data) && data.length > 0) {
                    $.each(data, function (index, product) {
                        displayProduct(product);
                    });
                } else {
                    console.log('Không có sản phẩm.');
                }
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }

    function displayProduct(product) {
        var productHtml = '<div class="col-lg-4 col-md-6 col-sm-12 pb-1">';
        productHtml += '<div class="card product-item border-0 mb-4">';
        productHtml += '<div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">';
        
        // Kiểm tra xem sản phẩm có hình ảnh hay không
        if (product.product_images && product.product_images.length > 0) {
            productHtml += '<a href="/productView/' + product.id + '"><img class="img-fluid w-100" src="/' + product.product_images[0].image + '" alt="' + product.name + '"></a>';
        } else {
            productHtml += 'Không có hình ảnh';
        }
        
        productHtml += '</div>';
        productHtml += '<div class="card-body border-left border-right text-center p-0 pt-4 pb-3">';
        productHtml += '<h6 class="text-truncate mb-3">' + product.name + '</h6>';
        productHtml += '<div class="d-flex justify-content-center">';
        productHtml += '<h6>' + product.old_price + '</h6><h6 class="text-muted ml-2"><del>' + product.selling_price + '</del></h6>';
        productHtml += '</div>';
        productHtml += '</div>';
      
        productHtml += '</div>';
        productHtml += '</div>';
        
        $('#productList').append(productHtml);
    }

    $('.capacity-checkbox').change(function () {
        // Lấy giá trị của các checkbox được chọn
        var selectedCapacities = [];
        $('.capacity-checkbox:checked').each(function () {
            selectedCapacities.push($(this).val());
        });

        // Thực hiện Ajax request để lọc sản phẩm
        $.ajax({
            url: '/filterProducts', // Đặt URL tương ứng với route của bạn
            type: 'POST',
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                selectedCapacities: selectedCapacities
            },
            success: function (data) {
                console.log();
                $('#productList').empty();
                if (Array.isArray(data) && data.length > 0) {
                    $.each(data, function (index, product) {
                        displayProduct(product);
                    });
                } else {
                    console.log('Không có sản phẩm.');
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

});

</script>

@endsection