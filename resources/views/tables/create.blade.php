@extends('layouts.app')
@section('content')

    <div class="container">
        <h1 class="fs-2 fw-bold" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
            Add New Table
        </h1>
    </div>
    <h3 class="border border-2 border-dark mx-3 mb-5 mt-2"></h3>

    <div class="container bg-white rounded shadow my-5 p-4">
        <form method="POST" action="/tables">
            @csrf
            Name: <input type="text" name="name" class="form-control"><br>
            Image: <input type="text" name="image" class="form-control" placeholder="images/table 1.jpg"><br>
            Capacity: <input type="number" name="capacity" class="form-control"><br><br>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>

@endsection