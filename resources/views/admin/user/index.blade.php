@extends('layouts.admin')

@section('title')
Tài khoản
@endsection

@section('content')



<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tài khoản</h1>
            </div>
            <div class="col-sm-6 text-right">
                {{-- <a href="{{url('/admin/user/create')}}" class="btn btn-primary">Thêm danh tài khoản</a> --}}
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
                            <th>Email</th>
                         
                           
                            <th width="100">Loại</th>
                            <th width="100">Xử lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user )
                    
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>
                                {{$user->email}}
                            </td>
                           
                                         
                            <td>
                                {{ $user->role == 1 ? 'Quản lý' : 'Người dùng' }}
                            </td>
                            <td>
                                {{-- nút ẩn =====================================================================================================================--}}
                                <button class="btn text-warning"><i class="fa-solid fa-eye-slash"></i></button>

                                <a href="" class="btn text-info"><i class="fa-solid fa-pen-to-square"></i></a>
                               
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

{{-- <script>
   $(document).ready(function(){
         // Thay đổi tên class và sử dụng data-category-id
        $('.deleteSub-btn').on('click', function () {
            var subId = $(this).data('sub-id');
            // var rowToRemove = $(this).closest('tr');
            $.ajax({
                type: 'DELETE',
                url: '/admin/subcategory/' + subId,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    alert(data.message);
                
                    location.reload();
                },
                error: function (data) {
                    console.error('Lỗi xóa danh mục:', data.responseJSON.message);
                }
            });
        });
   });
   
</script> --}}

@endsection