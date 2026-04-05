@extends('layouts.app')
@section('content')

    <div class="container mt-5 d-flex justify-content-between">
        <h1 class="fs-2 fw-bold" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
            Edit Menu
        </h1>
    </div>
    <h3 class="border border-2 border-dark mx-3 mb-5 mt-2"></h3>

    <div class="container bg-white p-4 rounded shadow">
        <form class="" method="POST" action="/menu-items/{{ $item->id }}">
            @csrf
            @method('PUT')

            Name: <input class="form-control" type="text" name="name" value="{{ $item->name }}"><br>
            Description: <textarea class="form-control" name="description" value="{{ $item->description }}"></textarea><br>
            <div class="row">
                <div class="col">
                    Price: <input class="form-control" type="text" name="price" value="{{ $item->price }}"><br>
                </div>
                <div class="col">
                    Category: <select class="form-select" name="category_id">
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $item->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select><br>
                </div>
            </div>
            Available: <input class="ms-1 form-check-input" type="checkbox" name="is_available" value="1" {{ $item->is_available ? 'checked' : '' }}><br><br>
            <button class="btn btn-warning" type="submit">Update</button>
        </form>
    </div>

@endsection