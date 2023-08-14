@extends('layouts.master')
@section('content')
    <div class="col-12 col-md-12 mt-2">
        <div class="card">
            <h5 class="card-header">Thêm mới khách hàng</h5>
            <div class="card-body">
                <form method="post" action="{{ route('customers.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Tên khách hàng</label>
                        <input type="text" name="name" class="form-control" id="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Ngày sinh</label>
                        <input type="date" name="dob" class="form-control" id="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" aria-describedby="emailHelp">
                    </div>
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <label for="" class="col-form-label">Tỉnh thành</label>
                        </div>
                        <div class="col">
                            <select class="form-control" name="city_id">
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
