@extends('layouts.app')
@section('content')

    <div class="container">
        <h1 class="fs-2 fw-bold" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
            New Order
        </h1>
    </div>
    <h3 class="border border-2 border-dark mx-3 mb-5 mt-2"></h3>
    <div class="container bg-white p-4 rounded shadow">
        <form class="" method="POST" action="/orders">
            @csrf
            <div class="row">
                <div class="col-6">
                    Name: <input class="form-control" name="name"><br>
                </div>
                <div class="col">
                    Phone: <input type="tel" class="form-control" name="phone"><br>
                </div>
            </div>
            Email: <input class="form-control" name="email"><br>
            <button class="btn btn-warning" type="submit">Create Order</button>
        </form>
    </div>

@endsection