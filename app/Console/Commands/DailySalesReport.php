<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CartItem;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class DailySalesReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:daily-sales';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a daily report of products added to carts (as a proxy for sales in this simple application) to the admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        $cartItems = CartItem::whereDate('created_at', $today)
            ->with('product')
            ->get();

        $reportDate = $today->format('Y-m-d');

        if ($cartItems->isEmpty()) {
            $report = "Daily Sales Report - {$reportDate}\n\nNo products were added to carts today.";
        } else {
            // Group by product to aggregate quantities and revenue across users
            $grouped = $cartItems->groupBy('product_id');

            $report = "Daily Sales Report - {$reportDate}\n\nProducts added to carts today:\n\n";

            $totalQuantity = 0;
            $totalRevenue = 0.0;

            foreach ($grouped as $items) {
                $product = $items->first()->product;
                $quantity = $items->sum('quantity');
                $revenue = $quantity * $product->price;

                $report .= "- {$product->name}\n";
                $report .= "  Quantity: {$quantity}\n";
                $report .= "  Revenue: $" . number_format($revenue, 2) . "\n\n";

                $totalQuantity += $quantity;
                $totalRevenue += $revenue;
            }

            $report .= "Summary:\n";
            $report .= "Total Quantity Added: {$totalQuantity}\n";
            $report .= "Total Potential Revenue: $" . number_format($totalRevenue, 2);
        }

        Mail::raw($report, function ($message) use ($reportDate) {
            $message->to(env('MAIL_FROM_ADDRESS'))
                    ->subject("Daily Sales Report - {$reportDate}");
        });

        $this->info('Daily sales report sent successfully.');
    }
}
