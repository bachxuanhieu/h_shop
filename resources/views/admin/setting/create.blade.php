@extends('layouts.admin')

@section('title')
Thêm thông tin trang web
@endsection

@section('content')

<div>
    <div class="card">
        <div class="card-header">
           <div class="row">
                <h4>Thêm thông tin trang web</h4>
                <a href="{{url('/admin/setting')}}" class="btn btn-success btn-sm ml-auto">Quay lại</a>
           </div>
        </div>
        <section class="content">
            <div class="card-body">
            <form action="{{url('/admin/setting')}}" method="POST">
                @csrf
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">Tên Web</label>
                                <input type="text" name="website_name" id="website_name" class="form-control">
                            </div>
                             <div class="col-md-6">
                                <label for="" class="form-label">Đường dẫn (Url)</label>
                                <input type="text" name="website_url" id="website_url" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">Địa chỉ</label>
                                <input type="text" name="address" id="address" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Trang</label>
                                <input type="text" name="page_title" id="page_title" class="form-control">
                            </div>
                        </div>
                        
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">Số điện thoai</label>
                                <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Email</label>
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                        </div>  
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">Facebook</label>
                                <input type="text" name="facebook" id="facebook" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">twitter</label>
                                <input type="text" name="twitter" id="twitter" class="form-control">
                            </div>
                        </div>  
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">instagram</label>
                                <input type="text" name="instagram" id="instagram" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">youtube</label>
                                <input type="text" name="youtube" id="youtube" class="form-control">
                            </div>
                        </div>  
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