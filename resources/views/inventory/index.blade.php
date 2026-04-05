@extends('layouts.app')
@section('content')
    <div class="container mt-5 d-flex justify-content-between">
        <h1 class="fs-2 fw-bold" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
            Inventory
        </h1>
        <a href="/inventory/create" class="btn btn-success">Add Inventory</a>
    </div>
    <h3 class="border border-2 border-dark mx-3 mb-5 mt-2"></h3>

    <div class="container bg-white p-4 rounded shadow">

        <table class=" table table-bordered table-striped border-dark">
            <tr class="table-dark">
                <th>Name</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Min</th>
                <th>Action</th>
            </tr>

            @foreach ($items as $i)
                <tr>
                    <td>{{ $i->name }}</td>
                    <td>{{ $i->quantity }}
                        @if ($i->quantity <= $i->min_level)
                            <span style="color: red;">Low</span>
                        @endif
                    </td>
                    <td>{{ $i->unit}}</td>
                    <td>{{ $i->min_level }}</td>
                    <td class="d-flex gap-2">
                        <a class="btn btn-sm btn-dark" href="/inventory/{{ $i->id }}/edit">Edit</a>
                        <form method="POST" action="/inventory/{{ $i->id }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>

@endsection