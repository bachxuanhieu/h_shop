@extends('layouts.admin')

@section('title')
Danh mục sản phẩm
@endsection

@section('content')

<div>
    <div class="card">
        <div class="card-header">
           <div class="row">
                <h4>Danh mục sản phẩm </h4>
                <a href="{{route('admin.category.create')}}" class="btn btn-success btn-sm ml-auto">Thêm danh mục</a>
           </div>
        </div>
        <div class="card-body">
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên danh mục</th>
                        <th>Hiện thị</th>
                        <th>Xử lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $i)
                    <tr>
                        <td>{{ $i->id }}</td>
                        <td>
                            <img src="{{asset('admin/image/category/'.$i->image)}}" height="100px" width="100px" alt="">
                        </td>
                        <td>{{ $i->name }}</td>
                        <td>
                            {{ $i->status == 1 ? 'Hiện Thị' : 'Đang ẩn' }}
                        </td>
                        <td>
                            <a href="{{url('admin/category/edit/'.$i->id)}}" class="btn text-info"><i class="fa-solid fa-pen-to-square"></i></a>
                             {{-- nút ẩn =====================================================================================================================--}}
                             <button class="btn text-warning"><i class="fa-solid fa-eye-slash"></i></button>
                            {{-- nút xóa ====================================================================================================================--}}
                            <button type="button" class="btn text-danger" data-toggle="modal" data-target="#deleteCategory_{{$i->id}}"><i class="fa-solid fa-trash-can"></i></button>
                            <div class="modal fade" id="deleteCategory_{{$i->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Xóa danh mục sản phẩm</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        Dữ liệu danh mục sẽ bị xóa. Bạn muốn tiếp tục?
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Không</button>
                                      <button type="button" data-category-id="{{ $i->id }}" class="btn btn-danger btn-sm deleteCategory-btn">Có</button>
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
    </div>
</div>



@endsection

@section('pushjs')

<script>
   $(document).ready(function(){
         // Thay đổi tên class và sử dụng data-category-id
        $('.deleteCategory-btn').on('click', function () {
            var categoryId = $(this).data('category-id');
            // var rowToRemove = $(this).closest('tr');
            $.ajax({
                type: 'DELETE',
                url: '/admin/category/' + categoryId,
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
            });
        });
   });
   
</script>

@endsection