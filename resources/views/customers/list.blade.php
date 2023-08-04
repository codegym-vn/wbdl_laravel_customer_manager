@extends('layouts.master')
@section('content')
    <div class="col-12 col-md-12 mt-2">
        <div class="card">
            <h5 class="card-header">Danh sách khách hàng</h5>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên khách hàng</th>
                        <th scope="col">Ngày sinh</th>
                        <th scope="col">Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Join</td>
                        <td>19/09/1993</td>
                        <td>join@gmail.com</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>20/01/1990</td>
                        <td>ja@gmail.com</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Thornton</td>
                        <td>20/01/1980</td>
                        <td>thornton@gmail.com</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
