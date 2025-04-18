<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <img src="" alt="">
    <h1>{{ $vendor->vendor_name }}</h1>
    <h1>{{ $vendor->vendor_email }}</h1>
    <h1>{{ $vendor->city }}, {{ $vendor->address }}</h1>
    <h1>{{ $vendor->phone_number }}</h1>
    <h1>{{ $vendor->bio||'' }}</h1>

    @foreach ($products as $product )
    <div>
        <img src="" alt="">
        <h1></h1>
        <h1>{{ $product->product_name }}</h1>
        <h1>{{ $product->product_name }}</h1>
    </div>

    @endforeach


</body>

</html>