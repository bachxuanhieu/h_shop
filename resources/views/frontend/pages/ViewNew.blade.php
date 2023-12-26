@extends('layouts.index')
@section('title')
    Bài viết
@endsection

@section('content')

<!-- Contact Start -->
<div class="container-fluid pt-5">
   
    <div class="row px-xl-5 mb-5 text-center">
        <h2>{{$new->name}}</h2>
    </div>
    <div class="row px-xl-5 mb-5">
        <h4>{!!$new->desc!!}</h4>
    </div>
</div>

@endsection