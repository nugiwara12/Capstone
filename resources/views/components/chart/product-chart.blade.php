<div class="flex flex-col md:flex-row justify-between w-full">
    <!-- First Chart -->
    <div class="flex-1 bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6 m-2 w-full">
        <div class="flex justify-between">
            <div>
                <h5 class="leading-none text-sm font-bold text-gray-900 dark:text-white pb-2">
                    TOTAL PRODUCTS: {{ \App\Models\Product::count() }} <!-- Total product count -->
                </h5>
                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Product Report</p>
            </div>
            <div class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
                @php
                    $totalProduct = \App\Models\Product::count(); // Get total product count
                    $salesBase = 10000; // Base value for percentage calculation
                    $percentage = $salesBase > 0 ? ($totalProduct / $salesBase) * 100 : 0; // Calculate percentage
                @endphp
                <div class="h-2 rounded-full bg-green-500" style="width: {{ number_format($percentage, 2) }}%;"></div>
                <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">
                    {{ number_format($percentage, 2) }}% of Product Base
                </span>
            </div>
        </div>
        <div id="area-chart" style="height: 300px;"></div>
    </div>

    <!-- Second Chart -->
    <div class="flex-1 bg-gray-100 dark:bg-gray-900 rounded-lg shadow p-4 md:p-6 m-2 w-full">
        <div class="flex justify-between items-center mb-5">
            <div>
                <h5 class="leading-none text-sm whitespace-nowrap font-bold text-gray-900 dark:text-white pb-2">
                    SALES: {{ number_format(\App\Models\Product::sum('price'), 2) }}
                </h5>
                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Sales Report</p>
            </div>
            <div class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
                @php
                    $totalPrice = \App\Models\Product::sum('price');
                    $salesBase = 10000;
                    $percentage = $salesBase > 0 ? ($totalPrice / $salesBase) * 100 : 0;
                @endphp
                <div class="h-2 rounded-full bg-green-500" style="width: {{ number_format($percentage, 2) }}%;"></div>
            </div>
            <div class="text-sm text-green-500 mt-1 text-right">{{ number_format($percentage, 2) }}% of Products Sales</div>
        </div>
        <div id="tooltip-chart" class="flex justify-center items-center mb-5" style="flex-grow: 1; max-height: 30vh;"></div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
const options1 = {
    chart: {
        height: "100%",
        type: "area",
        fontFamily: "Inter, sans-serif",
        dropShadow: {
            enabled: false,
        },
        toolbar: {
            show: false,
        },
    },
    series: [
        {
            name: "New Users",
            data: []  // Initialize empty
        }
    ],
    fill: {
        type: "gradient",
        gradient: {
            opacityFrom: 0.55,
            opacityTo: 0,
            shade: "#1C64F2",
            gradientToColors: ["#1C64F2"]
        },
    },
    xaxis: {
        categories: [],  // Initialize empty
        labels: {
            show: true,
        },
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        },
    },
    yaxis: {
        show: true,
    },
    tooltip: {
        enabled: true,
    }
};

const options2 = {
    chart: {
        height: "100%",
        type: "area",
        fontFamily: "Inter, sans-serif",
        dropShadow: {
            enabled: false,
        },
        toolbar: {
            show: false,
        },
    },
    series: [
        {
            name: "Product Sales",
            data: []  // Initialize empty
        },
        {
            name: "Total Sales",
            data: []  // Initialize empty
        }
    ],
    fill: {
        type: "gradient",
        gradient: {
            opacityFrom: 0.55,
            opacityTo: 0,
            shade: "#1C64F2",
            gradientToColors: ["#1C64F2"],
        },
    },
    xaxis: {
        categories: [],  // Initialize empty
        labels: {
            show: true,
        },
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        },
    },
    yaxis: {
        show: true,
    },
    tooltip: {
        enabled: true,
    }
};

const chart1 = new ApexCharts(document.getElementById("area-chart"), options1);
const chart2 = new ApexCharts(document.getElementById("tooltip-chart"), options2);
chart1.render();
chart2.render();

// Function to update charts with real-time data
function updateCharts() {
    const currentDate = new Date();
    const formattedDate = currentDate.toLocaleDateString('en-GB', { weekday: 'short', year: 'numeric', month: 'numeric', day: 'numeric' });
    
    // Update first chart data
    const newUserData = Math.floor(Math.random() * 10000);  // Simulate new users
    options1.series[0].data.push(newUserData);
    options1.xaxis.categories.push(formattedDate);
    if (options1.series[0].data.length > 7) {
        options1.series[0].data.shift();  // Keep last 7 entries
        options1.xaxis.categories.shift(); // Keep last 7 categories
    }
    
    // Update second chart data
    const productSalesData = Math.floor(Math.random() * 1000);
    const totalSalesData = Math.floor(Math.random() * 1000);
    
    options2.series[0].data.push(productSalesData);
    options2.series[1].data.push(totalSalesData);
    options2.xaxis.categories.push(formattedDate);
    if (options2.series[0].data.length > 7) {
        options2.series[0].data.shift();  // Keep last 7 entries
        options2.series[1].data.shift();  // Keep last 7 entries
        options2.xaxis.categories.shift(); // Keep last 7 categories
    }

    chart1.updateOptions(options1);
    chart2.updateOptions(options2);
}

// Update charts every 1.5 seconds
setInterval(updateCharts, 1500);
</script>
