@extends('layouts.admin')

@section('title')
Trang quản lí
@endsection

@section('content')
<section class="content-header">					
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Trang quản lí</h1>
            </div>
            <div class="col-sm-6">
                
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>{{ $orderCount }}</h3>
                        <p>Đơn hàng</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{url('/admin/order')}}" class="small-box-footer text-dark">Xem thông tin<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-4 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>{{$productCount}}</h3>
                        <p>Tổng số sản phẩm</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{url('/admin/product')}}" class="small-box-footer text-dark">Xem thông tin<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>{{$userCount}}</h3>
                        <p>Tổng số người dùng</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{url('/admin')}}" class="small-box-footer text-dark">Xem thông tin<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>{{$newCount}}</h3>
                        <p>Tổng số bài viết</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{url('/admin/news')}}" class="small-box-footer text-dark">Xem thông tin<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>					
    <!-- /.card -->
</section>

@endsection