@extends('layouts.app')
@section('content')
    <div class="container mt-5 d-flex justify-content-between">
        <h1 class="fs-2 fw-bold" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
            Bookings
        </h1>
        <a href="/bookings/create" class="btn btn-success">New Booking</a>
    </div>
    <h3 class="border border-2 border-dark mx-3 mb-5 mt-2"></h3>

    <div class="container bg-white p-4 rounded shadow">
        <table class="mt-3 table table-bordered border-dark table-striped">
            <tr class="table-dark">
                <th>Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>People</th>
                <th>Table</th>
            </tr>

            @foreach ($bookings as $b)
                <tr>
                    <td>{{ $b->name }}</td>
                    <td>{{ $b->date }}</td>
                    <td>{{ $b->time }}</td>
                    <td>{{ $b->people }}</td>
                    <td>{{ $b->table->name }}</td>
                </tr>
            @endforeach

        </table>
    </div>

@endsection