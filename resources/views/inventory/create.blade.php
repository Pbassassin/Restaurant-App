@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="fs-2 fw-bold" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
            Add Inventory
        </h1>
    </div>
    <h3 class="border border-2 border-dark mx-3 mb-5 mt-2"></h3>

    <div class="container bg-white p-4 rounded shadow">
        <form class="" method="POST" action="/inventory">
            @csrf
            <div class="row">
                <div class="col">
                    Name: <input class="form-control" type="text" name="name"><br>
                </div>
                <div class="col">
                    Quantity: <input class="form-control" type="text" name="quantity"><br>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Unit: <input class="form-control" type="text" name="unit"><br>
                </div>
                <div class="col">
                    Min Level: <input class="form-control" type="text" name="min_level"><br>
                </div>
            </div>
            <button class="btn btn-warning" type="submit">Save</button>
        </form>
    </div>
@endsection