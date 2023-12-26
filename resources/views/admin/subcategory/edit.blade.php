@extends('layouts.admin')

@section('title')
    Sửa danh mục con
@endsection

@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <h4 class="card-title">Sửa danh mục con</h4>
                    <a href="{{ route('admin.subcategory') }}" class="btn btn-success btn-sm ml-auto">Quay lại</a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{url('admin/subcategory/'.$subcategory->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">Tên danh mục</label>
                                <input type="text" value="{{$subcategory->name}}" name="name" id="name" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Danh mục sản phẩm</label> 
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach ($categories as $cate)
                                    <option value="{{$cate->id}}" {{$cate->id == $subcategory->category_id ? 'selected' : ''}}>{{$cate->name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                       
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">Mô tả</label>
                                <input type="text" value="{{$subcategory->desc}}" name="desc" id="desc" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Hiển thị</label>
                                <select name="status" id="status" class="form-control">
                                    <option {{$subcategory->status == 1 ? 'selected' : '' }} value="1">Hiện</option>
                                    <option {{$subcategory->status == 0 ? 'selected' : '' }} value="0">Ẩn</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Hình ảnh</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @if(!empty($subcategory->image))
                            <div class="mb-3">
                                <img id="showImage" src="{{asset('admin/image/subcategory/'.$subcategory->image)}}" height="100px" width="100px" alt="">
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