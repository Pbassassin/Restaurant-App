@extends('layouts.app')
@section('content')

    <div class="container mt-5 d-flex justify-content-between">
        <h1 class="fs-2 fw-bold" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
            Orders
        </h1>
        <a href="/orders/create" class="btn btn-success">New Order</a>
    </div>
    <h3 class="border border-2 border-dark mx-3 mb-5 mt-2"></h3>

    <div class="container bg-white p-4 rounded shadow">
        <table class="table table-bordered table-striped border-dark">
            <tr class="table-dark">
                <th>ID</th>
                <th>Customer</th>
                <th>Status</th>
                <th></th>
            </tr>

            @foreach ($orders as $o)
                <tr>
                    <td>{{$o->id}}</td>
                    <td>{{$o->customer_id}}</td>
                    <td>{{$o->status}}</td>
                    <td>
                        <a class="btn btn-sm btn-outline-success" href="/orders/{{ $o->id }}">View</a>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>

@endsection