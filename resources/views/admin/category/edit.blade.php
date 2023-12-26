@extends('layouts.admin')

@section('title')
    Sửa danh mục sản phẩm
@endsection

@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <h4 class="card-title">Sửa danh mục sản phẩm</h4>
                    <a href="{{ route('admin.category') }}" class="btn btn-success btn-sm ml-auto">Quay lại</a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{url('admin/category/'.$category->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="" class="form-label">Tên danh mục</label>
                        <input type="text" value="{{$category->name}}" name="name" id="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">Slug</label>
                                <input type="text" value="{{$category->slug}}" name="slug" id="slug" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Hiển thị</label>
                                <select name="status" id="status" class="form-control">
                                    <option {{$category->status == 1 ? 'selected' : '' }} value="1">Hiện</option>
                                    <option {{$category->status == 0 ? 'selected' : '' }} value="0">Ẩn</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Hình ảnh</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @if(!empty($category->image))
                            <div class="mb-3">
                                <img id="showImage" src="{{asset('admin/image/category/'.$category->image)}}" height="100px" width="100px" alt="">
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-info ml-auto">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('pushjs')
    <script>
    $(document).ready(function(){
    
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').prop('src', e.target.result); 
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        $('#showImage').on('click', function() {
            var imagePreview = $('#showImage');
            var imageInput = $('#image');

            imagePreview.prop('src', ''); 
            imageInput.val(''); 
        });

        
    
    });

</script>
@endsection
