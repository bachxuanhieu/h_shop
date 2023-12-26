@extends('layouts.admin')

@section('title')
Thanh trượt
@endsection

@section('content')


<div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4>Thanh trượt</h4>
                <a class="btn btn-info ml-auto" href="{{url('admin/sliders/create')}}">Thêm</a>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th width="60">ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên</th>
                        {{-- <th>Miêu tả</th> --}}
                        <th width="100">Trạng thái</th>
                        <th width="100">Xử lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sliders as $slider)
                        <tr>
                            <td>{{$slider->id}}</td>
                            <td>
                                @if (isset($slider->image))
                                <img src="{{asset('admin/image/sliders/'.$slider->image)}}" alt="{{$slider->name}}" height="100px" width="300px">
                                @else
                               không có hình ảnh
                               @endif

                            </td>
                            
                            <td>{{$slider->name}}</td>
                            {{-- <td>{{$slider->desc}}</td> --}}
                    
                            <td>{{$slider->status == 1 ? 'Hiện thị' : 'Đang ẩn'}}</td>
                            <td>
                               
                                <a class="btn text-info" href="{{url('/admin/sliders/edit/'.$slider->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>

                              
                                <button type="button" class="btn text-danger" data-toggle="modal" data-target="#deleteSlider_{{$slider->id}}"><i class="fa-solid fa-trash-can"></i></button>
                                <div class="modal fade" id="deleteSlider_{{$slider->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Xóa thanh trượt</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            Dữ liệu thanh trượt sẽ bị xóa. Bạn muốn tiếp tục?
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Không</button>
                                          <button type="button" data-slider-id="{{ $slider->id }}" class="btn btn-danger btn-sm deleteSlider-btn">Có</button>
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
     
   
</script>

@endsection