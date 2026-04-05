<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            padding: 30px;
        }

        .header {
            text-align: center;
        }

        .logo {
            width: 80px;
        }

        table,
        th,
        td {
            margin: 20px auto;
            border: 1px solid black;
            padding: 8px;
        }

        .total {
            text-align: right;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('images/logo.jpg') }}" class="logo">
        <h2>RESTAURANT</h2>
        123 Main Road, City <br>
        +91 85752 55478<br>
        +91 85752 55478<br>
    </div>

    <hr style="margin: 20px 0;">

    <table style="border: none;" width="100%">
        <tr>
            <td align="left" style="border: none;">Order ID: 2</td>
            <td align="center" style="border: none;">Date: 05-04-2026</td>
            <td align="right" style="border: none;">Time: 04:47 PM</td>
        </tr>
    </table>

    <table>
        <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
        </tr>

        @php
            $subtotal = 0;
        @endphp

        @foreach ($order->items as $item)

            @php
                $lineTotal = $item->price * $item->quantity;
                $subtotal += $lineTotal;
            @endphp

            <tr>
                <td>{{ $item->menuItem->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $lineTotal }}</td>
            </tr>

        @endforeach

    </table>

    @php
        $gst = $subtotal * 0.05;
        $grand = $subtotal + $gst;
    @endphp

    <div class="total" style="text-align: right; margin-top: 20px;">
        <p>Subtotal: ₹{{ number_format($subtotal, 2) }}</p>
        <p>GST (5%): ₹{{ number_format($gst, 2) }}</p>
        <h3>Grand Total: ₹{{ number_format($grand, 2) }}</h3>
    </div>

</body>

</html>