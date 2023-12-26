@extends('layouts.index')
@section('title')
     {{$product->name}}
@endsection

@section('content')
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Chi tiết sản phẩm</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{url('/')}}">Trang chủ</a></p>
           
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Shop Detail Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col-lg-6 pb-5">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner border">
                    @php
                        $i=""
                    @endphp
                    @foreach ($product->productImages as $proImage)
                        <div class="carousel-item active{{$i}}">
                            <img class="w-100 h-100" src="{{asset($proImage->image)}}" alt="Image">
                        </div>
                        @php
                             $i="1"
                        @endphp
                    @endforeach 
                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
            </div>

           
           
        </div>

        <div class="col-lg-6 pb-5">
            <h3 class="font-weight-semi-bold">{{$product->name}}</h3>
            <div class="d-flex mb-3">
                <div class="text-primary mr-2">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star-half-alt"></small>
                    <small class="far fa-star"></small>
                </div>
                <small class="pt-1">({{ count($product->productComments) }} Bình luận) </small>
            </div>
            <h3 id="displayedPrice" class="font-weight-semi-bold mb-4">{{ number_format($product->selling_price, 0, '.', ',') }}Đ</h3>
            <p class="mb-4">{!!$product->small_desc!!}</p>
            <div class="d-flex mb-3">
                <p class="text-dark font-weight-medium mb-0 mr-3">Dung tích:</p>
                <form>
                    @foreach ($product->productProperties as $productProperty)
                        @if($productProperty->quantity == 0)
                            <button class="btn btn-danger btn-sm">
                                {{$productProperty->property->name}}
                                <p>
                                    <span style="color: white">
                                    Đã hết hàng
                                    </span>
                                </p>
                            </button>
                        @else
                        <button class="btn btn-secondary btn-sm change-image-btn" 
                                data-image_product="{{ asset('admin/products/'.$productProperty->image) }}"
                                data-price="{{ $productProperty->price_product }}"
                                data-property_id="{{$productProperty->property_id}}">
                                {{ $productProperty->property->name }} <br>
                                <p>{{ number_format($productProperty->price_product) }} Đ</p>
                                <img src="{{ asset('admin/products/'.$productProperty->image) }}" height="100px" width="100px" alt="">
                        </button>

                        @endif
                      
                   
                   
                    
                    @endforeach
                </form>
            </div>
            <div class="d-flex align-items-center mb-4 pt-2">
                <button class="btn btn-primary px-3 add_to_cart" data-product_name="{{$product->name}}" data-product_id="{{$product->id}}"><i class="fa fa-shopping-cart mr-1"></i> Thêm giở hàng</button>
            </div>
            <div class="d-flex pt-2">
                <p class="text-dark font-weight-medium mb-0 mr-2">Gọi điện đặt hàng trực tiếp: 081.566.3667</p>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Miêu tả chi tiết</a>
                {{-- <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Information</a> --}}
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Bình luận ({{ count($product->productComments) }})</a>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <h4 class="mb-3">Đặc điểm nổi bật</h4>
                    <p>{!!$product->desc!!}</p>
                </div>
                <div class="tab-pane fade" id="tab-pane-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4">Bình luận của khách hàng về sản phẩm:</h4>
                            @foreach ($product->productComments as $pro_cm)
                                <div class="media mb-4">    
                                    <div class="media-body" id="media_body">
                                        <h6>{{$pro_cm->name}}<small> - <i>{{$pro_cm->created_at}}</i></small></h6>
                                        <div class="text-primary mb-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <p>{{$pro_cm->content}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex my-3">
                                <p class="mb-0 mr-2">Đánh giá sao * :</p>
                                <div class="text-primary">
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <form id="form_comment" method="POST">
                                <div class="form-group">
                                    <label for="content">Bình luận *</label>
                                    <textarea id="content" cols="30" rows="5" class="form-control" required></textarea>
                                </div>
                                <div>
                                    <input type="hidden" id="product_id" value="{{$product->id}}">
                                </div>
                                <div class="form-group">
                                    <label for="username">Tên hiện thị *</label>
                                    <input type="text" class="form-control" id="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" class="form-control" id="email" required>
                                </div>
                                
                                <div class="form-group mb-0">
                                    <button type="button" id="form_comment_btn" class="btn btn-primary px-3">Để lại bình luận</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->


