@extends('layouts.index')
@section('title')
  Đơn hàng
@endsection

@section('content')
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Đơn hàng đã đặt</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Trang chủ</a></p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Checkout Start -->
<div class="container-fluid pt-5">
    <div>
        @if($orders)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Mã đơn hàng</th>
                        <th scope="col">Ngày đặt hàng</th>
                        <th scope="col">Trang thái</th>
                        <th scope="col">Xử lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $index => $order)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $order->code }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <a href="{{url('viewOrder/'.$order->id)}}" class="btn btn-success btn-sm">Xem chi tiết</a>
                                @if ($order->status == "Đã xác nhận")
                                    <button class="btn btn-secondary btn-sm">Không thể xóa đơn hàng</button>
                                @else
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteOrder_{{$order->id}}">Hủy đơn hàng</button>
                                    <div class="modal fade" id="deleteOrder_{{$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Hủy đơn hàng</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              Đơn hàng của bạn sẽ bị hủy! Bạn có chắc??
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                              <button type="button" class="btn btn-danger btn-delete-order" data-order-id="{{$order->id}}">Có</button>

                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    @endif
                               

                            </td> <!-- Điền logic xử lý tương ứng ở đây -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Bạn chưa có đơn hàng nào.</p>
        @endif
    </div>
    
<!-- Checkout End -->

@endsection

@section('push_js') 

<script>
$(document).ready(function(){
    $('.btn-delete-order').on('click', function(){
        var orderId = $(this).data('order-id');
        // console.log(orderId);
        // var rowToRemove = $(this).closest('tr');
        $.ajax({
            type: 'DELETE',
            url: '/order/' + orderId,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                alert(data.message);
                // $('#deleteOrder_' + orderId).modal('hide');
                // $('#deleteOrder_' + orderId).on('hidden.bs.modal', function () {
                //     $(this).remove();
                // });
                // rowToRemove.remove();
                location.reload();
            },
            error: function (data) {
                console.error('Lỗi xóa danh mục:', data.responseJSON.message);
            }
        });
    });
});


</script>


@endsection