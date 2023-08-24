@extends('layouts.master')
@section('content')
    <div class="col-12 col-md-12 mt-2">
        <div class="card">
            <h5 class="card-header">{{ __('message.list_customers') }}</h5>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('message.name_customer') }}</th>
                        <th scope="col">{{ __('message.birth_day') }}</th>
                        <th scope="col">Email</th>
                        <th scope="col">{{ __('message.address') }}</th>
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
            </div>
        </div>
    </div>

@endsection
