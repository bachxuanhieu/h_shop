@extends('layouts.admin')

@section('title')
    Sửa sản phẩm
@endsection

@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <h4>Sửa sản phẩm</h4>
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
                <form action="{{url('admin/product/'.$product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Chọn danh mục sản phẩm</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    @foreach ($categories as $category)
                                        <option   value="{{ $category->id }}" {{$category->id == $product->category_id ? 'selected' : ''}}>{{ $category->name }}</option>
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
                                        <option  {{$brand->id == $product->brand_id ? 'selected' : ''}} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                  
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="" class="form-label">Tên sản phẩm</label>
                                <input type="text" value="{{$product->name}}" class="form-control" name="name" id="name" required>
                                @error('name') <small class="text-danger">{{$message}}</small>   @enderror

                            </div>
                            <div class="col-md-2">
                                <label for="">Sản phẩm thịnh hành</label>
                                <select class="form-control" name="trending" id="trending">
                                    <option {{$product->trending == 1 ? 'selected' : '' }} value="1">Có</option>
                                    <option {{$product->trending == 0 ? 'selected' : '' }} value="0">Không</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="">Trạng thái</label>
                                <select class="form-control" name="status" id="status">
                                    <option {{$product->status == 1 ? 'selected' : '' }} value="1">Hiện thị</option>
                                    <option {{$product->status == 0 ? 'selected' : '' }} value="0">Ẩn</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Giá sản phẩm</label>
                                <input type="number" value="{{$product->old_price}}" class="form-control" name="old_price" id="old_price">
                                @error('old_price') <small class="text-danger">{{$message}}</small>   @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="">Giá khuyễn mãi</label>
                                <input type="number" value="{{$product->selling_price}}" class="form-control" name="selling_price" id="selling_price">
                                @error('selling_price') <small class="text-danger">{{$message}}</small>   @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Slug</label>
                                <input type="text" value="{{$product->slug}}" class="form-control" name="slug" id="slug" required>
                                @error('slug') <small class="text-danger">{{$message}}</small>   @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="" class="form-label">Chọn hình sản phẩm</label>
                                    <input type="file" name="image[]" class="form-control" multiple class="">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                @foreach ($product->productProperties as $productProperty)
                                    <div class="col-md-4" id="property_product_item_{{$productProperty->id}}">
                                        <div class="card">
                                            <div class="card-header">
                                                Dung tích:{{$productProperty->property->name}}
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="">Giá</label>
                                                    <input class="form-control" type="text" name="price_product" id="price_product{{$productProperty->id}}" value="{{$productProperty->price_product}}" >
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">Số lượng</label>
                                                    <input class="form-control" type="number" name="propertyQuantity" id="propertyQuantity{{$productProperty->id}}" value="{{$productProperty->quantity}}" >
                                                </div>
                                                <div class="mb-3">
                                                    <img src="{{ asset('admin/products/'.$productProperty->image) }}" height="150px" width="150px" alt="">
                                                    <input type="file" class="form-control" name="image" id="image{{$productProperty->id}}">
                                                </div>
                                                <div class="mb-3">

                                                    <button type="button" class="btn btn-info update-property-btn" data-property-id="{{$productProperty->id}}" >Cập nhật</button>

                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteProperty_{{$productProperty->id}}">Xóa</button>
                                                    <div class="modal fade" id="deleteProperty_{{$productProperty->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Xóa dung tích</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            Dữ liệu dung tích này sẽ bị xóa, bạn có muốn?
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-info" data-dismiss="modal">Không</button>
                                                            <button type="button" data-property-id="{{$productProperty->id}}" class="btn btn-danger deleteProperty_btn">Có</button>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addProperty">Thêm dung tích</button>
                                <div class="modal fade" id="addProperty" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Thêm dung tích</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <label for="">Chọn dung tích</label>
                                            <select class="form-control" name="property_id" id="property_id">
                                                @foreach ($properties as $property)
                                                    <option  value="{{$property->id}}">{{$property->name}}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                          <div class="mb-3">
                                            <label for="">Nhập giá</label>
                                            <input type="number" name="price_product" id="price_product" class="form-control">
                                          </div>
                                          <div class="mb-3">
                                            <label for="">Nhập số lượng</label>
                                            <input type="number" name="quantity" id="quantity" class="form-control">
                                          </div>
                                          <div class="mb-3">
                                            <label for="">Hinh ảnh</label>
                                            <input type="file" name="image" id="image" class="form-control">
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                          <button type="button" class="btn btn-primary addProperty_btn" data-product-id="{{$product->id}}">Lưu</button>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Miêu tả ngắn</label>
                        <textarea name="small_desc" id="small_desc" class="form-control">{{$product->small_desc}}</textarea>
                        @error('small_desc') <small class="text-danger">{{$message}}</small>   @enderror

                    </div>
                    <div class="mb-3">
                    <label for="" class="form-label">Miêu tả chi tiết</label>
                    <textarea name="desc" id="desc" class="form-control">{{$product->desc}}</textarea>
                    @error('desc') <small class="text-danger">{{$message}}</small>   @enderror

                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-info">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('pushjs')
    <script>
        $(document).ready(function() {
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

            $('.deleteProperty_btn').on('click',function(){
                var id = $(this).data('property-id');
                var toRemove = document.querySelector('#property_product_item_' + id);
                $.ajax({
                    url: '/admin/product/deletePropertyProduct/'+id,
                    type: 'POST',
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        // Xử lý phản hồi từ máy chủ, ví dụ: cập nhật giao diện người dùng
                        if (response.success === 'true') {
                            // Xóa card màu sau khi xóa thành công
                            alert("Xóa dung tích sản phẩm thành công!");
                            $('#deleteProperty_' + id).modal('hide');
                            toRemove.remove();
                        } else {
                            alert('Lỗi khi xóa dung tích sản phẩm.');
                        }
                    },
                    error: function() {
                        // Xử lý lỗi (nếu có)
                        alert('Lỗi khi gửi yêu cầu xóa dung tích sản phẩm.');
                    }
                })
            });

            $('.addProperty_btn').on('click',function(){
                var product_id = $(this).data('product-id');
                var property_id = $('#property_id').val();
                var price_product = $('#price_product').val();
                var quantity = $('#quantity').val();
                var imageInput = $('#image')[0].files[0];

                var formData = new FormData();
                formData.append('price_product', price_product);
                formData.append('property_id', property_id);
                formData.append('quantity', quantity);
                formData.append('product_id', product_id);
                formData.append('image', imageInput);

                console.log(formData);
                $.ajax({
                    url: '/admin/product/addPropertyProduct/'+product_id,
                    type: 'POST',
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            console.log(response);
                            // Xử lý phản hồi từ server, ví dụ: hiển thị thông báo hoặc làm gì đó khác
                            alert("Thêm dung tích sản phẩm thành công!");
                            // Đóng modal
                            $('#addProperty').modal('hide');
                            location.reload();
                        } else {
                            alert('Lỗi khi thêm dung dịch sản phẩm.');
                        }
                    },
                    error: function() {
                        // Xử lý lỗi (nếu có)
                        alert("Lỗi kết nối");
                    }
                });
            });



            $('.update-property-btn').on('click', function () {
                var id = $(this).data('property-id');
                var product_id = "{{ $product->id }}";
                var price_product = $("#price_product" + id).val();
                var quantity = $('#propertyQuantity' + id).val();

                // Thêm đoạn mã để lấy ảnh mới
                var imageInput = $('#image' + id)[0].files[0];
                var formData = new FormData();
                formData.append('price_product', price_product);
                formData.append('quantity', quantity);
                formData.append('product_id', product_id);
                formData.append('image', imageInput);

                $.ajax({
                    url: "/admin/product-property/" + id,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        alert(response.message)
                        location.reload();  
                    },
                    error: function () {
                        alert('Lỗi kết nối')
                    }
                })
            })

        });
    </script>
@endsection