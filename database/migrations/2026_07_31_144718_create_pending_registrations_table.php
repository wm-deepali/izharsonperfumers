<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pending_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email');
            $table->string('country_code', 6)->default('+91');
            $table->string('mobile_number', 15);
            $table->string('password');
            $table->string('verification_token')->nullable()->unique();
            $table->timestamp('expires_at');
            $table->timestamps();

            $table->index(['email']);
            $table->index(['mobile_number']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pending_registrations');
    }
};