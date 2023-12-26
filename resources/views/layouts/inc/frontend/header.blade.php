<div class="container-fluid">
    <div class="row bg-secondary py-2 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark" href="{{url('/')}}">H_shop</a>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark px-2" href="{{$setting->facebook}}">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a class="text-dark px-2" href="#">
                    <i class="fab fa-twitter"></i>
                </a>
               
                <a class="text-dark px-2" href="{{$setting->facebook}}">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="text-dark pl-2" href="#">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="{{url('/')}}" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">H</span>Shopper</h1>
            </a>
        </div>
        <div class="col-lg-6 col-6 text-left">
            <form action="{{ url('/search') }}" method="GET" role="search">
                <div class="input-group">
                    <input type="text" name="keyword" value="{{ Request::input('keyword') }}" class="form-control" placeholder="Tìm kiếm">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-3 col-6 text-right">
            @auth
                @php
                    $orders = \App\Models\Order::where('user_id', Auth::user()->id)->get();
                    $orderCount = $orders->count();
                @endphp
            
                <a href="{{ url('/order') }}" class="btn border">
                    Đơn hàng
                    <span class="badge" style="color: red;">{{ $orderCount }}</span>
                </a>
            @endauth
            <a href="{{url('/cart')}}" class="btn border">
                Giỏ hàng
                <span class="badge" style="color: red;">{{ count(session('cart', [])) }}</span>
            </a>
        </div>
    </div>
</div>