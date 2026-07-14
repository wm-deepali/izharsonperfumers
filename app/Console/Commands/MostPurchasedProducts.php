<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OrderDetail;

class MostPurchasedProducts extends Command
{
    protected $signature = 'products:most-purchased';
    protected $description = 'Get most purchased products (all time)';

    public function handle()
    {
        $products = OrderDetail::select('product_id')
            ->selectRaw('SUM(quantity) as total_sold')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->with('product')
            ->take(10)
            ->get();

        if ($products->isEmpty()) {
            $this->info('No data found.');
            return;
        }

        $this->info("Top Most Purchased Products (All Time):");

        foreach ($products as $item) {
            $this->line(
                'Slug: ' . optional($item->product)->slug .
                ' | Product: ' . optional($item->product)->name .
                ' | Sold: ' . $item->total_sold
            );
        }
    }
}