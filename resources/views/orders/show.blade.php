@extends('layouts.app')
@section('content')

    @if (session('error'))
        <p style="color: red;">{{ session('error')}}</p>
    @endif

    <div class="container d-flex align-items-center justify-content-between">
        <h1 class="fs-2 fw-bold" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
            Order {{$order->id}}
        </h1>
        <a href="/orders/{{ $order->id }}/bill" class="btn btn-outline-dark">View Bill</a>
    </div>
    <h3 class="border border-2 border-dark mx-3 mb-5 mt-2"></h3>


    <div class="container bg-white rounded shadow my-4">
        <div class="row p-3">
            <div class="col-5">
                <b>Status:</b> {{ $order->status }} <br>
            </div>
            <div class="col-5">
                <b>Total: ₹</b>{{$order->total_amount }}
            </div>
            <div class="col-2">
                <form method="POST" action="/orders/{{ $order->id }}/complete">
                    @csrf
                    <button class="btn btn-success" type="submit">Mark as Complete</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container bg-white p-4 rounded shadow">

        <h3 class="">Add Item</h3>
        <form method="POST" action="/order-items">
            @csrf

            <input type="hidden" name="order_id" value="{{ $order->id }}">

            <div class="row align-items-end">

                <div class="col-md-5">
                    <label class="form-label">Item</label>
                    <select class="form-select" name="menu_item_id">
                        <option selected disabled>--select--</option>
                        @foreach ($menu as $m)
                            <option value="{{ $m->id }}">
                                {{ $m->name }} ({{ $m->price }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-5">
                    <label class="form-label">Quantity</label>
                    <input class="form-control" name="quantity" value="1">
                </div>

                <div class="col-md-2">
                    <button class="btn btn-success w-100" type="submit">Add</button>
                </div>

            </div>
        </form>

        <h3 class="mt-4">Items</h3>

        <table class="table table-bordered table-striped border-dark">
            <tr class="table-dark">
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>

            @foreach ($order->items as $i)
                <tr>
                    <td>{{ $i->menuItem->name}}</td>
                    <td>{{ $i->quantity}}</td>
                    <td>₹{{ $i->price}}</td>
                    <td>
                        <form method="POST" action="/order-items/{{ $i->id }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </table>

    </div>
    <div class="container bg-white p-4 rounded shadow mt-4">
        <h3 class="">Suggestions</h3>
        <table class="table table-bordered table-striped border-dark">
            <tr class="table-dark">
                <th>Item</th>
                <th>Price</th>
                <th>%</th>
            </tr>
            @foreach ($suggestions as $s)
                <tr>
                    <td>{{ $s['item']->name }}</td>
                    <td>₹{{ $s['item']->price }}</td>
                    <td>
                        (Support: {{ round($s['support'] * 100, 2) }} %,
                        Confidence: {{ round($s['confidence'] * 100, 2) }} %)
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection