<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Status Update</title>
</head>
<body>
    <h1>Delivery Status Update</h1>
    <p>Your order {{$order->product_title}} has been updated to: {{ $order->delivery_status }}</p>
    {{-- <p>Your order (ID: {{ $order->id }}) has been updated to: {{ $order->delivery_status }}</p> --}}
</body>
</html>
