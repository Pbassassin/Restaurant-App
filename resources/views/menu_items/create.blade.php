@extends("layouts.app")
@section('content')

    <div class="container mt-5">
        <h1 class="fs-2 fw-bold" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
            Add New Menu Item
        </h1>
    </div>
    <h3 class="border border-2 border-dark mx-3 mb-5 mt-2"></h3>

    <div class="container bg-white p-4 rounded shadow">
        <form class="" method="POST" action="/menu-items">

            @csrf
            Name: <input class="form-control" type="text" name="name"><br>
            Description: <textarea class="form-control" name="description"></textarea><br>
            <div class="row">
                <div class="col">
                    Price: <input class="form-control" type="text" name="price"><br>
                </div>
                <div class="col">
                    Category: <select class="form-select" name="category_id">
                        <option selected disabled>--select--</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            Available: <input class="ms-1 form-check-input" type="checkbox" name="is_available" value="1"><br><br>
            <button class="btn btn-success" type="submit">Save</button>

        </form>
    </div>

@endsection