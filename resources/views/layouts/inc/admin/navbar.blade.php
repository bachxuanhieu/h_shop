<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Right navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>					
    </ul>
    <div class="navbar-nav pl-2">
        <!-- <ol class="breadcrumb p-0 m-0 bg-white">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol> -->
    </div>
    
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
                @php
                     $id= Auth::user()->id;
                    $user = App\Models\User::find($id);
                @endphp
                <img src="{{empty($user->image) ? url('admin/img/avatar5.png') : url('admin/image/'.$user->image)}}" class='img-circle elevation-2' width="40" height="40" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
                <h4 class="h4 mb-0"><strong>{{Auth::user()->name}}</strong></h4>
                <div class="mb-3">{{Auth::user()->email}}</div>
                <div class="dropdown-divider"></div>
                <a href="{{route('admin.profile')}}" class="dropdown-item">
                    <i class="fas fa-user-cog mr-2"></i> Thông tin Admin								
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{route('admin.change.password')}}" class="dropdown-item">
                    <i class="fas fa-lock mr-2"></i> Đổi mật khẩu
                </a>
                <div class="dropdown-divider"></div>
                <a  href="{{ route('logout') }}"  onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="dropdown-item text-danger">
                    <i class="fas fa-sign-out-alt mr-2"></i> Đăng xuất							
                </a>	
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>						
            </div>
        </li>
    </ul>
</nav>