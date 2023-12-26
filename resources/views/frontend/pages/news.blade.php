@extends('layouts.index')
@section('title')
    Bài viết
@endsection

@section('content')
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Bài viết</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{url('/')}}">Trang chủ</a></p>
            
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Contact Start -->
<div class="container-fluid pt-5">
   
    <div class="row px-xl-5">
        <div class="col-lg-9 mb-5">
            <h4>Bài viết:</h4>
            @foreach ($news as $new)
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="{{url('/news/'.$new->id)}}"><img src="{{asset('admin/image/news/'.$new->image)}}" height="100px" width="200px" alt=""></a>
                    </div>
                    <div class="col-md-9 mb-3">
                         <a href="{{url('/news/'.$new->id)}}"><h5>{{$new->name}}</h5></a>
                    </div>
                </div>
            @endforeach
           
        </div>
        <div class="col-lg-3 mb-5">
           <h4>Danh mục bài viết</h4>
           @foreach ($newscategory as $new)
            <div class="row">
                <ul class="list-group">
                    <li class="list-group-item">{{$new->name}}</li>
                </ul>
            </div>
            @endforeach
        </div>
       
    </div>
</div>

@endsection