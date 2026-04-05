@extends('layouts.app')
@section('content')

    <div class="container mt-5 d-flex justify-content-between">
        <h1 class="fs-2 fw-bold" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
            Menu Items
        </h1>
        <a href="/menu-items/create" class="btn btn-success">Add Item</a>
    </div>
    <h3 class="border border-2 border-dark mx-3 mb-5 mt-2"></h3>

    <div class="container bg-white p-4 rounded shadow">

        <table class=" mt-3 table table-bordered table-striped">
            <tr class="table-dark">
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Available</th>
                <th>Action</th>
            </tr>

            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>₹{{ $item->price }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>{{ $item->is_available ? 'Yes' : 'No' }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a class="btn btn-sm btn-dark" href="/menu-items/{{ $item->id }}/edit">Edit</a>
                            <form method="POST" action="/menu-items/{{ $item->id }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>
    </div>
@endsection