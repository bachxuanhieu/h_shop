@extends('layouts.index')
@section('title')
 Mua hàng
@endsection

@section('content')
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Mua hàng</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Trang chủ</a></p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Checkout Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <div class="mb-4">
                <h4 class="font-weight-semi-bold mb-4">Thông tin đơn hàng</h4>
                <p style="color:black">Hãy đăng nhập để đặt hàng, quản lý và theo dõi đơn đặt hàng! <br>
                     <a href="{{url('/login')}}" style="color: blue">Đăng nhập</a>  <a href="{{url('/register')}}" style="color: red">(Đăng ký ngày!)</a></p></p>
                    
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Họ và tên</label>
                        <input class="form-control" id="fullname" required type="text" placeholder="" value="{{ auth()->check() ? auth()->user()->name : '' }}">
                    </div>
                    
                    <div class="col-md-6 form-group">
                        <label>E-mail</label>
                        <input class="form-control" id="email" required type="text" placeholder="" value="{{ auth()->check() ? auth()->user()->email : '' }}">
                    </div>
                    
                    <div class="col-md-6 form-group">
                        <label>Số điện thoại</label>
                        <input class="form-control" id="phone" required type="text" placeholder="" value="{{ auth()->check() ? auth()->user()->phone : '' }}">
                    </div>
                    
                   
                    <div class="col-md-6 form-group">
                        <label for="province" class="form-label">Chọn thành phố:</label>
                        <select name="province" id="province" class="form-control">
                            <option value="">Chọn thành phố</option>
                            @foreach ($provinces as $i)
                                <option value="{{$i->province_id}}">
                                    {{$i->name}}
                                </option>
                            @endforeach   
                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="district">Quận/Huyện:</label>
                        <select id="district" name="district" class="form-control">
                            <option value="">Chọn một quận/huyện</option>
                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="wards">Phường/Xã:</label>
                        <select name="wards" id="wards" class="form-control">
                            <option value="">Chọn một phường/xã</option>
                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Địa chỉ</label>
                        <input class="form-control" id="address" type="text" placeholder="Số nhà/tên đường....">
                    </div>
                   
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Đơn hàng</h4>
                </div>
                <div class="card-body">
                    <h5 class="font-weight-medium mb-3">Sản phẩm</h5>
                    <div class="d-flex justify-content-between">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Thành tiền</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                $totalAmount = 0;
                                @endphp
                                @foreach($cart as $item)
                                    <tr>
                                        <th scope="row">{{$i}}</th>
                                        <td>{{$item['product_name']}}</td>
                                        <td>{{$item['quantity']}}</td>
                                        <td>{{ number_format($item['price_product'] * $item['quantity']) }}Đ</td>
                                    </tr>
                                    @php
                                    $i++;
                                    $totalAmount += $item['price_product'] * $item['quantity'];
                                    @endphp
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                    <hr class="mt-0">
                </div>
                <div class="card-footer border-secondary bg-transparent">
                 
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Tổng thành tiền</h5>
                        <h5 class="font-weight-bold">{{ number_format($totalAmount) }}Đ</h5>
                    </div>
                </div>
            </div>
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Thanh toán</h4>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3" id="Payment_upon_delivery">Thanh toán khi nhân hàng</button>
                    <button class="btn btn-lg btn-block btn-danger font-weight-bold my-3 py-3" id="Pay_via_momo">Thanh toán qua MOMO</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Checkout End -->

@endsection

@section('push_js') 

