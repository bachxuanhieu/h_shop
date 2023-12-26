@extends('layouts.admin')

@section('title')
Thay đổi mật khẩu
@endsection

@section('content')

<div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Thay đổi mật khẩu</h5>
        </div>
        <div class="card-body">
            <form action="{{route('admin.update.password')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Mật khẩu cũ</label>
                    <input type="password" name="old_password" id="old_password" autocomplete="off" class="form-control  @error('old_password') is-invalid @enderror">
                    @error('old_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3" class="form-label">
                    <label for="">Mật khẩu mới</label>
                    <input type="password" name="new_password" id="new_password" autocomplete="off" class="form-control  @error('new_password') is-invalid @enderror">
                    @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3" class="form-label">
                    <label for="">Xác nhận mật khẩu</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" autocomplete="off" class="form-control">
                  
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


@endsection