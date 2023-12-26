@extends('layouts.admin')

@section('title')
Sản phẩm
@endsection

@section('content')

<div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4>Sản phẩm</h4>
                <a class="btn btn-info ml-auto" href="{{route('admin.product.create')}}">Thêm sản phẩm</a>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th width="60">ID</th>
                        <th>Hình ảnh</th>
                        <th>Danh mục sản phẩm</th>
                        <th>Tên</th>
                     
                        <th>Giá khuyến mãi</th>
                        <th width="100">Trạng thái</th>
                        <th width="100">Xử lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>
                                @if (isset($product->productImages[0]))
                                <img src="{{asset($product->productImages[0]->image)}}" alt="{{$product->name}}" height="100px" width="100px">
                                @else
                               không có hình ảnh
                               @endif

                            </td>
                            <td>
                                @if ($product->category)
                                    {{$product->category->name}}
                                @else
                                    Không có danh mục 
                                @endif
                            
                            </td>
                            <td>{{$product->name}}</td>
                            <td>{{ number_format($product->selling_price,0, '.','.') }}đ</td>
                            <td>{{$product->status == 1 ? 'Hiện thị' : 'Đang ẩn'}}</td>
                            <td>
                                {{-- nút sửa sản phẩm --}}
                                <a class="btn text-info" href="{{url('/admin/product/edit/'.$product->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>

                                {{-- Nút xóa sản phẩm --}}
                                <button type="button" class="btn text-danger" data-toggle="modal" data-target="#deleteProduct_{{$product->id}}"><i class="fa-solid fa-trash-can"></i></button>
                                <div class="modal fade" id="deleteProduct_{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Xóa sản phẩm</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            Dữ liệu sản phẩm  sẽ bị xóa. Bạn muốn tiếp tục?
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Không</button>
                                          <button type="button" data-product-id="{{ $product->id }}" class="btn btn-danger btn-sm deleteProduct-btn">Có</button>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- <div>{!! $products->links() !!}</div> --}}
    </div>
</div>





@endsection

@section('pushjs')

<script>
      $(document).ready(function() {
        $('.deleteProduct-btn').on('click', function () {
            var productId = $(this).data('product-id');
            console.log(productId);
            // var rowToRemove = $(this).closest('tr');
            $.ajax({
                type: 'DELETE',
                url: '/admin/product/'+productId,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    alert(data.message);
                    // $('#deleteCategory_'+categoryId).modal('hide');
                    // rowToRemove.remove();
                    location.reload();
                },
                error: function (data) {
                    console.error('Lỗi xóa danh mục:', data.responseJSON.message);
                }
                })
            })
        });
   
</script>

@endsection