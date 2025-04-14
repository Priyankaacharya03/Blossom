<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>Hello {{ $username }}</p>
    <p>Your order has been confirmed</p>
    <div>
        <p>Order Id: {{ $order->id }}</p>
        <p>Receipt Date: {{ now()->format('F j, Y') }}</p>
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">SN</th>
                    <th scope="col">Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderItems as $orderItem )
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $orderItem->product_name }}</td>
                    <td>{{ $orderItem->quantity }}</td>
                    <td>{{ $orderItem->price }}</td>
                    <td>{{ $orderItem->price* $orderItem->quantity }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</body>

</html>