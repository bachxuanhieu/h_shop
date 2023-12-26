<div class="container-fluid bg-secondary text-dark mt-5 pt-5">
    <div class="row px-xl-5 pt-5">
        <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
            <a href="{{url('/')}}" class="text-decoration-none">
                <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">H</span>Shopper</h1>
            </a>
            <p>I love you</p>
            <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>{{$setting->address}}</p>
            <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{$setting->email}}</p>
            <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>{{$setting->phone}}</p>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="row">
                <div class="col-md-6 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Trang</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-dark mb-2" href="{{url('/')}}"><i class="fa fa-angle-right mr-2"></i>Trang chủ</a>
                        <a class="text-dark mb-2" href="{{url('/products')}}"><i class="fa fa-angle-right mr-2"></i>Sản phẩm</a>
                        <a class="text-dark mb-2" href="{{url('/')}}"><i class="fa fa-angle-right mr-2"></i>Bài viết</a>
                        <a class="text-dark mb-2" href="{{url('/')}}"><i class="fa fa-angle-right mr-2"></i>Liên hệ</a>
                    </div>
                </div>
               
                <div class="col-md-6 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Gửi thư</h5>
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
        </div>
    </div>
</div>