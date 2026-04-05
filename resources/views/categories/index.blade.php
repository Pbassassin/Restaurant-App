@extends('layouts.app')


@section('content')
    <div class="container mt-5 d-flex justify-content-between">
        <h1 class="fs-2 fw-bold" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
            Categories
        </h1>
        <a href="/categories/create" class="btn btn-success">Add Category</a>
    </div>
    <h3 class="border border-2 border-dark mx-3 mb-5 mt-2"></h3>


    <div class="container bg-white p-4 rounded shadow">
        <table class="table table-bordered border-dark table-striped">
            <tr class="table table-dark">
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>

            @foreach ($categories as $cat)
                <tr>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->description }}</td>
                    <td class="d-flex gap-2">
                        <a class="btn btn-sm btn-dark" href="/categories/{{ $cat->id}}/edit">Edit</a>
                        <form method="POST" action="/categories/{{ $cat->id }}">
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