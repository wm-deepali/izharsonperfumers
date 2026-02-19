<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ProductOption;
use Illuminate\Support\Facades\DB;
use Exception;

class FixProductDiscountAmounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:discount-amounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix discount_amount based on mrp and discount_percentage for all product options';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $options = ProductOption::all();

        $this->info("Processing " . $options->count() . " product options...");

        DB::beginTransaction();
        try {

            foreach ($options as $option) {

                $mrp = (float)$option->mrp;
                $percentage = (float)$option->discount_percentage;

                $discount_amount = 0;

                // Calculate discount amount from percentage
                if ($mrp > 0 && $percentage > 0) {
                    $discount_amount = round(($mrp * $percentage) / 100, 2);
                }

                $option->discount_amount = $discount_amount;
                $option->save();
            }

            DB::commit();

            $this->info("✔ Discount amount successfully updated for all product options.");
        
        } catch (Exception $ex) {

            DB::rollback();

            $this->error("❌ Something went wrong. Changes rolled back.");
            $this->error($ex->getMessage());
        }
    }
}
