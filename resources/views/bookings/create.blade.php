@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="fs-2 fw-bold" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
            Book Table
        </h1>
    </div>
    <h3 class="border border-2 border-dark mx-3 mb-5 mt-2"></h3>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container bg-white p-4 rounded shadow">
        <form method="POST" action="/bookings">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    Name: <input class="form-control" type="text" name="name">
                </div>
                <div class="col">
                    Phone: <input class="form-control" type="tel" name="phone">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    Date: <input class="form-control" type="date" name="date">
                </div>
                <div class="col">
                    Time: <input class="form-control" type="time" name="time">
                </div>
            </div>
            People: <input class="form-control mb-3" type="number" name="people">

            Select Table:
            <div class="row mt-2">
                @foreach ($tables as $t)
                    <div class="col-md-3">
                        <label class="card p-2 text-centered align-items-center justify-content-center">
                            <strong class="mb-2">{{ $t->name }}</strong>
                            <img src="{{ asset($t->image) }}" class="img-fluid rounded" style="max-height: 180px;">
                            <input class="form-check-input mt-3 mb-2 text-centered" type="radio" name="table_id"
                                value="{{ $t->id}}" required>
                        </label>
                    </div>
                @endforeach ($tables as $t)

            </div>

            <button class="mt-4 btn btn-primary" type="submit">Book <Table></Table></button>
        </form>
    </div>

@endsection