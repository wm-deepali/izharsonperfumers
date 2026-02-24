<?php

namespace Database\Seeders;

use App\Models\HomeFeature;
use Illuminate\Database\Seeder;

class HomeFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HomeFeature::insert([
            [
                'icon' => 'flaticon-fast-delivery',
                'title' => 'Free Shipping',
                'description' => 'Free Shipping for orders over ₹200',
                'position' => 1
            ],
            [
                'icon' => 'flaticon-shield',
                'title' => 'Money Guarantee',
                'description' => 'Within 30 days for an exchange.',
                'position' => 2
            ],
            [
                'icon' => 'flaticon-headphones',
                'title' => 'Online Support',
                'description' => '24 hours a day, 7 days a week',
                'position' => 3
            ],
            [
                'icon' => 'flaticon-credit-card',
                'title' => 'Flexible Payment',
                'description' => 'Pay with Multiple Credit Cards',
                'position' => 4
            ],
        ]);
    }
}
