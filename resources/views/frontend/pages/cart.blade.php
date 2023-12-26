@extends('layouts.index')
@section('title')
 Giỏ hàng

@endsection

@section('content')

<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Giỏ hàng</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{url('/')}}">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Giỏ hàng</p>
        </div>
    </div>
</div>
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @php
                        $totalAmount = 0; 
                    @endphp
                    @foreach ($cart as $item)
                        <tr>
                            <td class="align-middle"><img src="{{ asset('admin/products/'.$item['product_image']) }}" alt="" style="width: 50px;">{{$item['product_name']}}</td>
                            <td class="align-middle">{{ number_format($item['price_product'])}}Đ</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" data-price_product="{{$item['price_product']}}" data-product-id="{{ $item['product_id'] }}" data-property-id="{{ $item['property_id'] }}">
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="quantity" class="form-control form-control-sm bg-secondary text-center" value="{{$item['quantity']}}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus" data-price_product="{{$item['price_product']}}" data-product-id="{{ $item['product_id'] }}" data-property-id="{{ $item['property_id'] }}">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle total-price">{{ number_format($item['price_product'] * $item['quantity']) }}Đ</td>
                            <td class="align-middle">
                                <button class="btn btn-sm btn-primary remove-item" data-product-id="{{ $item['product_id'] }}" data-property-id="{{ $item['property_id'] }}">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                        @php
                            // Accumulate the total amount
                            $totalAmount += $item['price_product'] * $item['quantity'];
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Thanh toán</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Tổng thành tiền:</h6>
                        <h6 class="font-weight-medium total-amount">{{ number_format($totalAmount) }}Đ</h6>
                    </div>
                    
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    @if(count($cart) > 0)
                    <a href="{{url('/checkout')}}" class="btn btn-block btn-primary my-3 py-3">Mua hàng</a>
                @else
                    <button class="btn btn-block btn-danger">Giỏ hàng trống</button>
                @endif
                
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('push_js') 

<script>
    $(document).ready(function () {
        $('.remove-item').on('click', function () {
            var product_id = $(this).data('product-id');
            var property_id = $(this).data('property-id');
            var rowToRemove = $(this).closest('tr');
        
            $.ajax({
                type: "POST",
                url: "/remove_item_cart",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    product_id: product_id,
                    property_id: property_id
                },
                success: function (response) {
                    // Kiểm tra phản hồi từ server
                    if (response.success) {
                        // Xóa phần tử khỏi DOM nếu xóa thành công
                    
                        alert('Sản phẩm đã được xóa khỏi giỏ hàng!');
                        rowToRemove.remove();
                        var updatedTotalAmount = response.updated_total_amount;

                        // Update the total amount on the page
                        $('.total-amount').text(updatedTotalAmount.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
               
                    } else {
                        alert(response.message || 'Có lỗi xảy ra khi xóa sản phẩm khỏi giỏ hàng.');
                    }
                },
                error: function () {
                    alert('Có lỗi kết nối.');
                }
            });
        });

        $('.btn-plus').on('click', function () {
            var product_id = $(this).data('product-id');
            var property_id = $(this).data('property-id');
            var quantityInput = $(this).closest('.quantity').find('input[name="quantity"]');
            var newQuantity = parseInt(quantityInput.val());
          
            var pricePerItem = parseFloat($(this).data('price_product'));
            var newTotalPrice = pricePerItem * newQuantity;

            var totalElement = $(this).closest('tr').find('.total-price'); 
            totalElement.text(newTotalPrice.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
            $.ajax({
            type: "POST",
            url: "/plus_quantity_cart",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                product_id: product_id,
                property_id: property_id,
                quantity: newQuantity
            },
            success: function (response) {
                console.log(response);

                var updatedTotalAmount = response.updated_total_amount;

                // Update the total amount on the page
                $('.total-amount').text(updatedTotalAmount.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));

                if(response.message != null){
                    alert(response.message);
                }
            },
            error: function () {
                alert('Có lỗi kết nối.');
            }
            });
        });
        $('.btn-minus').on('click', function () {
            var product_id = $(this).data('product-id');
            var property_id = $(this).data('property-id');
            var quantityInput = $(this).closest('.quantity').find('input[name="quantity"]');
            var newQuantity = parseInt(quantityInput.val());
          
            var pricePerItem = parseFloat($(this).data('price_product'));
            var newTotalPrice = pricePerItem * newQuantity;


            var totalElement = $(this).closest('tr').find('.total-price'); 
            totalElement.text(newTotalPrice.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
            $.ajax({
            type: "POST",
            url: "/plus_quantity_cart",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                product_id: product_id,
                property_id: property_id,
                quantity: newQuantity
            },
            success: function (response) {
                console.log(response);
                var updatedTotalAmount = response.updated_total_amount;

                // Update the total amount on the page
                $('.total-amount').text(updatedTotalAmount.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));

                if(response.message != null){
                    alert(response.message);
                }
            },
            error: function () {
                alert('Có lỗi kết nối.');
            }
            });
        });
      
    });

</script>


@endsection