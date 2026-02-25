<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            // Deal status
            $table->boolean('is_deal')
                  ->default(false)
                  ->after('status')
                  ->comment('Product is part of deal');

            // Deal start time
            $table->timestamp('deal_start')
                  ->nullable()
                  ->after('is_deal');

            // Deal end time
            $table->timestamp('deal_end')
                  ->nullable()
                  ->after('deal_start');

            // Index for faster filtering
            $table->index(['is_deal', 'deal_end']);
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $table->dropIndex(['is_deal', 'deal_end']);
            $table->dropColumn(['is_deal', 'deal_start', 'deal_end']);
        });
    }
};