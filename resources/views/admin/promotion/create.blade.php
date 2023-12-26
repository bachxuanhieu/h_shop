@extends('layouts.admin')

@section('title')
Thêm mã khuyến mãi
@endsection

@section('content')

<div>
    <div class="card">
        <div class="card-header">
           <div class="row">
                <h4>Thêm mã khuyến mãi</h4>
                <a href="{{url('/admin/promotion')}}" class="btn btn-success btn-sm ml-auto">Quay lại</a>
           </div>
        </div>
        <section class="content">
            <div class="card-body">
            <form action="{{url('/admin/promotion')}}" method="POST">
                @csrf
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">Mã khuyến mãi</label>
                                <input type="text" name="code" id="code" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="discount_percentage" class="form-label">Mức khuyến mãi</label>
                                <div class="input-group">
                                    <input type="number" name="discount_percentage" id="discount_percentage" class="form-control" min="0" max="100" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="expiration_date" class="form-label">Ngày hết hạn</label>
                                <input type="date" name="expiration_date" id="expiration_date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Áp dụng</label> 
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Có</option>
                                    <option value="0">Không</option>
                                </select>
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

