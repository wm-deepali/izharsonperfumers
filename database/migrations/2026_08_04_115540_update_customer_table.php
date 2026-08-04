<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('country_code')->nullable()->change();
            $table->string('mobile_number')->nullable()->change();
            $table->string('password')->nullable()->change();
        });

        Schema::table('pending_registrations', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->string('country_code')->nullable()->change();
            $table->string('mobile_number')->nullable()->change();
            $table->string('password')->nullable()->change();
        });
    }

    public function down(): void
    {
        // Not reversible safely without knowing which rows would violate NOT NULL again.
    }
};