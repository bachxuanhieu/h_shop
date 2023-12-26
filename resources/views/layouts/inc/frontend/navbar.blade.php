


<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">Danh mục sản phẩm</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse {{ request()->is('/') ? 'show' : '' }} navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                <div class="navbar-nav w-100 overflow-hidden" style="height:300px">
                    @foreach ($categories as $category)
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">{{$category->name}}<i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                @foreach ($category->subcategory as $sub)
                                    <a href="{{url('/product_sub/'.$sub->id)}}" class="dropdown-item">{{$sub->name}}</a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach


                   
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown">Thương hiệu<i class="fa fa-angle-down float-right mt-1"></i></a>
                        <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                            @foreach ($brands as $brand)
                                <a href="{{url('product_brand/'.$brand->id)}}" class="dropdown-item">{{$brand->name}}</a>
                            @endforeach
                        </div>
                    </div>
              
                   
                    {{-- <a href="" class="nav-item nav-link">Shirts</a> --}}
                    
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">H</span>Shopper</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{url('/')}}" class="nav-item nav-link active">Trang chủ</a>
                        <a href="{{url('/products')}}" class="nav-item nav-link">Sản phẩm</a>
                        <a href="{{url('/news')}}" class="nav-item nav-link">Bài viết</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Thanh toán</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="{{url('/cart')}}" class="dropdown-item">Giỏ hàng</a>
                                <a href="{{url('/checkout')}}" class="dropdown-item">Thanh toán</a>
                            </div>
                        </div>
                        <a href="{{url('/contact')}}" class="nav-item nav-link">Liên hệ</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0">
                        {{-- <li class="nav-item">
                            <a class="nav-link" href=""></a>
                        </li> --}}
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/login') }}">{{ __('Đăng nhập') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Đăng xuất') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
                    </div>
                </div>
            </nav>
            @if((request()->is('/') || request()->is('index')) && request()->isMethod('get'))
                 @include('layouts.inc.frontend.slider')
            @endif
          
        </div>
    </div>
</div>