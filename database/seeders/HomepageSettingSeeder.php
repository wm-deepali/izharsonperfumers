<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomepageSetting;

class HomepageSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

public function run()
{
    HomepageSetting::updateOrCreate(
        ['page' => 'shop'], // unique identifier
        [
            'heading' => 'Shop Banner',
            'content' => 'Big Sale on Products',
            'image' => null, // admin can upload later
            'url' => '/shop',
            'url_txt' => 'Shop Now',
        ]
    );
}
}
