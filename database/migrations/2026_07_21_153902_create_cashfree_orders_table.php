// database/migrations/xxxx_xx_xx_create_cashfree_orders_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cashfree_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('link_id')->nullable();
            $table->text('cf_link_url')->nullable();
            $table->decimal('amount', 10, 2)->default(0);
            $table->string('payment_status')->default('pending');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cashfree_orders');
    }
};