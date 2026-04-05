@extends('layouts.app')
@section('content')
    <div class="container mt-5 d-flex justify-content-between">
        <h1 class="fs-2 fw-bold" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
            Tables
        </h1>
        <a href="/tables/create" class="btn btn-success">Add Table</a>
    </div>
    <h3 class="border border-2 border-dark mx-3 mb-5 mt-2"></h3>

    <div class="container bg-white rounded shadow p-4 my-5">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Capacity</th>
                <th>Action</th>
            </tr>

            @foreach ($tables as $t)
                <tr>
                    <td>{{ $t->name }}</td>
                    <td>
                        <img src="{{ asset($t->image) }}" width="100">
                    </td>
                    <td>{{ $t->capacity}}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a class="btn btn-dark" href="/tables/{{ $t->id}}/edit">Edit</a>
                            <form method="POST" action="/tables/{{ $t->id }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger" type="submit">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach

        </table>

    </div>
@endsection