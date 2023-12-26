@extends('layouts.admin')

@section('title')
Mã khuyến mãi!
@endsection

@section('content')

<div>
    <div class="card">
        <div class="card-header">
           <div class="row">
                <h4>Chương trình khuyến mãi</h4>
                <a href="{{url('admin/promotion/create')}}" class="btn btn-success btn-sm ml-auto">Thêm</a>
           </div>
        </div>
        <div class="card-body">
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                       
                        <th>Mã khuyến mãi</th>
                        <th>Mực khuyễn mãi</th>
                        <th>Ngày hết hạn</th>
                        <th>Tình trạng</th>
                        <th>Xử lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($promotions as $i)
                    <tr>
                        <td>{{ $i->code }}</td>
                        <td>
                            {!! $i->discount_percentage !!}&percnt;
                        </td>
                        <td>{{ $i->expiration_date }}</td>
                        <td>
                            {{ $i->status == 1 ? 'Đang áp dụng' : 'Chưa áp dụng' }}
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection