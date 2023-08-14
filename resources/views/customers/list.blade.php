@extends('layouts.master')
@section('content')
    <div class="col-12 col-md-12 mt-2">
        <div class="card">
            <h5 class="card-header">Danh sách khách hàng</h5>
            <div class="card-body">
                <div class="col-6">
                    <form class="navbar-form navbar-left" method="GET" action="{{ route('customers.search') }}">
                        @csrf
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Search">
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên khách hàng</th>
                        <th scope="col">Ngày sinh</th>
                        <th scope="col">Email</th>
                        <th scope="col">Địa chỉ</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $index => $customer)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->dob }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->city ? $customer->city->name : 'Không có dữ liệu' }}</td>
                            <td>
                                <a onclick="return confirm('Are you sure?')" href="{{ route('customers.delete', $customer->id) }}" class="btn btn-danger">Delete</a>
                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary">Update</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $customers->appends(request()->query()) }}
            </div>
        </div>
    </div>

@endsection