<!-- Products Start -->
<div class="container-fluid py-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Sản phẩm liên quan</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                @foreach ($related_products as $pro)
                <div class="card product-item border-0">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <a href="{{url('/productView/'.$pro->id)}}"><img class="img-fluid w-100" src="{{asset($pro->productImages[0]->image)}}" alt="{{$pro->name}}"></a>
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{$pro->name}}</h6>
                        <div class="d-flex justify-content-center">
                            <h6>{{$pro->old_price}}</h6><h6 class="text-muted ml-2"><del>{{$pro->selling_price}}</del></h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                       
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>
    </div>
</div>

@endsection


@section('push_js') 

<script>
   $(document).ready(function() {
    var selectedPropertyId = null;
    var defaultPrice = {{ $product->selling_price }};
    var newPrice; // Thêm dòng này để khai báo biến newPrice ở phạm vi toàn cục


    $('#form_comment_btn').on('click', function() {
        var content = $('#content').val();
        var product_id = $('#product_id').val();
        var name = $('#name').val();
        var email = $('#email').val();

        // Kiểm tra dữ liệu hợp lệ trước khi gửi AJAX request
        if (!content || !product_id || !name || !email) {
            alert('Vui lòng nhập đầy đủ thông tin.');
            return;
        }

        var data = {
            content: content,
            product_id: product_id,
            name: name,
            email: email,
        };
        console.log(data);

        $.ajax({
            type: 'POST',
            url: '/cm_store',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function(response) {
                if (response.status === "success") {
                    var commentHtml = '<h6>' + response.name + '<small> - <i>' + response.created_at + '</i></small></h6>' +
                        '<div class="text-primary mb-2">' +
                        '<i class="fas fa-star"></i>' +
                        '<i class="fas fa-star"></i>' +
                        '<i class="fas fa-star"></i>' +
                        '<i class="fas fa-star"></i>' +
                        '<i class="fas fa-star-half-alt"></i>' +
                        '<i class="far fa-star"></i>' +
                        '</div>' +
                        '<p>' + response.content + '</p>' +
                        '</span></p></li>';
                    $('#media_body').append(commentHtml);
                    // Xóa nội dung biểu mẫu
                    $('#content').val('');
                    $('#product_id').val('');
                    $('#name').val('');
                    $('#email').val('');

                    alert(response.message);
                } else {
                    alert('lỗi.');
                }
            },
            error: function() {
                alert('Có lỗi xảy ra khi gửi bình luận.');
            }
        });
    });

    
    $('#displayedPrice').text(numberWithCommas(defaultPrice) + 'Đ');

    $('.change-image-btn').on('click', function (e) {
        e.preventDefault();
        var imageSrc = $(this).data('image_product');
        $('#product-carousel .carousel-inner').html('<div class="carousel-item active"><img class="w-100 h-100" src="' + imageSrc + '" alt="Image"></div>');
        newPrice = $(this).data('price'); // Loại bỏ từ khóa var để gán giá trị cho biến newPrice
        $('#displayedPrice').text(numberWithCommas(newPrice) + 'Đ');
        selectedPropertyId = $(this).data('property_id');
    });

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    // xu ly them gio hang ==========================================================================

    $('.add_to_cart').on('click', function () {
        if (selectedPropertyId === null) {
            alert('Bạn chưa chọn dung tích sản phẩm');
        } else {
            var product_name = $(this).data('product_name');
            var product_id = $(this).data("product_id");
            var property_id = selectedPropertyId;
            var price_product = newPrice;
            // var product_image = $(this).data('image');
            console.log(product_id);
            console.log(property_id);
            console.log(price_product);
            console.log(product_name);
            // console.log('Image URL:', $(this).data('image_product'));
            
           
            $.ajax({
                type:"POST",
                url: "/add_cart",
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    product_id: product_id,
                    property_id: property_id,
                    price_product: price_product,
                    product_name: product_name,
                },
                success: function (response) {
                    alert('Sản phẩm đã được thêm vào giỏ hàng!');
                }, 
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Có lỗi xảy ra khi thêm vào giỏ hàng.');
                }
                
            })
        }
    });





});

</script>

@endsection