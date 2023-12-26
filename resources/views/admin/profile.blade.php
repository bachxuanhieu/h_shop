@extends('layouts.admin')

@section('title')
Thông tin quản lí
@endsection

@section('content')
<div>
    <div class="card">
        <div class="card-header">
            <h3>Thông tin Quản Lí</h3>
            <img src="{{empty($user->image) ? url('admin/img/avatar5.png') : url('admin/image/'.$user->image)}}" height="400px" width="300px" class="card-img-top" alt="">
        </div>
        <form action="{{route('admin.profile.uploadProfile')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="">Tên</label>
                    <input type="text" value="{{$user->name}}" class="form-control" name="name" id="name">
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="text" value="{{$user->email}}" class="form-control" name="email" id="email">
                </div>
                <div class="mb-3">
                    <label for="">Số điện thoại</label>
                    <input type="text" value="{{$user->phone}}" class="form-control" name="phone" id="phone">
                </div>
                <div class="mb-3">
                    <label for="">Địa chỉ</label>
                    <input type="text"  value="{{$user->address}}" class="form-control" name="address" id="address">
                </div>
                <div class="mb-3">
                    <label for="">Hình ảnh</label>
                    <input type="file" class="form-control" name="image" id="formFile">
                </div>
                <div class="mb-3">
                    <img id="showImage" src="{{empty($user->image) ? url('admin/img/avatar5.png') : url('admin/image/'.$user->image)}}" height="100px" width="100px"  alt="">
                </div>
                <div class="mb-3">
                <button type="submit" class="btn btn-info">Lưu thông tin</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('pushjs')

<script type="text/javascript">
    $(document).ready(function(){
        $('#formFile').change(function(e){  // Thêm dấu # để chọn đúng id
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);  // Thêm dấu # để chọn đúng id
            }
            reader.readAsDataURL(e.target.files[0]);  // Chỉnh sửa để truy cập đúng file
        });
    });
</script>



@endsection