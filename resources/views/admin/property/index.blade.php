@extends('layouts.admin')

@section('title')
Thuộc tính
@endsection

@section('content')



<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Thuộc tính</h1>
            </div>
            <div class="col-sm-6 text-right">
                <button href="#" class="btn btn-primary" data-toggle="modal" data-target="#addProperty">Thêm thuộc tính</button>
                <div class="modal fade" id="addProperty" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Thêm thuộc tính</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="mb-3">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Tên thuộc tính">
                          </div>
                          <div class="mb-3">
                            <input type="text" name="desc" id="" class="form-control desc" placeholder="Miêu tả">
                          </div>
                          <div class="mb-3">
                            <select name="status" id="status" class="form-control">
                                <option value="1">Hiện</option>
                                <option value="0">Ẩn</option>
                            </select>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                          <button type="button" class="btn btn-primary add_property_btn">Lưu</button>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <div class="input-group input-group" style="width: 250px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Tìm kiếm...">
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">								
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Tên</th>
                            <th>Miêu tả</th>
                            <th width="100">Trạng thái</th>
                            <th width="100">Xử lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($properties as $property )
                        <tr>
                            <td>{{$property->id}}</td>
                            <td>{{$property->name}}</td>
                            <td>
                                {{$property->desc}}
                            </td>                
                            <td>
                                {{ $property->status == 1 ? 'Hiện Thị' : 'Đang ẩn' }}
                            </td>
                            <td>
                                {{-- nút ẩn =====================================================================================================================--}}
                                {{-- <button class="btn text-warning"><i class="fa-solid fa-eye-slash"></i></button>

                                <a href="{{url('admin/subcategory/edit/'.$sub->id)}}" class="btn text-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                --}}
                                {{-- nút xóa ====================================================================================================================--}}
                                {{-- <button type="button" class="btn text-danger" data-toggle="modal" data-target="#deleteSub_{{$sub->id}}"><i class="fa-solid fa-trash-can"></i></button>
                                <div class="modal fade" id="deleteSub_{{$sub->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Xóa danh mục con</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            Dữ liệu danh mục con sẽ bị xóa. Bạn muốn tiếp tục?
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Không</button>
                                          <button type="button" data-sub-id="{{ $sub->id }}" class="btn btn-danger btn-sm deleteSub-btn">Có</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>										
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>




@endsection

@section('pushjs')

<script>
   $(document).ready(function(){
//          // Thay đổi tên class và sử dụng data-category-id
//         $('.deleteSub-btn').on('click', function () {
//             var subId = $(this).data('sub-id');
//             // var rowToRemove = $(this).closest('tr');
//             $.ajax({
//                 type: 'DELETE',
//                 url: '/admin/subcategory/' + subId,
//                 headers: {
//                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                 },
//                 success: function (data) {
//                     alert(data.message);
                
//                     location.reload();
//                 },
//                 error: function (data) {
//                     console.error('Lỗi xóa danh mục:', data.responseJSON.message);
//                 }
//             });
//         });
        $('.add_property_btn').on('click',function(){
          
            var name = $('#name').val();
            var desc = $('.desc').val();
            var status = $('#status').val();

            var data = {
                name: name,
                desc: desc,
                status: status
            };
            console.log(data);
            $.ajax({
                type: 'POST',
                url: '/admin/property',
                data: data,
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                success: function(response){
                  console.log(response);
                    if (response.success) {
                        // Thêm dòng mới vào bảng dữ liệu
                    
                        var newRow = '<tr>' +
                            '<td>' + response.id + '</td>' +
                            '<td>' + name + '</td>' +
                            '<td>' + desc + '</td>' +
                            '<td>' +  (status == 1 ? 'Hiện thị' : 'Đang ẩn') + '</td>' +
                            '<td>' +
                            // Thêm các nút sửa và xóa
                            '</td>' +
                            '</tr>';
                          
                        $('table tbody').append(newRow);

                        // // Đóng modal và xóa dữ liệu trong form
                        alert('Thêm thuộc tính thành công');
                        $('#addProperty').modal('hide');
                    
                    } else {
                        alert("Lỗi thêm thuộc tính");
                    }
                },error: function(){
                    alert('Lỗi kết nối')
                }
            })
        })
   });
   
</script>

@endsection