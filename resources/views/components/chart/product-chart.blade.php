<div class="bg-gray-100 dark:bg-gray-900">
    <div class="max-w-sm w-full bg-white rounded-lg shadow p-4 md:p-6 flex flex-col">
        <div class="flex justify-between items-center mb-5">
            <div>
                <h5 class="leading-none text-sm whitespace-nowrap font-bold text-gray-900 dark:text-white pb-2">
                    SALES: {{ number_format(\App\Models\Product::sum('price'), 2) }}
                </h5>
                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Sales this week</p>
            </div>
            
            <!-- Progress Bar -->
            <div class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
                @php
                    $totalPrice = \App\Models\Product::sum('price'); // Total price from the products
                    $salesBase = 10000; // Example sales base for percentage calculation
                    $percentage = $salesBase > 0 ? ($totalPrice / $salesBase) * 100 : 0; // Calculate percentage based on the sales base
                @endphp
                <div class="h-2 rounded-full" style="width: {{ number_format($percentage, 2) }}%;"></div>
            </div>
            <div class="text-sm text-green-500 mt-1 text-right">{{ number_format($percentage, 2) }}% of Products Sales</div> <!-- Change to green -->
        </div>
        
        <!-- Chart container with Flexbox -->
        <div id="tooltip-chart" class="flex justify-center items-center mb-5" style="flex-grow: 1; max-height: 30vh;">
            <!-- Chart will be rendered here -->
        </div>
    </div> 
</div>
<div id="tooltip-chart"></div>

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    const options = {
        tooltip: {
            enabled: true,
            x: { show: true },
            y: { show: true },
        },
        grid: {
            show: false,
            strokeDashArray: 4,
            padding: { left: 2, right: 2, top: -26 },
        },
        series: [
            {
                name: "Product Sales",
                data: [1500, 1418, 1456, 1526, 1356, 1256, 1300],
                color: "#1A56DB",
            },
            {
                name: "Total Sales",
                data: [643, 413, 765, 412, 1423, 1731, 1550],
                color: "#7E3BF2",
            },
        ],
        chart: {
            height: "100%",
            maxWidth: "100%",
            type: "area",
            fontFamily: "Inter, sans-serif",
            dropShadow: { enabled: false },
            toolbar: { show: false },
        },
        legend: { show: true },
        fill: {
            type: "gradient",
            gradient: {
                opacityFrom: 0.55,
                opacityTo: 0,
                shade: "#1C64F2",
                gradientToColors: ["#1C64F2"],
            },
        },
        dataLabels: { enabled: false },
        stroke: { width: 6 },
        xaxis: {
            categories: ['01 February', '02 February', '03 February', '04 February', '05 February', '06 February', '07 February'],
            labels: { show: false },
            axisBorder: { show: false },
            axisTicks: { show: false },
        },
        yaxis: {
            show: false,
            labels: {
                formatter: function (value) {
                    return '$' + value;
                },
            },
        },
    };

    // Create the chart instance
    const chart = new ApexCharts(document.getElementById("tooltip-chart"), options);
    chart.render();

    // Function to simulate fetching new data
    function getRandomData() {
        return Math.floor(Math.random() * 2000) + 1000; // Simulate a random new data point
    }

    // Update chart with new data every 5 seconds
    setInterval(() => {
        // Update series data
        const newProductSale = getRandomData();
        const newTotalSale = getRandomData();

        // Push new data to the series
        chart.updateSeries([
            {
                name: "Product Sales",
                data: [...chart.w.globals.series[0], newProductSale], // Add new product sale
            },
            {
                name: "Total Sales",
                data: [...chart.w.globals.series[1], newTotalSale], // Add new total sale
            },
        ]);

        // Update x-axis categories (if needed)
        const newDate = new Date();
        const dateString = `${newDate.getDate()} ${newDate.toLocaleString('default', { month: 'long' })}`;
        chart.updateOptions({
            xaxis: {
                categories: [...chart.w.globals.labels, dateString], // Add new date category
            },
        });
    }, 5000); // Update every 5 seconds
</script>

@endsection
