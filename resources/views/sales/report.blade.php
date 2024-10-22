<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="container mx-auto my-8">
        <h1 class="text-3xl font-bold mb-4">Sales Report</h1>
        <p class="mb-4 text-lg">From: <span class="font-semibold">{{ $startDate->format('Y-m-d') }}</span> To: <span class="font-semibold">{{ $endDate->format('Y-m-d') }}</span></p>

        <!-- Filters for Weekly, Monthly, Yearly -->
        <form method="GET" action="{{ route('sales.report') }}" class="mb-6 flex items-center space-x-4">
            <label for="filter" class="text-lg">Filter:</label>
            <select name="filter" id="filter" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
                <option value="yearly">Yearly</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600">Apply Filter</button>
        </form>

        <!-- Sales Table -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">#</th>
                        <th class="px-4 py-2 text-left">Product</th>
                        <th class="px-4 py-2 text-left">Total Sold</th>
                        <th class="px-4 py-2 text-left">Total Revenue</th>
                        <th class="px-4 py-2 text-left">Date Range</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($products as $rs)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $rs->product->title }}</td>
                        <td class="px-4 py-2">{{ $rs->total_sold }}</td>
                        <td class="px-4 py-2">&#8369; {{ number_format($rs->total_revenue, 2) }}</td>
                        <td class="px-4 py-2">{{ $startDate->format('Y-m-d') }} to {{ $endDate->format('Y-m-d') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
