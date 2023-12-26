@extends('layouts.admin')

@section('title')
Đơn hàng
@endsection

@section('content')

<div>
    <div class="card">
        <div class="card-header">
            <div class="mb-2">
                <h4>Đơn đặt hàng</h4>
                
            </div>
            <div class="mb-2">
                <div class="input-group mt-4">
                    <input type="date" class="form-control" id="startDate" placeholder="Từ ngày">
                    <input type="date" class="form-control" id="endDate" placeholder="Đến ngày">
                    <div class="input-group-append">
                        <button class="btn btn-primary" id="filterByDate">
                            Lọc theo ngày
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table" id="orderTable">
                <thead>
                  <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Code Đơn hàng</th>
                    <th scope="col">Ngày đặt hàng</th>
                    <th scope="col">Tình trạng</th>
                    <th scope="col">Hình thức thanh toán</th>
                    <th scope="col">Quản lý</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $i=1;
                    @endphp
                    @foreach ($orders as $order)
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$order->code}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->status}}</td>
                        <td>{{$order->payment_mode}}</td>
                        <td><a href="{{url('/admin/viewOrder/'.$order->id)}}" class="btn btn-success">Xem chi tiết</a></td>
                    </tr>
                    @php
                    $i++;
                    @endphp
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>

@endsection

@section('pushjs')

<script>
   $(document).ready(function(){
        $('#filterByDate').on('click', function () {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();

            $.ajax({
                type: 'POST',
                url: '/admin/filterOrdersByDate',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    startDate: startDate,
                    endDate: endDate
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.status === "true") {
                        updateOrderTable(response.orders);
                    } else {
                        // updateOrderTable(response.orders);
                        alert('Không tìm thấy đơn hàng');
                    }
                },
                error: function () {
                    alert('Lỗi kết nối máy chủ!!!');
                }
            });
        });
        function updateOrderTable(orders) {
            // Lấy reference đến bảng đơn hàng trong DOM
            var orderTable = document.getElementById('orderTable');

            // Xóa nội dung hiện tại của bảng
            orderTable.innerHTML = '';

            // Kiểm tra xem có đơn hàng nào không
            if (orders.length > 0) {
                // Tạo tiêu đề của bảng
                var tableHeader = "<tr><th>STT</th><th>Code Đơn hàng</th><th>Ngày đặt hàng</th><th>Tình trạng</th><th>Hình thức thanh toán</th><th>Quản lý</th></tr>";

                // Thêm tiêu đề vào bảng
                orderTable.innerHTML += tableHeader;

                // Duyệt qua mỗi đơn hàng và thêm vào bảng
                for (var i = 0; i < orders.length; i++) {
                    var order = orders[i];

                    var row = "<tr>" +
                        "<td>" + (i + 1) + "</td>" +
                        "<td>" + order.code + "</td>" +
                        "<td>" + order.created_at + "</td>" +
                        "<td>" + order.status + "</td>" +
                        "<td>" + order.payment_mode + "</td>" +
                        "<td><a href='/admin/viewOrder/" + order.id + "' class='btn btn-success'>Xem chi tiết</a></td>" +
                        "</tr>";

                    // Thêm dòng vào bảng
                    orderTable.innerHTML += row;
                }
            } else {
                // Hiển thị thông báo nếu không có đơn hàng
                orderTable.innerHTML = "<tr><td colspan='6'>Không có đơn hàng</td></tr>";
            }
        }

   });
   
</script>

@endsection