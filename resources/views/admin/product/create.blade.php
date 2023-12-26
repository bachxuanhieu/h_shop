@extends('layouts.admin')

@section('title')
    Thêm sản phẩm
@endsection

@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <h4>Thêm sản phẩm</h4>
                    <a href="{{ route('admin.product') }}" class="btn btn-success ml-auto">Quay lại</a>
                </div>
            </div>
            <div class="card-body">
                @if($errors->any())
                <div class="alert alert-warning">
                   @foreach($errors->all() as $error)
                   <div>{{$error}}</div>
                   @endforeach
                </div>
                @endif
                <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Chọn danh mục sản phẩm</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="">Chọn danh mục con</label>
                                <select class="form-control" name="subcategory_id" id="subcategory_id">
                                    <option value="">Chọn danh mục</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="">Chọn thương hiệu</label>
                                <select class="form-control" name="brand_id" id="brand_id">
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                   
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="" class="form-label">Tên sản phẩm</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                                @error('name') <small class="text-danger">{{$message}}</small>   @enderror

                            </div>
                            <div class="col-md-2">
                                <label for="">Sản phẩm thịnh hành</label>
                                <select class="form-control" name="trending" id="trending">
                                    <option value="1">Có</option>
                                    <option value="0">Không</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="">Trạng thái</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="1">Hiện thị</option>
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Giá sản phẩm</label>
                                <input type="number" class="form-control" name="old_price" id="old_price">
                                @error('old_price') <small class="text-danger">{{$message}}</small>   @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Giá khuyễn mãi</label>
                                <input type="number" class="form-control" name="selling_price" id="selling_price">
                                @error('selling_price') <small class="text-danger">{{$message}}</small>   @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Slug</label>
                                <input type="text" class="form-control" name="slug" id="slug" required>
                                @error('slug') <small class="text-danger">{{$message}}</small>   @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="" class="form-label">Chọn hình sản phẩm</label>
                                <input type="file" name="image[]" class="form-control" multiple class="">
                            </div>
                            <div class="col-md-7">
                                <label for="">Chọn dung tích</label>
                                <div class="row">
                                    
                                    @foreach ($properties as $property)
                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <label for="">Tich chọn</label><br>
                                            <input type="checkbox" name="properties[]" value="{{$property->id}}">{{$property->name}}
                                        </div>
                                        <div class="mb-2">
                                            <label for="">Số lượng</label>
                                            <input type="text" class="form-control" name="propertyQuantity[{{$property->id}}]">
                                        </div>
                                        <div class="mb-2">
                                            <label for="">Giá</label>
                                            <input type="text" class="form-control" name="price_product[{{$property->id}}]">
                                        </div>
                                        <div class="mb-2">
                                            <label for="">Hình ảnh</label>
                                            <input type="file" class="form-control" name="images[{{$property->id}}]">
                                        </div>
                                    </div>
                                    @endforeach
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Miêu tả ngắn</label>
                        <textarea name="small_desc" id="small_desc" class="form-control"></textarea>
                        @error('small_desc') <small class="text-danger">{{$message}}</small>   @enderror

                    </div>
                    <div class="mb-3">
                    <label for="" class="form-label">Miêu tả chi tiết</label>
                    <textarea name="desc" id="desc" class="form-control"></textarea>
                    @error('desc') <small class="text-danger">{{$message}}</small>   @enderror

                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-info">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('pushjs')
    <script>
        $(document).ready(function() {

            //     $('#image').change(function(e){
            //         var reader = new FileReader();
            //         reader.onload = function(e){
            //             $('#showImage').prop('src', e.target.result);  // Sử dụng prop thay vì attr
            //         }
            //         reader.readAsDataURL(e.target.files[0]);
            //     });

            //     $('#showImage').on('click', function() {
            //         var imagePreview = $('#showImage');
            //         var imageInput = $('#image');

            //         imagePreview.prop('src', ''); // Sử dụng prop thay vì attr
            //         imageInput.val(''); // Sử dụng val để xóa giá trị input file
            //     });
            $('#category_id').on('change', function() {
                var category_id = $(this).val();
                // alert(category_id);
                $.ajax({
                    url: '/admin/product/getSubcategory/' + category_id,
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        category_id: category_id
                    },
                    success: function(data) {
                        $('#subcategory_id').empty();
                        $.each(data, function(i, subcategory) {
                            $('#subcategory_id').append($('<option>', {
                                value: subcategory.id,
                                text: subcategory.name
                            }))
                        })
                    },
                    error: function() {
                        alert('Lỗi rồi');
                    }
                })
            });

        });
    </script>
@endsection
