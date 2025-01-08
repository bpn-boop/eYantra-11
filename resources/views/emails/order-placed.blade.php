<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Placed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .email-header img {
            width: 150px;
        }
        .email-content {
            font-size: 16px;
            color: #333333;
            line-height: 1.5;
        }
        .email-content p {
            margin: 15px 0;
        }
        .email-content a {
            background-color: #4CAF50;
            color: #ffffff;
            text-decoration: none;
            padding: 15px 25px;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            margin-top: 20px;
        }
        .email-content a:hover {
            background-color: #45a049;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777777;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <!-- Header with logo -->
        <div class="email-header">
            <img src="https://letsenhance.io/static/8f5e523ee6b2479e26ecc91b9c25261e/1015f/MainAfter.jpg" alt="eYantra">
        </div>

        <!-- Main content of the email -->
        <div class="email-content">
            <h2>Hello, {{ auth()->user()->name }}!</h2>
            <p>Your order has been successfully placed. Our team will process your order and get back to you as soon as possible.</p>
            
            <!-- Orders Table -->
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Order ID</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders_placed as $order)
                    <tr>
                        <td>{{ $order->title }}</td>
                        <td>{{ $order->price }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->order_id }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Regards, eYantra.</p>
        </div>
    </div>

</body>
</html>
