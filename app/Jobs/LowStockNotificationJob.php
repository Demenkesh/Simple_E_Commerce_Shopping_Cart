<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;  // <-- Add this import
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class LowStockNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;  // <-- Add Dispatchable here

    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function handle()
    {
        $adminEmail = env('MAIL_FROM_ADDRESS');
        Mail::raw("Product {$this->product->name} is low on stock ({$this->product->stock_quantity} left).", function ($message) use ($adminEmail) {
            $message->to($adminEmail)->subject('Low Stock Alert');
        });
    }
}
