@extends('layouts.master')
@section('content')
    <div class="col-12 col-md-12 mt-2">
        <div class="card">
            <h5 class="card-header">Cập nhật thông tin khách hàng</h5>
            <div class="card-body">
                <form method="post" action="{{ route('customers.edit', $customer->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Tên khách hàng</label>
                        <input type="text" name="name" value="{{ $customer->name }}" class="form-control" id="" >
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Ngày sinh</label>
                        <input type="date" name="dob" value="{{ $customer->dob }}" class="form-control" id="" >
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" value="{{ $customer->email }}" class="form-control" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>

@endsection
