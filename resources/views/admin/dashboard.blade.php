@extends('layouts.app')
@section('content')

    <div class="container bg-white shadow rounded p-4">

        <h1>Admin Dashboard</h1>

        <h3>Total Orders: {{ $totalOrders}}</h3>
        <h3>Total Revenue: {{ $totalRevenue}}</h3>

        <hr>

        <h3>Top Selling Items</h3>

        <table class="table table-bordered table-stripped">
            <tr>
                <th>Item</th>
                <th>Quantity</th>
            </tr>
            @foreach ($topItems as $t)
                <tr>
                    <td>{{ $t->menuItem->name ?? 'N/A' }}</td>
                    <td>{{ $t->total }}</td>
                </tr>
            @endforeach
        </table>

        <hr>

        <h3>Low Stock Alert</h3>

        <table class="mb-5" border="1">
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                @foreach ($lowStock as $i)
                    <tr style="color:red">
                        <td>$i->name</td>
                        <td>$i->quantity</td>
                    </tr>
                @endforeach
            </tr>
        </table>

        <div class="card p-3">
            <div class="row">
                <div class="col">
                    <h5>Sales Chart</h5>
                    <div style="max-width: 700px;">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
                <div class="col">
                    <h5>Top Selling Items</h5>
                    <div style="max-width: 700px;">
                        <canvas id="topItemsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        const labels = {!! json_encode($dailyRevenue->pluck('date')) !!};
        const data = {!! json_encode($dailyRevenue->pluck('total')) !!};
        const ctx = document.getElementById('salesChart');

        new Chart(ctx, {
        type: 'line',
        data: {
        labels: labels,
        datasets: [{
        label: 'Daily Revenue',
        data: data,
        borderColor: 'blue',
        backgroundColor: 'rgba(0, 0, 255, 0.2)',
        borderWidth: 2,
        fill: true
        }]
        }
        });

        const itemLabels = {!! json_encode($itemLabels) !!};
        const itemData = {!! json_encode($itemData) !!};
        const ctx2 = document.getElementById('topItemsChart');

        new Chart(ctx2, {
        type: 'bar',
        data: {
        labels: itemLabels,
        datasets: [{
        label: 'Quantity Sold',
        data: itemData,
        backgroundColor: 'orange'
        }]
        }
        });
        </script>
    </div>
@endsection