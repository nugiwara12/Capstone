<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif; /* Font style */
            line-height: 1.5; /* Line height */
            font-size: 16px; /* Base font size */
            margin: 0; /* Remove default margin */
            padding: 20px; /* Add padding */
            background-color: #f9fafb; /* Light background color */
        }
        .container {
            max-width: 800px; /* Maximum width */
            margin: 20px auto; /* Center the container */
            padding: 20px; /* Inner padding */
            background-color: white; /* White background for content */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Shadow for container */
            border-radius: 8px; /* Rounded corners */
        }
        h1 {
            font-size: 24px; /* Header font size */
            font-weight: bold; /* Bold font */
            margin-bottom: 16px; /* Margin below the header */
        }
        p {
            margin-bottom: 16px; /* Margin below paragraph */
        }
        table {
            width: 100%; /* Full width */
            border-collapse: collapse; /* Collapse borders */
            margin-top: 20px; /* Space above the table */
        }
        th, td {
            border: 1px solid #cbd5e0; /* Border color */
            padding: 8px; /* Padding */
            text-align: left; /* Align text to the left */
        }
        thead {
            background-color: #4299e1; /* Header background color */
            color: white; /* Header text color */
        }
        tr:nth-child(even) {
            background-color: #f7fafc; /* Light background for even rows */
        }
        tr:hover {
            background-color: #e2e8f0; /* Highlight on hover */
        }
        .average-display {
            background-color: #edf2f7; /* Background color for average display */
            border-top: 1px solid #cbd5e0; /* Top border */
            margin-top: 16px; /* Space above average display */
            padding: 10px; /* Inner padding */
        }
        .average-display h3 {
            font-size: 18px; /* Font size for average title */
            font-weight: bold; /* Bold font */
        }
        .average-display p {
            font-size: 20px; /* Font size for average value */
            font-weight: bold; /* Bold font */
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Gawang Gamat | Sales Report</h1>
    <p>From: <span style="font-weight: bold;">{{ $startDate->format('F j, Y') }}</span> To: <span style="font-weight: bold;">{{ $endDate->format('F j, Y') }}</span></p>

    <!-- Sales Table -->
    <div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Total Sold</th>
                    <th>Total Revenue</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $rs)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rs->title }}</td>
                    <td>₱ {{ $rs->total_sold }}</td>
                    <td>₱ {{ number_format($rs->total_revenue, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Average Total and Percentage Display -->
        <div class="average-display">
            <h3>Average Total Revenue</h3>
            <p>₱ {{ number_format($products->avg('total_revenue'), 2) }} 
            ({{ number_format(($products->avg('total_revenue') / ($products->sum('total_revenue') > 0 ? $products->sum('total_revenue') : 1)) * 100, 2) }}%)</p>
        </div>
    </div>
</div>
</body>
</html>
