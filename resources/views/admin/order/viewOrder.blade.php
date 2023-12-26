@extends('layouts.admin')

@section('title')
Chi tiết đơn hàng
@endsection

@section('content')
    <div class="mb-3">
        <div class="card">
            <div class="card-header">
                <h4>Thông tin khách hàng</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Địa chỉ</th>
                      </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>{{$order->fullname}}</td>
                                <td>{{$order->email}}</td>
                                <td>{{$order->phone}}</td>
                                <td>{{$order->address}}</td>
                            </tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <div class="card">
            <div class="card-header">
                <h4>Thông tin đơn hàng</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Dung tích</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Thành tiền</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalAmount = 0; // Initialize total amount
                            @endphp
                            @foreach ($order_items as $i)
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{$i->product->name}}</td>
                                    <td>{{$i->productProperty->name}}</td>
                                    <td><img src="{{ asset('admin/products/'.$i->image)}}" alt="" style="width: 50px;"></td>
                                    <td>{{$i->quanlity}}</td>
                                    <td>{{ number_format($i->price)}}Đ</td>
                                    <td>{{ number_format($i['price'] * $i['quanlity']) }}Đ</td>
                                </tr>
                                @php
                            // Accumulate the total amount
                                    $totalAmount += $i['price'] * $i['quanlity'];
                                @endphp
                             @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mb-3">
                    <h6>Tổng thành tiền:</h6>
                    <h5 style="color:black">{{ number_format($totalAmount) }}Đ</h5>
                </div>
                <div class="mb-3">
                    @if ($order->status == "Đã xác nhận")
                        <button class="btn btn-info">Đơn hàng đã xác nhận</button>
                    @else
                        <button id="confirmButton" class="btn btn-danger Order_confirmation" data-order_id="{{$order->id}}">Xác nhận đơn hàng</button>
                    @endif
                   
                </div>
                <div class="mb-3">
                    <a class="btn btn-secondary" href="{{url('/admin/order')}}">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pushjs')

<script>
   $(document).ready(function(){
        $('.Order_confirmation').on('click', function(){
            var id = $(this).data('order_id');
            var confirmButton = $('#confirmButton');
            console.log(id);
            $.ajax({
                type: 'POST',
                url: '/admin/order_confirmation/'+id, 
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    console.log(response); // Xem log từ phía máy chủ
                    alert('Xác nhận đơn hàng thành công');
                    confirmButton.text('Đã xác nhận đơn hàng');
                    confirmButton.removeClass('btn-danger').addClass('btn-success');
                    confirmButton.prop('disabled', true);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Có lỗi.');
                }
            });
        });
    });

</script>

@endsection