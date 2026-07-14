<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('image_thumb')->nullable()->after('image');
        });

        Schema::table('product_option_images', function (Blueprint $table) {
            $table->string('image_thumb')->nullable()->after('image');
        });

        Schema::table('product_variant_images', function (Blueprint $table) {
            $table->string('image_thumb')->nullable()->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image_thumb');
        });

        Schema::table('product_option_images', function (Blueprint $table) {
            $table->dropColumn('image_thumb');
        });

        Schema::table('product_variant_images', function (Blueprint $table) {
            $table->dropColumn('image_thumb');
        });
    }
};