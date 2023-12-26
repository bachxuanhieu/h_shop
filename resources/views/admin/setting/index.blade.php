@extends('layouts.admin')

@section('title')
Thông tin trang web
@endsection

@section('content')

<div>
    <div class="card">
        <div class="card-header">
           <div class="row">
                <h4>Thông tin trang wed</h4>
                <a href="{{url('/admin/setting/create')}}" class="btn btn-success btn-sm ml-auto">Thêm thông tin</a>
           </div>
        </div>
        <div class="card-body">
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        
                        <th>Tên web</th>
                        <th>Đường dẫn</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($settings as $setting)
                        <tr>
                            <td>{{$setting->website_name}}</td>
                            <td>{{$setting->website_url}}</td>
                            <td>{{$setting->email}}</td>
                            <td>{{$setting->phone}}</td>
                            <td>{{$setting->address}}</td>
                        </tr>
                    @endforeach    
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection

@section('pushjs')

<script>
  
   
</script>

@endsection