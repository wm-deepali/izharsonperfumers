<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OrderDetail;
use Carbon\Carbon;

class MostPurchasedProducts extends Command
{
    protected $signature = 'products:most-purchased {--days=30}';
    protected $description = 'Get most purchased products';

    public function handle()
    {
        $days = $this->option('days');

        $products = OrderDetail::select('product_id')
            ->whereHas('order', function ($q) use ($days) {
                $q->where('created_at', '>=', Carbon::now()->subDays($days));
            })
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

        $this->info("Top Most Purchased Products (Last {$days} Days):");

        foreach ($products as $item) {
            $this->line(
                'Product: ' . optional($item->product)->name .
                ' | Sold: ' . $item->total_sold
            );
        }
    }
}