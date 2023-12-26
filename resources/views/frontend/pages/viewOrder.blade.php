@extends('layouts.index')
@section('title')
  Xem đơn hàng
@endsection

@section('content')
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Chi tiết đơn hàng đã đặt</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{url('/')}}">Trang chủ</a></p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Checkout Start -->
<div class="container-fluid pt-5">
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
                        <th scope="col">Xử lý</th>
                      </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>{{$order->fullname}}</td>
                                <td>{{$order->email}}</td>
                                <td>{{$order->phone}}</td>
                                <td>{{$order->address}}</td>
                                <td>
                                    @if ($order->status == "Đã xác nhận")
                                        <button class="btn btn-danger btn-sm">Không thể sửa thông tin</button>
                                    @else
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">Sửa thông tin</button>
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa thông tin</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{url('/order/edit_info/'.$order->id)}}" method="POST">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="">Tên người nhận</label>
                                                            <input type="text" class="form-control"
                                                            value="{{$order->fullname}}" name="fullname" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Email</label>
                                                            <input type="text" class="form-control"
                                                            value="{{$order->email}}" name="email" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Số điện thoại</label>
                                                            <input type="text" class="form-control"
                                                            value="{{$order->phone}}" name="phone" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Địa chỉ nhận hàng</label>
                                                            <input type="text" class="form-control"
                                                            value="{{$order->address}}" name="address" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                  
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                    @endif
                                   
                                </td>
                            </tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
    <div>
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
            </div>
        </div>
    </div>
    
<!-- Checkout End -->

@endsection

@section('push_js') 

<script>
$(document).ready(function(){
    

 
});

</script>


@endsection