<script>
  $(document).ready(function(){
   // LẤY ĐỊA CHỈ QUẬN HUYỆN==================================================
   $('#province').on('change', function(){
      var province_id = $(this).val();
      // alert(province_id);
      $.ajax({
         url:'/checkout/getDistrict',
         method: 'POST',
         headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
         dataType: 'json',
         data:{
            province_id: province_id
         },
         success: function(data){
            $('#district').empty();
            // console.log(data);
            $.each(data, function(i, district){
               $('#district').append($('<option>',{
                  value: district.district_id,
                  text: district.name
               }));
            });
         },error: function(){
            alert('Lỗi rồi');
         }
      })
   });

      // LẤY ĐỊA CHỈ PHƯỜNG XÂ===================================================
      $('#district').on('change',function(){
      var district_id = $(this).val();
      // alert(district_id);
        if(district_id){
            $.ajax({
                url:'/checkout/getWards',
                type: 'POST',
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                data: {
                district_id: district_id
                },
                success: function(data){
                $('wards').empty();
                // console.log(data);
                $.each(data, function(i, wards){
                    $('#wards').append($('<option>',{
                        value: wards.wards_id,
                        text: wards.name
                    }));
                });
                },error: function(){
                alert('lỗi rồi');
                }
            })
        }
    });
    // Thanh toán khi nhận hàng
    $('#Payment_upon_delivery').on('click',function(){
        var fullname = $('#fullname').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var address = $('#address').val();
      
        var province = $('#province option:selected').text();
        var district = $('#district option:selected').text();
        var wards = $('#wards option:selected').text();

        if (!fullname || !email || !phone || !address || !province || !district || !wards) {
        // Hiển thị thông báo nếu có trường nào đó chưa được nhập hoặc chọn
        alert('Vui lòng điền đầy đủ thông tin và chọn địa chỉ.');
        return; // Dừng lại nếu có trường nào đó không hợp lệ
        }
        var fullAddress = address + '-' + wards + '-' + district + '-' + province;

        console.log(fullAddress);

        $.ajax({
                type:"POST",
                url: "/checkout/Payment_upon_delivery",
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    fullname: fullname,
                    email: email,
                    phone: phone,
                    address: fullAddress,
                },
                success: function (response) {
                    alert(response.message);
                    window.location.href = '/order';
                }, 
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Có lỗi.');
                }
                
            })
    });

    $('#Pay_via_momo').on('click', function () {
        var fullname = $('#fullname').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var address = $('#address').val();
    
        var province = $('#province option:selected').text();
        var district = $('#district option:selected').text();
        var wards = $('#wards option:selected').text();

        if (!fullname || !email || !phone || !address || !province || !district || !wards) {
            // Hiển thị thông báo nếu có trường nào đó chưa được nhập hoặc chọn
            alert('Vui lòng điền đầy đủ thông tin và chọn địa chỉ.');
            return; // Dừng lại nếu có trường nào đó không hợp lệ
        }
        
        var fullAddress = address + '-' + wards + '-' + district + '-' + province;

        console.log(fullAddress);

        $.ajax({
            type: "POST",
            url: "/checkout/Pay_via_momo",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                fullname: fullname,
                email: email,
                phone: phone,
                address: fullAddress,
            },
            success: function (response) {
                if (response.success && response.payUrl) {
                    // Chuyển hướng đến trang thanh toán của Momo
                    window.location.href = response.payUrl;
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert('Có lỗi.');
            }
        });
    });

    $('.btn-add-promotion').on('click',function(){
            var Code = $('#code_promotion').val();
            alert(Code);
            $.ajax({
                type: 'POST',
                url: '/apply_discount',
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                data: { Code: Code },
                success: function (response) {
                    if (response.success) {
                        alert(response.message);
                        // Cập nhật tổng thành tiền dựa trên response.discount_percentage
                        updateTotalAmount(response.discount_percentage);
                    } else {
                        alert(response.message || 'Có lỗi xảy ra khi áp dụng mã giảm giá.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

    //     function updateTotalAmount(discountPercentage) {
           
    //         var currentTotalAmount = parseFloat($('.total-amount').text().replace('Đ', '').replace(',', ''));

    //         var newTotalAmount = currentTotalAmount * (discountPercentage);

         
    //         $('.total-amount').text(newTotalAmount.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
    //     }

});

</script>


@endsection