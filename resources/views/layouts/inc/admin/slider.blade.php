<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('admin/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">BachXuanHieu_shop</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Trang chủ</p>
                    </a>																
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.category')}}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Danh mục sản phẩm</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.subcategory')}}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Danh mục con</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/admin/newscategory')}}" class="nav-link">
                        <i class="nav-icon far fa-file-alt"></i>
                        <p>Danh mục bài viết</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/admin/news')}}" class="nav-link">
                        <i class="nav-icon far fa-file-alt"></i>
                        <p>Bài viết</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.brand')}}" class="nav-link">
                        <svg class="h-6 nav-icon w-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                          </svg>
                        <p>Thương hiệu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.property')}}" class="nav-link">
                        <i class="fa-solid fa-glass-water-droplet h-6 nav-icon w-6 shrink-0"></i>
                        <p>Thuộc tính</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.product')}}" class="nav-link">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>Sản phẩm</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/promotion')}}" class="nav-link">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>Chương trình khuyến mãi</p>
                    </a>
                </li>
                						
                <li class="nav-item">
                    <a href="{{url('/admin/order')}}" class="nav-link">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>Đơn hàng</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/sliders')}}" class="nav-link">
                        <i class="nav-icon  fa fa-percent" aria-hidden="true"></i>
                        <p>Thanh trượt</p>
                    </a>
                </li>
              
                <li class="nav-item">
                    <a href="{{url('/admin/setting')}}" class="nav-link">
                        <i class="nav-icon  far fa-user"></i>
                        <p>Thông tin trang WEB</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/admin/user')}}" class="nav-link">
                        <i class="nav-icon  far fa-user"></i>
                        <p>Tài khoản đăng ký</p>
                    </a>
                </li>	
                <li class="nav-item">
                    <a href="{{url('/admin/contact')}}" class="nav-link">
                        <i class="nav-icon  far fa-file-alt"></i>
                        <p>Thư của khách hàng</p>
                    </a>
                </li>						
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
 </aside>