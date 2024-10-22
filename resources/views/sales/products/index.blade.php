@extends('layouts.app3')

@section('title', 'List Product Sold')
@section('contents')
    <hr />
    <!-- Form for Sales Report Generation -->
    <form action="{{ route('sales.report') }}" method="GET" class="mb-8 grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
        <div>
            <label for="start_date" class="block font-semibold">Start Date:</label>
            <input type="date" name="start_date" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        
        <div>
            <label for="end_date" class="block font-semibold">End Date:</label>
            <input type="date" name="end_date" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div>
            <label for="filter" class="block font-semibold">Filter:</label>
            <select name="filter" id="filter" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
                <option value="yearly">Yearly</option>
            </select>
        </div>

        <div class="col-span-1 md:col-span-3">
            <button type="submit" class="w-full mt-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Generate Sales Report
            </button>
        </div>
    </form>

    <!-- Display the Date Range -->
    @if(request('start_date') && request('end_date'))
    <div class="mb-6">
        <p class="text-lg font-semibold text-gray-600">Sales Report from {{ request('start_date') }} to {{ request('end_date') }}</p>
    </div>
    @endif

    <!-- Sales Table -->
    <div class="overflow-x-auto p-12">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="py-3 px-6 text-left">#</th>
                    <th class="py-3 px-6 text-left">Product Code</th>
                    <th class="py-3 px-6 text-left">Title</th>
                    <th class="py-3 px-6 text-left">Price</th>
                    <th class="py-3 px-6 text-left">Items Sold</th>
                    <th class="py-3 px-6 text-left">Total Revenue/Sales</th>
                </tr>
            </thead>
            <tbody>
                @if($product->count() > 0)
                    @foreach($product as $rs)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-3 px-6">{{ $loop->iteration }}</td>
                            <td class="py-3 px-6">{{ $rs->product_code }}</td>
                            <td class="py-3 px-6">{{ $rs->title }}</td>
                            <td class="py-3 px-6">&#8369; {{ number_format($rs->price, 2) }}</td>
                            <td class="py-3 px-6">{{ $rs->item_sold }}</td>
                            <td class="py-3 px-6">&#8369; {{ number_format($rs->total_revenue, 2) }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center py-3 px-6" colspan="6">No products sold within the selected period.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
@endsection
