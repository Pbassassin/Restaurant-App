@extends('layouts.app')
@section('content')

    <div class="container">
        <h1 class="fs-2 fw-bold" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
            Edit Category
        </h1>
    </div>
    <h3 class="border border-2 border-dark mx-3 mb-5 mt-2"></h3>

    <div class="container bg-white p-4 rounded shadow">
        <form class="" method="POST" action="/categories/{{ $category->id }}">
            @csrf
            @method('PUT')
            Name: <input class="form-control" type="text" name="name" value="{{ $category->name }}"><br>
            Description: <textarea class="form-control" type="text" name="description"
                value="{{ $category->description}}"></textarea><br>
            <button class="btn btn-success" type="submit">update</button>
        </form>
    </div>

@endsection