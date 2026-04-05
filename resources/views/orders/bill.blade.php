@extends('layouts.app')
@section('content')
    <div class="container text-center">
        <h1 class="fs-2 fw-bold text-center"
            style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
            Invoice
        </h1>
        <h3 class="border border-2 border-dark mx-3 mb-4 mt-2"></h3>

        <div class="d-flex justify-content-evenly mb-2">
            <p><strong>Order ID: </strong>{{ $order->id }}</p>
            <p><strong>Status: </strong>{{ $order->status }}</p>
        </div>

        <table class="table table-striped table-bordered border-dark">

            <tr class="table-dark">
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>

            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->menuItem->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->price * $item->quantity }}</td>
                </tr>
            @endforeach

            <tr>
                <th colspan="1"></th>
                <th colspan="2">Grand Total</th>
                <td colspan="1"> <strong>₹{{ $order->total_amount }}</strong></td>
            </tr>

        </table>

        <div class="text-center">
            <button onclick="window.print()" class="btn btn-primary mt-3 no-print">Print Bill</button>
            <a href="/orders/{{ $order->id }}/pdf" class="btn btn-danger mt-3 no-print">Download PDF</a>
        </div>

@endsection