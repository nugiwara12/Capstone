<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use PDF;

class SalesReportController extends Controller
{
    public function generateSalesReport(Request $request)
    {
        // Get filter type (daily, weekly, monthly, yearly)
        $filter = $request->input('filter');
        
        // Initialize start and end dates based on filter
        switch ($filter) {
            case 'daily':  // Added case for daily filter
                $startDate = now()->startOfDay(); // Start of today
                $endDate = now()->endOfDay(); // End of today
                break;
            case 'weekly':
                $startDate = now()->startOfWeek();
                $endDate = now()->endOfWeek();
                break;
            case 'monthly':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                break;
            case 'yearly':
                $startDate = now()->startOfYear();
                $endDate = now()->endOfYear();
                break;
            default:
                // Handle custom date range if not using predefined filters
                $startDate = $request->input('start_date');
                $endDate = $request->input('end_date');
                break;
        }

        // Fetch the sales data
        $products = Product::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('product_code, title, sum(quantity) as total_sold, sum(price) as total_revenue')
            ->groupBy('product_code', 'title')
            ->get();
    
        // Generate the PDF using the sales data and load the view
        $pdf = PDF::loadView('components.sales.report', compact('products', 'startDate', 'endDate'));

        // Return the PDF for download
        return $pdf->download('sales_report.pdf');
    }
}
