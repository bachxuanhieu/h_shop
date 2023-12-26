@extends('layouts.index')
@section('title')
    Liên hệ
@endsection

@section('content')
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Liên hệ</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{url('/')}}">Trang chủ</a></p>
            
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Contact Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Giải đáp mọi thắc mắc</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="contact-form">
                <div id="success"></div>
                <form name="sentMessage" id="contactForm" novalidate="novalidate">
                    <div class="control-group">
                        <input type="text" class="form-control" id="name" placeholder="Họ và tên"
                            required="required" data-validation-required-message="Please enter your name" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <input type="email" class="form-control" id="email" placeholder="Email"
                            required="required" data-validation-required-message="Please enter your email" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <textarea class="form-control" rows="6" id="message" placeholder="Nôi dung"
                            required="required"
                            data-validation-required-message="Please enter your message"></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div>
                        <button class="btn btn-primary py-2 px-4" type="button" id="sendMessageButton">Gửi thư</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5 mb-5">
            <h5 class="font-weight-semi-bold mb-3">Liên lạc</h5>
            <p>Hãy gửi mọi ý kiến, câu hỏi, đánh giá của bạn về sản phẩm, chăm sóc khách hàng của chúng tôi.</p>
            <div class="d-flex flex-column mb-3">
                <h5 class="font-weight-semi-bold mb-3">Cửa hàng 1</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>{{$setting->address}}</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{$setting->email}}</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>{{$setting->phone}}</p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('push_js')

<script>
   $(document).ready(function () {
   
        $('#sendMessageButton').on('click',function(){
            var name = $('#name').val();
            var email = $('#email').val();
            var message = $('#message').val();

            $.ajax({
                type:"POST",
                url: "/SendMessage",
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    name: name,
                    email: email,
                    message: message,
                },
                success: function (response) {
                    alert('Thư của bạn đã gủi thành công, chúng tôi sẽ gửi mail cho bạn sớm nhất!');
                }, 
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Có lỗi.');
                }
                
            })

            
        })

});
</script>

@endsection