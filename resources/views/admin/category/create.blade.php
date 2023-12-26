@extends('layouts.admin')

@section('title')
Thêm danh mục sản phẩm
@endsection

@section('content')

<div>
    <div class="card">
        <div class="card-header">
           <div class="row">
                <h4>Thêm danh mục sản phẩm </h4>
                <a href="{{route('admin.category')}}" class="btn btn-success btn-sm ml-auto">Quay lại</a>
           </div>
        </div>
        <section class="content">
            <div class="card-body">
            <form action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Tên danh mục</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Hiển thị</label> 
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Hiện</option>
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Hình ảnh</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <img id="showImage" src="" height="100px" width="100px"  alt="">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-info ml-auto">Lưu</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>



@endsection

@section('pushjs')

<script>
   $(document).ready(function(){
   
    $('#image').change(function(e){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#showImage').prop('src', e.target.result);  // Sử dụng prop thay vì attr
        }
        reader.readAsDataURL(e.target.files[0]);
    });

    $('#showImage').on('click', function() {
        var imagePreview = $('#showImage');
        var imageInput = $('#image');

        imagePreview.prop('src', ''); // Sử dụng prop thay vì attr
        imageInput.val(''); // Sử dụng val để xóa giá trị input file
    });
   
});

</script>

@endsection